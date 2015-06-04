<?php

class AdminsBannersController extends BaseController
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function getIndex()
    {
        $theme = Theme::uses('default')->layout('adminlte2');
        $theme->setTitle('Admin SiamiTs :: Banners');
        $theme->setDescription('Banners description');

        $parameters = array(
            'member_id' => '1',
            'perpage'   => '100',
            'order'     => 'position',
            'sort'      => 'asc'
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('banners', $parameters);
        $results = json_decode($results, true);

        if ($data_record = array_get($results, 'data.record', array())) {
            $i = 1;
            foreach ($data_record as $value) {
                $id = array_get($value, 'id');

                // Update position
                $parameters2 = array(
                    'member_id' => '1',
                    'position'  => $i,
                );

                $results2 = $client->put('banners/'.$id, $parameters2);
                $results2 = json_decode($results2, true);

                $i++;
            }
        }

        if (isset($_GET['sdebug'])) {
            alert($entries);
            die();
        }

        $view = array(
            'banners' => $results,
        );

        $script = $theme->scopeWithLayout('banners.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('banners.index', $view)->render();
    }

    public function getAdd()
    {
        $theme = Theme::uses('default')->layout('adminlte2');
        $theme->setTitle('Admin SiamiTs :: Add Banners');
        $theme->setDescription('Add Banners description');

        $parameters = array(
            'member_id' => '1',
            'perpage'   => '100',
            'order'     => 'id',
            'sort'      => 'desc'
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('banners', $parameters);
        $results = json_decode($results, true);

        $id_max = array_get($results, 'data.record.0.id', '0');

        $view = array(
            'id_max' => $id_max
        );

        $script = $theme->scopeWithLayout('banners.jscript_add', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('banners.add', $view)->render();
    }

    public function postAdd()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'image'     => 'required',
            'id_max'    => 'required',
            'member_id' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('banners')->withErrors($message);
        }

        // Upload image
        $cate            = 'banners';
        $member_id       = array_get($data, 'member_id', 0);
        $image           = array_get($data, 'image', null);

        $destinationPath = 'public/uploads/'.$member_id.'/'.$cate; // upload path
        $random          = rand(0, 9);
        $datetime        = date("YmdHis");
        $image_code      = $member_id.$cate.$datetime.$random;
        $image_code      = base64_encode($image_code);
        $extension       = $image->getClientOriginalExtension(); // getting image extension
        $fileName        = $image_code . '.' . $extension; // renameing image
        $upload_image    = $image->move($destinationPath, $fileName); // uploading file to given path

        if (!isset($upload_image)) {
            $message = array(
                'message' => 'Can not upload image',
            );

            return Redirect::to('banners')->withErrors($message);
        } else {
            // Add banner
            $parameters = array(
                'member_id'    => $data['member_id'],
                'title'        => (isset($data['title'])?$data['title']:''),
                'subtitle'     => (isset($data['subtitle'])?$data['subtitle']:''),
                'button'       => (isset($data['button'])?$data['button']:'1'),
                'button_title' => (isset($data['button_title'])?$data['button_title']:''),
                'button_url'   => (isset($data['button_url'])?$data['button_url']:''),
                'image'        => $fileName,
                'position'     => (isset($data['position'])?$data['position']:'0'),
                'type'         => (isset($data['type'])?$data['type']:'1'),
                'status'       => (isset($data['status'])?$data['status']:'1')
            );

            $client = new Client(Config::get('url.siamits-api'));
            $results = $client->post('banners', $parameters);
            $results = json_decode($results, true);

            if (array_get($results, 'status_code', false) != '0') {
                $message = array(
                    'message' => array_get($results, 'status_txt', 'Can not created banners'),
                );

                return Redirect::to('banners')->withErrors($message);
            }

            $message = array(
                'message' => 'You successfully created',
            );
            return Redirect::to('banners')->withSuccess($message);
        }
    }

    public function getEdit($id)
    {
        $data = Input::all();
        $data['id'] = $id;

        $theme = Theme::uses('default')->layout('adminlte2');
        $theme->setTitle('Admin SiamiTs :: Edit Banners');
        $theme->setDescription('Edit Banners description');

        $parameters = array(
            'member_id' => '1'
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('banners/'.$id, $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $message = array(
                'message' => array_get($results, 'status_txt', 'Can not created banners'),
            );

            return Redirect::to('banners')->withErrors($message);
        }

        $banners = array_get($results, 'data.record', array());
        $id_max  = array_get($banners, 'id', '0');

        $view = array(
            'id_max'  => $id_max,
            'banners' => $banners,
        );

        $script = $theme->scopeWithLayout('banners.jscript_edit', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('banners.edit', $view)->render();
    }

    public function postEdit()
    {
        $data = Input::all();
        $data['member_id'] = '1';

        $rules = array(
            'action' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('banners')->withErrors($message);
        }

        $action = array_get($data, 'action', null);

        // Delete
        if ($action == 'delete') {
            // Validator request
            $rules = array(
                'id'        => 'required',
                'member_id' => 'required',
            );

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $message = array(
                    'message' => $validator->messages()->first(),
                );

                return Redirect::to('banners')->withErrors($message);
            }

            $id        = array_get($data, 'id', 0);
            $member_id = array_get($data, 'member_id', 0);

            $delete_file  = true;
            if ($fileName = array_get($data, 'image_name', false)) {
                $cate     = 'banners';
                $path     = 'public/uploads/'.$member_id.'/'.$cate; // upload path
                $old_file = $path.'/'.$fileName;

                // Delete old image
                $delete_file = File::delete($old_file);
            }

            if ($delete_file) {
                // Delete banners
                $parameters = array(
                    'id'        => $id,
                    'member_id' => $member_id,
                );

                $client = new Client(Config::get('url.siamits-api'));
                $results = $client->delete('banners/'.$id, $parameters);
                $results = json_decode($results, true);

                if (array_get($results, 'status_code', false) != '0') {
                    $message = array(
                        'message' => array_get($results, 'status_txt', 'Can not delete banners'),
                    );

                    return Redirect::to('banners')->withErrors($message);
                }
            }

            $message = array(
                'message' => 'You successfully delete',
            );

        // Order
        } else if ($action == 'order') {
            // Validator request
            $rules = array(
                'id_sel'    => 'required',
                'member_id' => 'required',
            );

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $message = array(
                    'message' => $validator->messages()->first(),
                );

                return Redirect::to('banners')->withErrors($message);
            }

            $member_id = array_get($data, 'member_id', 0);

            if ($id_sel = array_get($data, 'id_sel', false)) {
                $i = 1;
                foreach ($id_sel as $value) {
                    $id = $value;
                    $parameters2 = array(
                        'member_id' => $member_id,
                        'position'  => $i,
                    );

                    $client = new Client(Config::get('url.siamits-api'));
                    $results = $client->put('banners/'.$id, $parameters2);
                    $results = json_decode($results, true);

                    $i++;
                }
            }

            if (array_get($results, 'status_code', false) != '0') {
                $message = array(
                    'message' => array_get($results, 'status_txt', 'Can not order banners'),
                );

                return Redirect::to('banners')->withErrors($message);
            }

            $message = array(
                'message' => 'You successfully order',
            );

        // Edit
        } else {
            // Validator request
            $rules = array();
            if (!isset($data['image_old'])) {
                $rules = array(
                    'id'     => 'required',
                    'id_max' => 'required',
                    'image'  => 'required',
                );
            }

            $id = array_get($data, 'id', 0);

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $message = array(
                    'message' => $validator->messages()->first(),
                );

                return Redirect::to('banners')->withErrors($message);
            }

            $fileName = array_get($data, 'image_old', false);
            if (array_get($data, 'image', false)) {
                $cate            = 'banners';
                $member_id       = array_get($data, 'member_id', 0);
                $image           = array_get($data, 'image', null);
                $destinationPath = 'public/uploads/'.$member_id.'/'.$cate; // upload path
                $old_file = $destinationPath.'/'.$fileName;

                // Delete old image
                $delete_file = File::delete($old_file);

                // Upload image
                $random          = rand(0, 9);
                $datetime        = date("YmdHis");
                $image_code      = $member_id.$cate.$datetime.$random;
                $image_code      = base64_encode($image_code);
                $extension       = $image->getClientOriginalExtension(); // getting image extension
                $fileName        = $image_code . '.' . $extension; // renameing image
                $upload_image    = $image->move($destinationPath, $fileName); // uploading file to given path
                
                if (!isset($upload_image)) {
                    $message = array(
                        'message' => 'Can not upload image',
                    );

                    return Redirect::to('banners')->withErrors($message);
                }
            }
       
            $parameters = array(
                'member_id'    => $data['member_id'],
                'title'        => (isset($data['title'])?$data['title']:''),
                'subtitle'     => (isset($data['subtitle'])?$data['subtitle']:''),
                'button'       => (isset($data['button'])?$data['button']:'0'),
                'button_title' => (isset($data['button_title'])?$data['button_title']:''),
                'button_url'   => (isset($data['button_url'])?$data['button_url']:''),
                'image'        => $fileName,
                'position'     => (isset($data['position'])?$data['position']:'0'),
                'type'         => (isset($data['type'])?$data['type']:'1'),
                'status'       => (isset($data['status'])?$data['status']:'0')
            );

            $client = new Client(Config::get('url.siamits-api'));
            $results = $client->put('banners/'.$id, $parameters);
            $results = json_decode($results, true);

            if (array_get($results, 'status_code', false) != '0') {
                $message = array(
                    'message' => array_get($results, 'status_txt', 'Can not edit banners'),
                );

                return Redirect::to('banners')->withErrors($message);
            }

            $message = array(
                'message' => 'You successfully edit',
            );
        }

        return Redirect::to('banners')->withSuccess($message);
    }
}
