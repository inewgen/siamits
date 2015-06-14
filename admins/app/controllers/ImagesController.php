<?php

class ImagesController extends BaseController
{

    private $scode;

    public function __construct(Scode $scode)
    {
        $this->scode = $scode;
    }

    public function uploads()
    {
        $data = Input::all();
        $client = new Client(Config::get('url.siamits-api'));

        // Validator request
        $rules = array(
            'user_id' => 'required',
            'token' => 'required',
            'timestamp' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = $validator->messages()->first();

            echo 'Invalid parameters, '.$message;
        }

        // Define a destination
        $user_id = isset($data['user_id']) ? $data['user_id'] : '';
        $targetFolder = 'public/uploads/' . $user_id ; // Relative to the root
        $verifyToken = md5(Config::get('web.siamits-keys') . $data['timestamp']);

        if (!empty($_FILES) && $data['token'] == $verifyToken) {
            $image_code = $this->scode->imageCode();

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $targetFolder;

            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777);
            }

            // Validate the file type
            $fileTypes   = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG'); // File extensions
            $fileParts   = pathinfo($_FILES['Filedata']['name']);
            $fileNameOld = $_FILES['Filedata']['name'];

            $fileExtension = $fileParts['extension'];
            $fileName      = $image_code . '.' . $fileExtension; // renameing image
            $targetFile    = rtrim($targetPath, '/') . '/' . $fileName;

            if (in_array($fileParts['extension'], $fileTypes)) {
                $uploadSuccess = Input::file('Filedata')->move($targetPath, $fileName);
                if ($uploadSuccess) {
                // if (move_uploaded_file($tempFile, $targetFile)) {
                    // Add images
                    $parameters = array(
                        'code'      => $image_code,
                        'name'      => $fileNameOld,
                        'extension' => $fileExtension,
                        'url'       => '',
                        'type'      => '0',
                        'size'      => '0',
                        'width'     => '0',
                        'height'    => '0',
                        'position'  => '0',
                        'status'    => '1',
                        'user_id'   => $user_id,
                    );

                    $results = $client->post('images', $parameters);
                    $results = json_decode($results, true);
                    
                    if (array_get($results, 'status_code', false) != '0') {
                        $response = array(
                            'data' => 'Errors insert image.',
                        );
                        return $client->createResponse($response, 2001);
                    } else {
                        $url_img = Config::get('url.siamits-admin').'/'.$targetFolder.'/'.$image_code.'.'.$fileExtension;
                        $id = array_get($results, 'id', '');

                        $jsons_return = array(
                            'id'        => $id,
                            'code'      => $image_code,
                            'url'       => $url_img,
                            'extension' => $fileExtension,
                            'user_id'   => $user_id,
                        );
                        
                        $response = array(
                            'data' => $jsons_return,
                        );
                        return $client->createResponse($response, 0);
                    }
                } else {
                    $response = array(
                        'data' => 'Can not upload file',
                    );
                    return $client->createResponse($response, 2001);
                }
            } else {
                $response = array(
                    'data' => 'Invalid file type.',
                );
                return $client->createResponse($response, 2001);
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
            'id'        => 'required',
            'code'      => 'required',
            'user_id'   => 'required',
            'extension' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return $client->createResponse($response, 1003);
        }

        $id        = array_get($data, 'id', 0);
        $code      = array_get($data, 'code', 0);
        $extension = array_get($data, 'extension', 0);
        $user_id   = array_get($data, 'user_id', 0);
        $path      = 'public/uploads/' . $user_id; // upload path
        $file_path = $path . '/' . $code .'.'. $extension;

        if (!file_exists($file_path)) {
            return $client->createResponse($data, 1004);
        }

        // Delete image
        $delete_file = File::delete($file_path);
  
        $parameters = array();
        $results    = $client->delete('images/'.$id, $parameters);
        $results    = json_decode($results, true);

        if ($status_code = array_get($results, 'status_code', false) != '0') {
            $status_txt = array_get($results, 'status_txt', '');
            return $client->createResponse($status_txt, $status_code);
        }


        return $client->createResponse($response, 0);
    }
}
