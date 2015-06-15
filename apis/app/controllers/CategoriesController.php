<?php

class CategoriesController extends ApiController
{
    public function index()
    {
        $data = Input::all();

        $response = array(
            'data' => $data,
        );

        // Validator
        $rules = array(
            'member_id' => 'required|integer|min:1',
            'type'      => 'integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first()
            );

            return API::createResponse($response, 1003);
        }

        $order   = array_get($data, 'order', 'position');
        $sort    = array_get($data, 'sort', 'asc');

        // Set Pagination
        $take = (int) (isset($data['perpage'])) ? $data['perpage'] : 20;
        $take = $take == 0 ? 20 : $take;
        $page = (int) (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1;
        $skip = ($page - 1) * $take;

        $filters = array(
            'member_id' => $data['member_id'],
        );

        isset($data['type']) ? $filters['type'] = $data['type']:'';

        $query = Categories::filters($filters)
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

    public function store()
    {
        $data = Input::all();

        // Validator
        $rules = array(
            'title'       => 'required',
            // 'description' => 'required',
            'parent_id'   => 'required|integer',
            'member_id'   => 'required|integer',
            'position'    => 'required|integer',
            'images'      => 'integer',
            'type'        => 'required|integer',
            'status'      => 'integer|in:0,1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Add
        $parameters = array(
            'title'       => array_get($data, 'title', ''),
            'description' => array_get($data, 'description', ''),
            'parent_id'   => array_get($data, 'parent_id', '0'),
            'member_id'   => array_get($data, 'member_id', '1'),
            'position'    => array_get($data, 'position', '0'),
            'images'      => array_get($data, 'images', '0'),
            'type'        => array_get($data, 'type', '0'),
            'status'      => array_get($data, 'status', '1'),
            'updated_at'  => date("Y-m-d H:i:s"),
            'created_at'  => date("Y-m-d H:i:s"),
        );

        // Insert
        $query = new Categories();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $id = (isset($query->id)?$query->id:null);

        $response = array(
            'id' => $id,
            'record' => $data,
        );

        return API::createResponse($data, 0);
    }

    public function show($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
        $rules = array(
            'id'        => 'required|integer|min:1',
            'member_id' => 'required|integer|min:1',
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
            'member_id' => $member_id,
        );

        // Query
        $query   = Categories::find($id);
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

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator
        $rules = array(
            'id'        => 'required|integer|min:1',
            'member_id' => 'required|integer'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $id        = array_get($data, 'id', null);
        $member_id = array_get($data, 'member_id', null);
        $response  = array();

        // Update
        $update_allow = array(
            'title',
            'description',
            'parent_id',
            'member_id',
            'position',
            'images',
            'type',
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
            $query = Categories::where('id', '=', $id)
                ->where('member_id', '=', $member_id);
              
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
        $query = Categories::find($id);
        if ($query) {
            $query->delete();
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
