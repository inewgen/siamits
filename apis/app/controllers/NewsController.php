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
            'user_id' => 'integer|min:1',
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

        isset($data['s']) ? $filters['s'] = $data['s'] : '';

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
            'user_id' => 'integer|min:1',
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
                ->with('tags')
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
            'user_id'          => 'required|integer|min:1',
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
            'position'        => (isset($data['position'])?$data['position']:''),
            'status'          => (isset($data['status'])?$data['status']:'1'),
            'type'            => (isset($data['type'])?$data['type']:'1'), //1=general,2=highlight
            'user_id'         => (isset($data['user_id'])?$data['user_id']:'0'),
            'reference'       => (isset($data['reference'])?$data['reference']:''),
            'reference_url'   => (isset($data['reference_url'])?$data['reference_url']:''),
            'categories'     => (isset($data['category_id'])?$data['category_id']:'0'),
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
        $id = (isset($query->id)?$query->id:null);

        if (!$query || empty($id)) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        // Add Images
        $parameters = array(
            'images'         => array_get($data, 'images', ''),
            'imageable_id'   => $id,
            'imageable_type' => 'news',
        );
        $images_i = $this->addImages($parameters);

        if (!$images_i) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        // Add Tags
        $parameters = array(
            'title'        => array_get($data, 'tags', ''),
            'tagable_id'   => $id,
            'tagable_type' => 'news',
        );

        $tags_i = $this->addTags($parameters);

        if (!$tags_i) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'id' => $id,
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
            // 'images'           => 'required',
            'position'         => 'required|integer',
            'status'           => 'required|integer|in:0,1',
            'type'             => 'required|integer',
            'user_id'        => 'required|integer|min:1',
            // 'tags'             => 'required',
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
        // isset($data['images']) ? $parameters['images'] = $data['images']: '';
        isset($data['position']) ? $parameters['position'] = $data['position']: '';
        isset($data['status']) ? $parameters['status'] = $data['status']: '';
        isset($data['type']) ? $parameters['type'] = $data['type']: '';
        isset($data['user_id']) ? $parameters['user_id'] = $data['user_id']: '';
        isset($data['reference']) ? $parameters['reference'] = $data['reference']: '';
        isset($data['reference_url']) ? $parameters['reference_url'] = $data['reference_url']: '';
        isset($data['category_id']) ? $parameters['categories'] = $data['category_id']: '';
        // isset($data['tags']) ? $parameters['tags'] = $data['tags']: '';
        isset($data['views']) ? $parameters['views'] = $data['views']: '';
        isset($data['likes']) ? $parameters['likes'] = $data['likes']: '';
        isset($data['share']) ? $parameters['share'] = $data['share']: '';
        $parameters['updated_at'] = date("Y-m-d H:i:s");

        // Update news
        $query = News::where('id', '=', $id);
            
        if ($query) {
            $query->update($parameters);
        } else {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $images = array_get($data, 'images', '');

        // Add Images
        $parameters = array(
            'images'         => $images,
            'imageable_id'   => $id,
            'imageable_type' => 'news',
        );
        $images_i = $this->addImages($parameters);

        if (!$images_i) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        // Add Tags
        $parameters = array(
            'title'        => array_get($data, 'tags', ''),
            'tagable_id'   => $id,
            'tagable_type' => 'news',
        );

        $tags_i = $this->addTags($parameters);

        if (!$tags_i) {
            $response = array();

            return API::createResponse($response, 1001);
        }

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
            'id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }
        
        // Delete news
        $query = News::find($id);
        if ($query) {
            $query->delete();

            if ($query) {
                // Add Images
                $parameters = array(
                    'imageable_id'   => $id,
                    'imageable_type' => 'news',
                );
                $images_i = $this->addImages($parameters);

                if (!$images_i) {
                    $response = array();

                    return API::createResponse($response, 1001);
                }

                // Add Tags
                $parameters = array(
                    'tagable_id'   => $id,
                    'tagable_type' => 'news',
                );

                $tags_i = $this->addTags($parameters);

                if (!$tags_i) {
                    $response = array();

                    return API::createResponse($response, 1001);
                }
            }
        }

        if (!$query) {
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
            'tagable_id'   => 'required|integer',
            'tagable_type' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return false;
        }

        $tagable_id = array_get($data, 'tagable_id', '');
        $tagable_type = array_get($data, 'tagable_type', '');

        // Delete Tagables
        $filters = array(
            'tagable_id'   => $tagable_id,
            'tagable_type' => $tagable_type,
        );
        $query = Tagables::filters($filters);
        if ($query) {
            $query->delete();
        }

        if (!$query) {
            return false;
        }

        if ($title = array_get($data, 'title', false)) {
            $title = explode(',', $title);

            foreach ($title as $key => $tt) {
                // Insert Tags
                $filters = array(
                    'title' => $tt,
                );

                $query = Tags::filters($filters)->get();
                $count   = (int) $query->count();

                if ($count == 0) {
                    // Insert
                    $parameters2 = array(
                        'title'      => $tt,
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
                        return false;
                    }

                    $tags_id = (isset($query2->id) ? $query2->id : '');
                } else {
                    if ($tags_id = (isset($query[0]->id) ? $query[0]->id : '')) {
                        $parameters2['updated_at'] = date("Y-m-d H:i:s");

                        // Update
                        $query2 = Tags::where('id', '=', $tags_id);
                          
                        if ($query2) {
                            $query2->update($parameters2);
                        } else {
                            return false;
                        }
                    }
                }

                // Insert Tagables
                $filters3   = array(
                    'tags_id'      => $tags_id,
                    'tagable_id'   => $tagable_id,
                    'tagable_type' => $tagable_type,
                );

                $query3 = Tagables::filters($filters3)->get();
                $count3   = (int) $query3->count();

                if ($count3 == 0) {
                    // Insert
                    $parameters4 = array(
                        'tags_id'    => $tags_id,
                        'tagable_id'   => $tagable_id,
                        'tagable_type' => $tagable_type,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'created_at' => date("Y-m-d H:i:s"),
                    );

                    $query4 = new Tagables();
                    foreach ($parameters4 as $key4 => $value4) {
                        $query4->$key4 = $value4;
                    }
                    $query4->save();

                    if (!$query4) {
                        return false;
                    }
                } else {
                    if ($tags_id = (isset($query3[0]->tags_id) ? $query3[0]->tags_id : false)) {
                        $parameters5['updated_at'] = date("Y-m-d H:i:s");

                        // Update
                        $query5 = Tagables::where('tags_id', '=', $tags_id);
                          
                        if ($query5) {
                            $query5->update($parameters5);
                        } else {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    private function addImages($data)
    {
        // Delete imageables
        $imageable_id = array_get($data, 'imageable_id', '');
        $imageable_type = array_get($data, 'imageable_type', '');
        $filters = array(
            'imageable_id' => $imageable_id,
            'imageable_type' => $imageable_type,
        );

        $query_ia = Imageables::filters($filters);
        if ($query_ia) {
            $query_ia->delete();
        }

        // Insert images
        if ($images = array_get($data, 'images', false)) {
            foreach ($images as $key => $value) {
                // Insert imageables
                $parameters = array(
                    'images_id' => $value,
                    'imageable_id' => $imageable_id,
                    'imageable_type' => $imageable_type,
                );

                $query = new Imageables();
                foreach ($parameters as $key2 => $value2) {
                    $query->$key2 = $value2;
                }
                $query->save();

                if (!$query) {
                    return false;
                }
            }
        }

        return true;
    }
}
