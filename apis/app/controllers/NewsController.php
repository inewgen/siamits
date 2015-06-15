<?php

class NewsController extends ApiController
{
    private $simages;

    public function __construct(Simages $simages)
    {
        $this->simages = $simages;
    }

    public function index()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'user_id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $user_id       = array_get($data, 'user_id', 0);

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        $filters = array(
            'user_id' => $user_id,
            'ids_type' => '2'
        );

        // Query
        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        $query = News::filters($filters)
                ->with('images')
                ->with('categories')
                ->with('tags')
                ->orderBy($order, $sort);
        $count   = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);
        
        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        //Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key2 == 'images') {
                        // Loop images
                        $images = $this->simages->loopImages($value2, $user_id);
                        $entry[$key2] = $images;
                    } else if ($key2 == 'categories') {
                        $category['id'] = $value2['id'];
                        $category['title'] = $value2['title'];
                        $entry[$key2] = $category;
                    } else {
                        $entry[$key2] = $value2;
                    }
                }
                $entries[] = $entry;
            }
        }

        $pagings = array(
            'page'    => $page,
            'perpage' => $take,
            'total'   => $count
        );

        $response = array(
            'pagination' => $pagings,
            'record' => $entries
        );

        return API::createResponse($response, 0);
    }

    public function show($id)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
        $rules = array(
            'id'        => 'required|integer|min:1',
            'user_id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $user_id = array_get($data, 'user_id', 0);

        $filters = array(
            'id'        => $id,
            'user_id' => $user_id,
            'ids_type'  => '2'
        );

        // Query
        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        $query   = News::filters($filters)
                ->with('images')
                ->with('categories')
                ->orderBy($order, $sort);
        $count   = (int) $query->count();
        $results = $query->get();
        $results = json_decode($results, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        //Loop data
        $entries = array();
        if (isset($results) && is_array($results)) {
            foreach ($results as $key => $value) {
                foreach ($value as $key2 => $value2) {
                    if ($key2 == 'images') {
                        $images = array();
                        foreach ($value2 as $key3 => $value3) {
                            $cate      = 'news';
                            $path      = 'public/uploads/'.$user_id.'/'.$cate;
                            $url_admin = Config::get('url.siamits-admin');

                            $file_name          = $value3['code'].'.'.$value3['extension'];
                            $image['id']        = $value3['id'];
                            $image['ids']       = $value3['ids'];
                            $image['code']      = $value3['code'];
                            $image['extension'] = $value3['extension'];
                            $image['name']      = $value3['name'];
                            $image['url']       = $url_admin.'/'.$path.'/'.$file_name;
                            $image['position']  = $value3['position'];
                            $images[]           = $image;
                        }
                        $entry[$key2] = $images;
                    } else if ($key2 == 'categories') {
                        $category['id'] = $value2['id'];
                        $category['title'] = $value2['title'];
                        $entry[$key2] = $category;
                    } else {
                        $entry[$key2] = $value2;
                    }
                }
                $entries = $entry;
            }
        }

        $response = array(
            'record' => $entries
        );

        return API::createResponse($response, 0);
    }

    public function store()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'title'            => 'required',
            'sub_description'  => 'required',
            'description'      => 'required',
            'images'           => 'required',
            'position'         => 'required|integer',
            'status'           => 'required|integer|in:0,1',
            'type'             => 'required|integer',
            'user_id'        => 'required|integer|min:1',
            'tags'             => 'required',
            // 'reference'     => 'min:1|max:150',
            // 'reference_url' => 'min:1|max:150',
            'category_id'      => 'required|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Add news
        $parameters = array(
            
            'title'           => (isset($data['title'])?$data['title']:''),
            'sub_description' => (isset($data['sub_description'])?$data['sub_description']:''),
            'description'     => (isset($data['description'])?$data['description']:''),
            'images'          => (isset($data['images'])?$data['images']:''),
            'position'        => (isset($data['position'])?$data['position']:''),
            'status'          => (isset($data['status'])?$data['status']:'1'),
            'type'            => (isset($data['type'])?$data['type']:'1'), //1=general,2=highlight
            'user_id'       => (isset($data['user_id'])?$data['user_id']:'0'),
            'reference'       => (isset($data['reference'])?$data['reference']:''),
            'reference_url'   => (isset($data['reference_url'])?$data['reference_url']:''),
            'category_id'     => (isset($data['category_id'])?$data['category_id']:'0'),
            'tags'            => (isset($data['tags'])?$data['tags']:''),
            'views'           => (isset($data['views'])?$data['views']:'0'),
            'likes'           => (isset($data['likes'])?$data['likes']:'0'),
            'share'           => (isset($data['share'])?$data['share']:'0'),
            'updated_at'      => date("Y-m-d H:i:s"),
            'created_at'      => date("Y-m-d H:i:s"),
        );

        // Insert
        $query = new News();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();
        $ids = (isset($query->id)?$query->id:null);

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $parameters = array(
            'title'      => array_get($data, 'tags', ''),
            'links_type' => 'news',
            'links_id'   => $ids,
        );
        $tags = $this->addTags($parameters);

        $response = array(
            'id' => $ids,
            'record' => $data,
        );

        return API::createResponse($data, 0);
    }

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
        $rules = array(
            'title'            => 'required',
            'sub_description'  => 'required',
            'description'      => 'required',
            'images'           => 'required',
            'position'         => 'required|integer',
            'status'           => 'required|integer|in:0,1',
            'type'             => 'required|integer',
            'user_id'        => 'required|integer|min:1',
            'tags'             => 'required',
            // 'reference'     => 'min:1|max:150',
            // 'reference_url' => 'min:1|max:150',
            'category_id'      => 'required|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $id        = array_get($data, 'id', null);
        $user_id = array_get($data, 'user_id', null);

        // Edit news
        $parameters = array();
        isset($data['title']) ? $parameters['title'] = $data['title']: '';
        isset($data['sub_description']) ? $parameters['sub_description'] = $data['sub_description']: '';
        isset($data['description']) ? $parameters['description'] = $data['description']: '';
        isset($data['images']) ? $parameters['images'] = $data['images']: '';
        isset($data['position']) ? $parameters['position'] = $data['position']: '';
        isset($data['status']) ? $parameters['status'] = $data['status']: '';
        isset($data['type']) ? $parameters['type'] = $data['type']: '';
        isset($data['user_id']) ? $parameters['user_id'] = $data['user_id']: '';
        isset($data['reference']) ? $parameters['reference'] = $data['reference']: '';
        isset($data['reference_url']) ? $parameters['reference_url'] = $data['reference_url']: '';
        isset($data['category_id']) ? $parameters['category_id'] = $data['category_id']: '';
        isset($data['tags']) ? $parameters['tags'] = $data['tags']: '';
        isset($data['views']) ? $parameters['views'] = $data['views']: '';
        isset($data['likes']) ? $parameters['likes'] = $data['likes']: '';
        isset($data['share']) ? $parameters['share'] = $data['share']: '';
        $parameters['updated_at'] = date("Y-m-d H:i:s");

        // Update news
        $query = News::where('id', '=', $id)
            ->where('user_id', '=', $user_id);
            
        if ($query) {
            $query->update($parameters);
        } else {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $parameters = array(
            'title'      => array_get($data, 'tags', ''),
            'links_type' => 'news',
            'links_id'   => $id,
        );
        $tags = $this->updateTags($parameters);

        $response = array(
            'record' => $query,
        );

        return API::createResponse($data, 0);
    }

    public function destroy($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
        $rules = array(
            'id'        => 'required|integer|min:1',
            'images'    => 'required|integer',
            'user_id' => 'required|integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $images = array_get($data, 'images', 0);

        // Delete
        $parameters_d = array(
            'links_id'   => $id,
            'links_type' => 'news',
        );
        $tags = $this->deleteTags($parameters_d);
        
        // Delete news
        $query = News::find($id);
        if ($query) {
            $query->delete();

            if ($query) {
                $filters = array(
                    'ids'       => $images,
                    'user_id' => $user_id,
                );

                $query2 = Images::filters($filters);

                if ($query2) {
                    $query2->delete();
                }
            }
        }

        if (!$query || !$query2) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'record' => $data,
        );

        return API::createResponse($response, 0);
    }

    private function addTags($data)
    {
        // Validator
        $rules = array(
            'title'      => 'required',
            'links_type' => 'required',
            'links_id'   => 'required|integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $title_txt = array_get($data, 'title', '');
        $title_arr = explode(',', $title_txt);

        foreach ($title_arr as $key => $title) {
            $filters = array(
                'title' => $title,
            );

            $query = Tags::filters($filters)->get();
            $count   = (int) $query->count();

            if ($count == 0) {
                // Insert
                $parameters2 = array(
                    'title'      => $title,
                    'status'     => array_get($data, 'status', '1'),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                );

                $query2 = new Tags();
                foreach ($parameters2 as $key2 => $value2) {
                    $query2->$key2 = $value2;
                }

                $query2->save();

                if (!$query2) {
                    $response = array();
                    return API::createResponse($response, 1001);
                }

                $tags_id = (isset($query2->id) ? $query2->id : 0);
            } else {
                $tags_id = (isset($query[0]->id) ? $query[0]->id : 0);
            }

            $links_id   = array_get($data, 'links_id', '0');
            $links_type = array_get($data, 'links_type', '');
            $filters3   = array(
                'tags_id'    => $tags_id,
                'links_id'   => $links_id,
                'links_type' => $links_type,
            );

            $query3 = TagsLinks::filters($filters3)->get();
            $count3   = (int) $query3->count();

            if ($count3 == 0) {
                // Insert
                $parameters4 = array(
                    'tags_id'    => $tags_id,
                    'links_id'   => $links_id,
                    'links_type' => $links_type,
                    'position'   => array_get($data, 'position', '0'),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                );

                $query4 = new TagsLinks();
                foreach ($parameters4 as $key4 => $value4) {
                    $query4->$key4 = $value4;
                }

                $query4->save();

                if (!$query4) {
                    $response = array();
                    return API::createResponse($response, 1001);
                }
            } else {
                if ($tags_id = (isset($query3[0]->tags_id) ? $query3[0]->tags_id : false)) {
                    $parameters5['updated_at'] = date("Y-m-d H:i:s");

                    // Update
                    $query5 = TagsLinks::where('tags_id', '=', $tags_id);
                      
                    if ($query5) {
                        $query5->update($parameters5);
                    } else {
                        return API::createResponse($response, 1001);
                    }
                }
            }
        }

        $response = array(
            'record' => $data,
        );

        return API::createResponse($data, 0);
    }

    private function updateTags($data)
    {
        // Validator
        $rules = array(
            'title'      => 'required',
            'links_type' => 'required',
            'links_id'   => 'required|integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return false;
        }

        // Delete
        $parameters_d = array(
            'links_id'   => array_get($data, 'links_id', '0'),
            'links_type' => array_get($data, 'links_type', ''),
        );
        $tags = $this->deleteTags($parameters_d);

        $title_txt = array_get($data, 'title', '');
        $title_arr = explode(',', $title_txt);

        foreach ($title_arr as $key => $title) {
            $filters = array(
                'title' => $title,
            );

            $query = Tags::filters($filters)->get();
            $count   = (int) $query->count();

            if ($count == 0) {
                // Insert
                $parameters2 = array(
                    'title'      => $title,
                    'status'     => array_get($data, 'status', '1'),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                );

                $query2 = new Tags();
                foreach ($parameters2 as $key2 => $value2) {
                    $query2->$key2 = $value2;
                }

                $query2->save();

                if (!$query2) {
                    $response = array();
                    return false;
                }

                $tags_id = (isset($query2->id) ? $query2->id : 0);
            } else {
                $tags_id = (isset($query[0]->id) ? $query[0]->id : 0);
            }

            $links_id   = array_get($data, 'links_id', '0');
            $links_type = array_get($data, 'links_type', '');
            $filters3   = array(
                'tags_id'    => $tags_id,
                'links_id'   => $links_id,
                'links_type' => $links_type,
            );

            $query3 = TagsLinks::filters($filters3)->get();
            $count3   = (int) $query3->count();

            if ($count3 == 0) {
                // Insert
                $parameters4 = array(
                    'tags_id'    => $tags_id,
                    'links_id'   => $links_id,
                    'links_type' => $links_type,
                    'position'   => array_get($data, 'position', '0'),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                );

                $query4 = new TagsLinks();
                foreach ($parameters4 as $key4 => $value4) {
                    $query4->$key4 = $value4;
                }

                $query4->save();

                if (!$query4) {
                    $response = array();
                    return false;
                }
            } else {
                if ($tags_id = (isset($query3[0]->tags_id) ? $query3[0]->tags_id : false)) {
                    $parameters5['updated_at'] = date("Y-m-d H:i:s");

                    // Update
                    $query5 = TagsLinks::where('tags_id', '=', $tags_id);
                      
                    if ($query5) {
                        $query5->update($parameters5);
                    } else {
                        return false;
                    }
                }
            }
        }

        $response = array(
            'record' => $data,
        );

        return true;
    }

    private function deleteTags($data)
    {
        // Validator
        $rules = array(
            'links_id'   => 'required|integer|min:1',
            'links_type' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return false;
        }

        // Delete
        $filters = array(
            'links_id'   => array_get($data, 'links_id', '0'),
            'links_type' => array_get($data, 'links_type', '0'),
        );

        $query = TagsLinks::filters($filters);
        if ($query) {
            $query->delete();
        }

        if (!$query) {
            $response = array();

            return false;
        }

        $response = array(
            'record' => $data,
        );

        return true;
    }
}
