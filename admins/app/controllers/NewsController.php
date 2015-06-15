<?php

class NewsController extends BaseController
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
        $theme->setTitle('Admin SiamiTs :: News');
        $theme->setDescription('News description');
        $theme->share('user', $this->user);

        $parameters = array(
            'user_id' => '1',
            'perpage' => '20',
            'order' => 'updated_at',
            'sort' => 'desc',
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('news', $parameters);
        $results = json_decode($results, true);

        $news = array_get($results, 'data.record', array());

        if (isset($_GET['sdebug'])) {
            alert($results);
            die();
        }

        $view = array(
            'news' => $news,
        );

        $script = $theme->scopeWithLayout('news.jscript_index', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.index', $view)->render();
    }

    public function getAdd()
    {
        $theme = Theme::uses('default')->layout('adminlte2');
        $theme->setTitle('Admin SiamiTs :: Add News');
        $theme->setDescription('Add News description');
        $theme->share('user', $this->user);

        $parameters = array(
            'user_id' => '1',
            'type'      => '2' //1=banners,2=news
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->get('categories', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $message = array(
                'message' => array_get($results, 'status_txt', false),
            );

            return Redirect::to('news')->withErrors($message);
        }

        $categories = array_get($results, 'data.record', array());

        if (isset($_GET['sdebug'])) {
            alert($results);
            die();
        }

        $user_id = '1';
        $cate = 'news';
        $cate_id = '2';
        $datetime = date("YmdHis");
        $random = rand(0, 9);

        $ids = $user_id . $cate_id . $datetime . $random;

        $view = array(
            'user_id' => '1',
            'perpage' => '100',
            'order' => 'id',
            'sort' => 'desc',
            'cate' => $cate,
            'cate_id' => $cate_id,
            'user_id' => $user_id,
            'ids' => $ids,
            'categories' => $categories,
        );

        $script = $theme->scopeWithLayout('news.jscript_add', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.add', $view)->render();
    }

    public function postAdd()
    {
        $data = Input::all();

        // Validator request
        $rules = array(
            'title'           => 'required',
            'sub_description' => 'required',
            'description'     => 'required',
            'images'          => 'required',
            'position'        => 'required',
            'status'          => 'required',
            'type'            => 'required',
            'user_id'       => 'required',
            'category_id'     => 'required',
            'tags'            => 'required',
            'images_arr'      => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('news')->withErrors($message);
        }

        $images_arr = array_get($data, 'images_arr', array());
        $user_id  = array_get($data, 'user_id', 0);

        // Add news
        $parameters = array(
            'title'           => (isset($data['title']) ? $data['title'] : ''),
            'sub_description' => (isset($data['sub_description']) ? $data['sub_description'] : ''),
            'description'     => (isset($data['description']) ? $data['description'] : ''),
            'images'          => (isset($data['images']) ? $data['images'] : ''),
            'position'        => (isset($data['position']) ? $data['position'] : '0'),
            'status'          => (isset($data['status']) ? $data['status'] : '1'),
            'type'            => (isset($data['type']) ? $data['type'] : '1'),
            'user_id'       => (isset($data['user_id']) ? $data['user_id'] : '0'),
            'reference'       => (isset($data['reference']) ? $data['reference'] : ''),
            'reference_url'   => (isset($data['reference_url']) ? $data['reference_url'] : '0'),
            'tags'            => (isset($data['tags']) ? $data['tags'] : ''),
            'category_id'     => (isset($data['category_id']) ? $data['category_id'] : '0'),
        );

        $client = new Client(Config::get('url.siamits-api'));
        $results = $client->post('news', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            if (isset($images_arr) && is_array($images_arr)) {
                foreach ($images_arr as $key => $value) {
                    $code      = $key;
                    $extension = $value;
                    $user_id = $user_id;
                    $cate      = 'news';
                    $path      = 'public/uploads/' . $user_id . '/' . $cate; // upload path
                    $file_path = $path . '/' . $code .'.'. $extension;

                    // Delete image
                    $delete_file = File::delete($file_path);
              
                    $parameters = array();
                    $results    = $client->delete('images/'.$code, $parameters);
                    $results    = json_decode($results, true);

                    if ($status_code = array_get($results, 'status_code', false) != '0') {
                        $message = array_get($results, 'status_txt', '');
                        return Redirect::to('news')->withErrors($message);
                    }
                }
            }

            $message = array(
                'message' => array_get($results, 'status_txt', 'Can not created news'),
            );

            return Redirect::to('news')->withErrors($message);
        } else {
            if (isset($images_arr) && is_array($images_arr)) {
                foreach ($images_arr as $key => $value) {
                    $code      = $key;
                    $parameters = array(
                        'user_id' => $user_id,
                        'type'      => '2',
                    );

                    $results    = $client->put('images/'.$code, $parameters);
                    $results    = json_decode($results, true);

                    if ($status_code = array_get($results, 'status_code', false) != '0') {
                        $message = array_get($results, 'status_txt', '');
                        return Redirect::to('news')->withErrors($message);
                    }
                }
            }
        }

        $message = array(
            'message' => 'You successfully created',
        );
        return Redirect::to('news')->withSuccess($message);
    }

    public function getEdit($id)
    {
        $data = Input::all();
        $data['id'] = $id;
        $client = new Client(Config::get('url.siamits-api'));

        $theme = Theme::uses('default')->layout('adminlte2');
        $theme->setTitle('Admin SiamiTs :: Edit News');
        $theme->setDescription('Edit News description');
        $theme->share('user', $this->user);

        $user_id = '1';

        $parameters = array(
            'user_id' => $user_id,
        );

        $results = $client->get('news/' . $id, $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $message = array(
                'message' => array_get($results, 'status_txt', 'Can not created news'),
            );

            return Redirect::to('news')->withErrors($message);
        }

        $news = array_get($results, 'data.record', array());

        $parameters = array(
            'user_id' => '1',
            'type'      => '2' //1=banners,2=news
        );

        $results = $client->get('categories', $parameters);
        $results = json_decode($results, true);

        if (array_get($results, 'status_code', false) != '0') {
            $message = array(
                'message' => array_get($results, 'status_txt', false),
            );

            return Redirect::to('news')->withErrors($message);
        }

        $categories = array_get($results, 'data.record', array());

        $ids = array_get($news, 'images.0.ids', 0);
        if ($ids == 0) {
            $user_id = '1';
            $cate = 'news';
            $cate_id = '2';
            $datetime = date("YmdHis");
            $random = rand(0, 9);
            $ids = $user_id . $cate_id . $datetime . $random;
        }

        $num_image = count($news['images']);

        $view = array(
            'news'       => $news,
            'categories' => $categories,
            'cate'       => 'news',
            'cate_id'    => '2',
            'id'         => $id,
            'ids'        => $ids,
            'user_id'  => $user_id,
            'num_image'  => $num_image,
        );

        $script = $theme->scopeWithLayout('news.jscript_edit', $view)->content();
        $theme->asset()->container('inline_script')->usePath()->writeContent('custom-inline-script', $script);

        return $theme->scopeWithLayout('news.edit', $view)->render();
    }

    public function postEdit()
    {
        $data = Input::all();
        $client = new Client(Config::get('url.siamits-api'));

        $rules = array(
            'action' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return Redirect::to('news')->withErrors($message);
        }

        $action = array_get($data, 'action', null);

        // Delete
        if ($action == 'delete') {
            // Validator request
            $rules = array(
                'id'         => 'required',
                'images'     => 'required',
                'user_id'  => 'required',
                // 'images_old' => 'required',
            );

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $message = array(
                    'message' => $validator->messages()->first(),
                );

                return Redirect::to('news')->withErrors($message);
            }

            $id         = array_get($data, 'id', 0);
            $images     = array_get($data, 'images', '');
            $user_id  = array_get($data, 'user_id', 0);
            $images_old = array_get($data, 'images_old.'.$images, array());
            $extension = array_get($data, 'extension.'.$images, array());

            $delete_file = true;
            if (isset($images_old) && is_array($images_old)) {
                $cate = 'news';
                $path = 'public/uploads/' . $user_id . '/' . $cate; // upload path
                foreach ($images_old as $key => $value) {
                    $image_name = $value.'.'.$extension[$value];
                    $old_file = $path . '/' . $image_name;

                    // Delete old image
                    $delete_file = File::delete($old_file);

                    $parameters = array();
                    $code = $value;
                    $results    = $client->delete('images/'.$code, $parameters);
                    $results    = json_decode($results, true);

                    if ($status_code = array_get($results, 'status_code', false) != '0') {
                        $status_txt = array_get($results, 'status_txt', '');
                        return $client->createResponse($status_txt, $status_code);
                    }
                }
            }

            // Delete news
            $parameters = array(
                'id'        => $id,
                'images'    => $images,
                'user_id' => $user_id,
            );

            $results = $client->delete('news/' . $id, $parameters);
            $results = json_decode($results, true);

            if (array_get($results, 'status_code', false) != '0') {
                $message = array(
                    'message' => array_get($results, 'status_txt', 'Can not delete news'),
                );

                return Redirect::to('news')->withErrors($message);
            }

            $message = array(
                'message' => 'You successfully delete',
            );

            // Order
        } else if ($action == 'order') {
            // Validator request
            $rules = array(
                'id_sel' => 'required',
                'user_id' => 'required',
            );

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $message = array(
                    'message' => $validator->messages()->first(),
                );

                return Redirect::to('news')->withErrors($message);
            }

            $user_id = array_get($data, 'user_id', 0);

            if ($id_sel = array_get($data, 'id_sel', false)) {
                $i = 1;
                foreach ($id_sel as $value) {
                    $id = $value;
                    $parameters2 = array(
                        'user_id' => $user_id,
                        'position' => $i,
                    );

                    $client = new Client(Config::get('url.siamits-api'));
                    $results = $client->put('news/' . $id, $parameters2);
                    $results = json_decode($results, true);

                    $i++;
                }
            }

            if (array_get($results, 'status_code', false) != '0') {
                $message = array(
                    'message' => array_get($results, 'status_txt', 'Can not order news'),
                );

                return Redirect::to('news')->withErrors($message);
            }

            $message = array(
                'message' => 'You successfully order',
            );

            // Edit
        } else {
            // Validator request
            $rules = array(
                'id'              => 'required',
                'ids'             => 'required|min:1',
                'title'           => 'required',
                'sub_description' => 'required',
                'description'     => 'required',
                'images'          => 'required',
                'position'        => 'required',
                'status'          => 'required',
                'type'            => 'required',
                'user_id'       => 'required',
                'category_id'     => 'required',
                'tags'            => 'required',
                // 'views'        => 'required',
                // 'likes'        => 'required',
                // 'share'        => 'required',
                'images_arr'      => 'required',
            );

            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $message = array(
                    'message' => $validator->messages()->first(),
                );

                return Redirect::to('news')->withErrors($message);
            }

            $images_arr = array_get($data, 'images_arr', array());
            $user_id  = array_get($data, 'user_id', 0);

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
            // isset($data['views']) ? $parameters['views'] = $data['views']: '';
            // isset($data['likes']) ? $parameters['likes'] = $data['likes']: '';
            // isset($data['share']) ? $parameters['share'] = $data['share']: '';
            $id = array_get($data, 'id', 0);

            $client = new Client(Config::get('url.siamits-api'));
            $results = $client->put('news/'.$id, $parameters);
            $results = json_decode($results, true);

            if (array_get($results, 'status_code', false) != '0') {
                $message = array(
                    'message' => array_get($results, 'status_txt', 'Can not updated news'),
                );

                return Redirect::to('news')->withErrors($message);
            } else {
                if (isset($images_arr) && is_array($images_arr)) {
                    foreach ($images_arr as $key => $value) {
                        $code      = $key;
                        $parameters = array(
                            'user_id' => $user_id,
                            'type'      => '2',
                        );

                        $results    = $client->put('images/'.$code, $parameters);
                        $results    = json_decode($results, true);

                        if ($status_code = array_get($results, 'status_code', false) != '0') {
                            $message = array_get($results, 'status_txt', '');
                            return Redirect::to('news')->withErrors($message);
                        }
                    }
                }
            }

            $message = array(
                'message' => 'You successfully updated',
            );
            return Redirect::to('news')->withSuccess($message);
        }

        return Redirect::to('news')->withSuccess($message);
    }

    public function postUploads()
    {
        $data = Input::all();

        // Define a destination
        $ids = isset($data['ids']) ? $data['ids'] : '0';
        $user_id = isset($data['user_id']) ? $data['user_id'] : '1';
        $cate = isset($data['cate']) ? $data['cate'] : '';
        $cate_id = isset($data['cate_id']) ? $data['cate_id'] : '';
        $targetFolder = 'public/uploads/' . $user_id . '/' . $cate; // Relative to the root

        $verifyToken = md5('unique_salt' . $data['timestamp']);

        if (!empty($_FILES) && $data['token'] == $verifyToken) {
            $random = rand(0, 9);
            $datetime = date("YmdHis");
            $image_code = $user_id . $cate_id . $datetime . $random;
            //$image_code = base64_encode($image_code);

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $targetFolder;

            // Validate the file type
            $fileTypes   = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            $fileParts   = pathinfo($_FILES['Filedata']['name']);
            $fileNameOld = $_FILES['Filedata']['name'];

            $fileExtension = $fileParts['extension'];
            $fileName      = $image_code . '.' . $fileExtension; // renameing image
            $targetFile    = rtrim($targetPath, '/') . '/' . $fileName;
            

            if (in_array($fileParts['extension'], $fileTypes)) {
                if (move_uploaded_file($tempFile, $targetFile)) {
                    // Add images
                    $parameters = array(
                        'user_id' => $user_id,
                        'ids' => $ids,
                        'ids_type' => $cate_id,
                        'code' => $image_code,
                        'name' => $fileNameOld,
                        'extension' => $fileExtension,
                        'url' => '',
                        'type' => '0',
                        'size' => '0',
                        'width' => '0',
                        'height' => '0',
                        'position' => '0',
                        'status' => '1',
                    );

                    $client = new Client(Config::get('url.siamits-api'));
                    $results = $client->post('images', $parameters);
                    $results = json_decode($results, true);

                    if (array_get($results, 'status_code', false) != '0') {
                        echo 'Errors uploded.';
                    } else {
                        $url_img = Config::get('url.siamits-admin').'/'.$targetFolder.'/'.$image_code.'.'.$fileExtension;
                        
                        $jsons_return = array(
                            'code'      => $image_code,
                            'url'       => $url_img,
                            'extension' => $fileExtension,
                            'user_id' => $user_id,
                        );
                        echo json_encode($jsons_return);
                    }
                } else {
                    echo 'Errors uploded.';
                }
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function getDeleteImage()
    {
        $data = Input::all();
        $client = new Client(Config::get('url.siamits-api'));

        $response = array(
            'data' => $data,
        );

        // Validator request
        $rules = array(
            'code'      => 'required',
            'user_id' => 'required',
            'extension' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return $client->createResponse($response, 1003);
        }

        $code      = array_get($data, 'code', 0);
        $extension = array_get($data, 'extension', 0);
        $user_id = array_get($data, 'user_id', 0);
        $cate      = 'news';
        $path      = 'public/uploads/' . $user_id . '/' . $cate; // upload path
        $file_path = $path . '/' . $code .'.'. $extension;

        // Delete image
        $delete_file = File::delete($file_path);
  
        $parameters = array();
        $results    = $client->delete('images/'.$code, $parameters);
        $results    = json_decode($results, true);

        if ($status_code = array_get($results, 'status_code', false) != '0') {
            $status_txt = array_get($results, 'status_txt', '');
            return $client->createResponse($status_txt, $status_code);
        }


        return $client->createResponse($response, 0);
    }

    public function getTags()
    {
        $data = Input::all();
        $client = new Client(Config::get('url.siamits-api'));

        // Validator request
        $rules = array(
            'term' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return json_encode(false);
        }

        $search = array_get($data, 'term', 0);
  
        $parameters = array(
            'search' => urlencode($search),
        );
        $results    = $client->get('tags', $parameters);
        $results    = json_decode($results, true);

        if ($status_code = array_get($results, 'status_code', false) != '0') {
            return json_encode(false);
        }

        $results = array_get($results, 'data.record', array());

        $entry = array();
        foreach ($results as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($key2 == 'title') {
                    $entry[] = $value2;
                }
            }
        }

        return json_encode($entry);
    }
}
