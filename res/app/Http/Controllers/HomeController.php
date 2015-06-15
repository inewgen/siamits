<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $url = array_get($data, 'url', '');

        if (empty($url)) {
            $url = 'public/uploads/assets/img/no-image.jpg';
        }
        $view = array(
            'url' => $url
        );

        return view('image.index', $view);
    }
}