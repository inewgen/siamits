<?php

if (ENV_MODE == 'dev') {
    return array(
        'siamits-web'   => 'http://www.siamits.dev',
        'siamits-admin' => 'http://admins.siamits.dev',
        'siamits-api'   => 'http://apis.siamits.dev/api/',
    );
} else {
    return array(
        'siamits-web'   => 'http://www.siamits.com',
        'siamits-admin' => 'http://admins.siamits.com',
        'siamits-api'   => 'http://apis.siamits.com/api/',
    );
}
