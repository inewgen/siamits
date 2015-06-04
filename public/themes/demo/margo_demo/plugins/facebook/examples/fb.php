<?php

require_once '../src/facebook.php';

$facebook = new Facebook(array(
    'appId' => '556319527843404',
    'secret' => '972805146ea8b4546d01d6ed06402bf7',
));

$facebook = new Facebook($config);

$user_id = $facebook->getUser();

?>

<html>

<head></head>

<body>

<?php

if ($user_id) {

    try {

        $ret_obj = $facebook->api('/me/feed', 'POST',

            array(

                'link' => 'http://www.siamits.com/',

                'message' => '@daydev บัญญพนต์ พูลสวัสดิ์ เจ้าของเว็บไซต์ www.daydev.com เว็บไซต์รวบรวม บทความออนไลน์ สำหรับนักพัฒนาด้าน Development, Integration และ Augmented Reality แห่งแรกของประเทศไทย ',

                'photo' => 'http://www.siamits.com/public/themes/default/assets/img/comingsoon.png',

            ));

        echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';

    } catch (FacebookApiException $e) {

        $login_url = $facebook->getLoginUrl(array(

            'scope' => 'publish_stream',
            'app_id' => '556319527843404',

        ));

        echo 'Please <a href="' . $login_url . '">login.</a>';

        error_log($e->getType());

        error_log($e->getMessage());

    }

    echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';

} else {
  $param_url = array(

            'scope' => 'publish_stream',
            'app_id' => '556319527843404',

        );

    $login_url = $facebook->getLoginUrl($param_url);

    echo 'Please <a href="' . $login_url . '">login.</a>';

}

?>

</body>

</html>