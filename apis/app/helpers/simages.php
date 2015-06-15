<?php
class Simages
{
    public function loopImages($data = array(), $user_id, $section = '')
    {
        //Loop images
        $images = array();
        foreach ($data as $key3 => $value3) {

            $w_h = array(200, 200);
            if ($section == 'banners') {
                $w_h = array(1440, 500);
            }

            $file_name = $value3['code'] . '.' . $value3['extension'];
            $image['id'] = $value3['id'];
            $image['code'] = $value3['code'];
            $image['extension'] = $value3['extension'];
            $image['name'] = $value3['name'];
            $image['url'] = self::getImageLink('images', $value3['user_id'], $value3['code'], $value3['extension'], $w_h[0], $w_h[1], $value3['name']);
            $image['position'] = $value3['position'];
            $image['user_id'] = $value3['user_id'];
            $images[] = $image;
        }

        return $images;
    }

    // img|image, default|user_id, array(), 100, 100
    public function getImageLink($type, $section, $code, $extension, $w, $h, $name = 'siamits.jpg')
    {
        if (empty($type) || empty($section) || empty($code) || empty($extension)) {
            return false;
        }

        $siamits_res = Config::get('url.siamits-res');

        if ($type == 'img') {
            return $siamits_res . '/img/' . $section . '/' . $code . '/' . $extension . '/' . $w . '/' . $h . '/' . $name;
        }
        $user_id = $section;

        return $siamits_res . '/image/' . $user_id . '/' . $code . '/' . $extension . '/' . $w . '/' . $h . '/' . $name;
    }

    public function getImageProfile($user, $w, $h)
    {
        if (empty($user) || empty($w) || empty($h)) {
            return false;
        }

        $siamits_res = Config::get('url.siamits-res');
        $user_id = $user->id;
        $code = $user->images[0]->code;
        $extension = $user->images[0]->extension;
        $name = 'profile.jpg';

        return $siamits_res . '/image/' . $user_id . '/' . $code . '/' . $extension . '/' . $w . '/' . $h . '/' . $name;
    }

    public function getLogo($w, $h)
    {
        if (empty($w) || empty($h)) {
            return false;
        }
        $siamits_res = Config::get('url.siamits-res');
        $name = 'logo.jpg';

        return $siamits_res . '/img/default/siamits_logo/png/' . $w . '/' . $h . '/' . $name;
    }
}
