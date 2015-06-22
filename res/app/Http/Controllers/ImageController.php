<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\Facades\Image;
// use Imagine\Image\Box;
// use Imagine\Image\ImageInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Validator;

class ImageController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function getImage($user_id = null, $code = null, $extension = null, $width = null, $height = null, $name = 'siamits.jpg')
    {
        $data['user_id'] = $user_id;
        $data['code'] = $code;
        $data['extension'] = strtolower($extension);
        $data['width'] = $width;
        $data['height'] = $height;

        // Validator request
        $rules = array(
            'user_id' => 'required|integer|min:1',
            'code' => 'required',
            'extension' => 'required|in:jpg,png,gif',
            'width' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return $message;
        }

        // Make a new response out of the contents of the file
        // We refactor this to use the image resize function.
        // Set the response status code to 200 OK
        $filepath = $user_id . '/' . $code . '.' . $extension;

        $response = response()->make(
            Image::resize($user_id, $code, $extension, $width, $height, $name),
            200
        );

        // Set the mime type for the response.
        // We now use the Image class for this also.
        $response->header(
            'content-type',
            Image::getMimeType($filepath)
        );

        // We return our image here.
        return $response;
    }

    public function getImage2($user_id = null, $code = null, $extension = null, $width = null, $height = null, $name = 'siamits.jpg')
    {
        $data['user_id'] = $user_id;
        $data['code'] = $code;
        $data['extension'] = strtolower($extension);
        $data['width'] = $width;
        $data['height'] = $height;

        // Validator request
        $rules = array(
            'user_id' => 'required|integer|min:1',
            'code' => 'required',
            'extension' => 'required|in:jpg,png,gif',
            'width' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return $message;
        }

        // Make a new response out of the contents of the file
        // We refactor this to use the image resize function.
        // Set the response status code to 200 OK
        $filepath = $user_id . '/' . $code . '.' . $extension;

        // $response = response()->make(
        //     Image::resize($user_id, $code, $extension, $width, $height, $name),
        //     200
        // );

        // File doesn't exist yet, so we will resize the original.
        $inputDir = Config::get('assets.images.paths.input');
        $sourceFilename = $inputDir . '/' . $user_id . '/' . $code . '.' . $extension;

        $response = response()->make(
            Image::resizeToFit($width, $height, $sourceFilename),
            200
        );

        // Set the mime type for the response.
        // We now use the Image class for this also.
        $response->header(
            'content-type',
            Image::getMimeType($filepath)
        );

        // We return our image here.
        return $response;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function getImg($section = null, $code = null, $extension = null, $width = null, $height = null, $name = 'siamits.jpg')
    {
        $data['section'] = $section;
        $data['code'] = $code;
        $data['extension'] = strtolower($extension);
        $data['width'] = $width;
        $data['height'] = $height;

        // Validator request
        $rules = array(
            'section' => 'required',
            'code' => 'required',
            'extension' => 'required|in:jpg,png,gif',
            'width' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message = array(
                'message' => $validator->messages()->first(),
            );

            return $message;
        }

        // Make a new response out of the contents of the file
        // We refactor this to use the image resize function.
        // Set the response status code to 200 OK
        $filepath = 'assets/images/' . $section . '/' . $code . '.' . $extension;

        $response = response()->make(
            Image::resize2($section, $code, $extension, $width, $height, $name),
            200
        );

        // Set the mime type for the response.
        // We now use the Image class for this also.
        $response->header(
            'content-type',
            Image::getMimeType($filepath)
        );

        // We return our image here.
        return $response;
    }
}
