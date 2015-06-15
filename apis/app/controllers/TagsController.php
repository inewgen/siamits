<?php

class TagsController extends ApiController
{
    public function index()
    {
        $data = Input::all();

        $response = array(
            'data' => $data,
        );

        // Validator
        $rules = array(
            'status'      => 'integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first()
            );

            return API::createResponse($response, 1003);
        }

        $order   = array_get($data, 'order', 'updated_at');
        $sort    = array_get($data, 'sort', 'desc');

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        $filters = array(
            'status' => '1',
        );

        isset($data['type']) ? $filters['type'] = $data['type']:'';
        isset($data['search']) ? $filters['search'] = $data['search']:'';

        $query = Tags::filters($filters)
                ->with('tagsLinks')
                ->orderBy($order, $sort);
        $count   = (int) $query->count();
        $results = $query->skip($skip)->take($take)->get();
        $results = json_decode($results, true);
        
        if (!$results) {
            return API::createResponse($response, 1004);
        }

        $pagings = array(
            'page'    => $page,
            'perpage' => $take,
            'total'   => $count
        );

        $response = array(
            'pagination' => $pagings,
            'record' => $results
        );

        return API::createResponse($response, 0);
    }

    public function show($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
        $rules = array(
            'id'        => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $member_id = array_get($data, 'member_id', 0);

        $filters = array(
            'id'        => $id,
        );

        // Query
        $query = Tags::filters($filters)
                ->with('tagsLinks')
                ->get();
        $results = json_decode($query, true);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'record' => $results
        );

        return API::createResponse($response, 0);
    }

    public function store()
    {
        $data = Input::all();

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

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
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

        $response  = array();

        // Update
        $update_allow = array(
            'title',
            'status',
        );

        foreach ($data as $key => $value) {
            if (in_array($key, $update_allow)) {
                isset($data[$key]) ? $parameters[$key] = $value: '';
            }
        }

        if (isset($parameters)) {
            $parameters['updated_at'] = date("Y-m-d H:i:s");

            // Update
            $query = Tags::where('id', '=', $id);
              
            if ($query) {
                $query->update($parameters);
                $id = (isset($query->id)?$query->id:null);
            } else {
                return API::createResponse($response, 1004);
            }
        }

        $response = array(
            'record' => $data,
        );

        return API::createResponse($data, 0);
    }

    public function destroy($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
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

        // Delete
        $query = Tags::find($id);
        if ($query) {
            $query->delete();

            if ($query) {
                // Delete
                $filters = array(
                    'tags_id' => $id,
                );

                $query2 = TagsLinks::filters($filters);
                if ($query2) {
                    $query2->delete();
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
}
