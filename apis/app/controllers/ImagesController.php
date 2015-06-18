<?php

class ImagesController extends ApiController
{
    public function index()
    {
        $data = Input::all();
        $response = 'Index';
        return API::createResponse($response, 0);
    }

    public function show($id)
    {
        $data = Input::all();
        $response = 'Show';
        return API::createResponse($response, 0);
    }

    public function store()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'user_id'  => 'required|integer|min:1',
            'code'       => 'required',
            'name'       => 'required',
            'extension'  => 'required',
            // 'url'        => 'min:1',
            'type'       => 'integer',//1=images,2=video
            'size'       => 'integer',
            'width'      => 'integer',
            'height'     => 'integer',
            'position'   => 'integer',
            'status'     => 'integer|in:0,1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        // Upload images
        $parameters = array(
            'user_id'  => $data['user_id'],
            'code'       => $data['code'],
            'name'       => $data['name'],
            'extension'  => $data['extension'],
            'url'        => (isset($data['url'])?$data['url']:''),
            'type'       => (isset($data['type'])?$data['type']:'0'), //Unknown in future
            'size'       => (isset($data['size'])?$data['size']:'0'),
            'width'      => (isset($data['width'])?$data['width']:'0'),
            'height'     => (isset($data['height'])?$data['height']:'0'),
            'position'   => (isset($data['position'])?$data['position']:'0'),
            'status'     => (isset($data['status'])?$data['status']:'1'),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s"),
        );

        // Insert
        $query = new Images();
        foreach ($parameters as $key => $value) {
            $query->$key = $value;
        }
        $query->save();
        $id = (isset($query->id)?$query->id:null);

        if (!$query) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'id' => $id,
            'data' => $data,
        );

        return API::createResponse($response, 0);
    }

    public function update($code = null)
    {
        $data = Input::all();
        $data['code'] = $code;

        // Validator request
        $rules = array(
            'code'      => 'required|integer',
            'user_id' => 'required|integer',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $response = array();

        isset($data['code']) ? $parameters['code'] = $data['code'] : '';
        isset($data['name']) ? $parameters['name'] = $data['name'] : '';
        isset($data['extension']) ? $parameters['extension'] = $data['extension'] : '';
        isset($data['url']) ? $parameters['url'] = $data['url'] : '';
        isset($data['type']) ? $parameters['type'] = $data['type'] : '';
        isset($data['size']) ? $parameters['size'] = $data['size'] : '';
        isset($data['width']) ? $parameters['width'] = $data['width'] : '';
        isset($data['height']) ? $parameters['height'] = $data['height'] : '';
        isset($data['position']) ? $parameters['position'] = $data['position'] : '';
        isset($data['status']) ? $parameters['status'] = $data['status'] : '';
        isset($data['user_id']) ? $parameters['user_id'] = $data['user_id'] : '';
        $parameters['updated_at'] = date("Y-m-d H:i:s");
        $code = array_get($data, 'code', 0);
        $user_id = array_get($data, 'user_id', 0);

        $query = Images::where('code', '=', $code)
            ->where('user_id', '=', $user_id)
            ->update($parameters);

        if (!$query) {
            return API::createResponse($response, 1004);
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

        $response = array(
            'data' => $data
        );

        // Validator request
        $rules = array(
            'id'      => 'required|integer|min:1',
            'user_id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $filters_count = array(
            'images_id' => $id,
        );

        $count = Imageables::filters($filters_count)->count();

        if ($count == 0) {
            $filters = array(
                'id'      => $data['id'],
                'user_id' => $data['user_id'],
            );

            $query = Images::filters($filters);

            if (!$query) {
                return API::createResponse($response, 1004);
            }

            $query->delete();

            if (!$query) {
                return API::createResponse($response, 1001);
            }
        } else {
            return API::createResponse($response, 2002);
        }

        $response = array(
            'record' => $query,
        );

        return API::createResponse($response, 0);
    }
}
