<?php

class NavigationsController extends ApiController
{

    public function __construct(NavigationsRepositoryInterface $navigationsRepository)
    {
        parent::__construct();
        $this->navigationsRepository = $navigationsRepository;
    }

    public function index()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'member_id' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $parameters = array(
            'member_id' => $data['member_id'],
        );

        $results = $this->navigationsRepository->lists($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1004);
        }

        $response = array(
            'record' => $results,
        );

        return API::createResponse($response, 0);
    }

    public function store()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'member_id' => 'required|integer|min:1',
            'title'     => 'required|min:1',
            'position'  => 'required|integer|min:1',
            'url'       => 'required|min:1',
            'status'    => 'required|min:1|in:true,false',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $parameters = array(
            'member_id' => $data['member_id'],
            'title'     => $data['title'],
            'position'  => $data['position'],
            'url'       => $data['url'],
            'status'    => ($data['status']=='false'?'0':'1'),
        );

        $results = $this->navigationsRepository->create($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'record' => $results,
        );

        return API::createResponse($response, 0);
    }

    public function show($id)
    {
        return API::createResponse('Show', 0);
    }

    public function update($id = null)
    {
        $data = Input::all();
        $data['id'] = $id;

        // Validator request
        $rules = array(
            'id'        => 'required|integer|min:1',
            'member_id' => 'required|integer|min:1',
            'title'     => 'required|min:1',
            'position'  => 'required|integer|min:1',
            'url'       => 'required|min:1',
            'status'    => 'required|min:1|in:true,false',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $response = array(
                'message' => $validator->messages()->first(),
            );

            return API::createResponse($response, 1003);
        }

        $parameters = array(
            'id'        => $data['id'],
            'member_id' => $data['member_id'],
            'title'     => $data['title'],
            'position'  => $data['position'],
            'url'       => $data['url'],
            'status'    => ($data['status']=='false'?'0':'1'),
        );

        $results = $this->navigationsRepository->update($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'record' => $results,
        );

        return API::createResponse($response, 0);
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

        $parameters = array(
            'id'    => $data['id']
        );

        $results = $this->navigationsRepository->destroy($parameters);

        if (!$results) {
            $response = array();

            return API::createResponse($response, 1001);
        }

        $response = array(
            'record' => $results,
        );

        return API::createResponse($response, 0);
    }
}
