<?php

// // Gmail
// return array(
//     'driver'     => 'smtp',
//     'host'       => 'smtp.gmail.com',
//     'port'       => 465,
//     'from'       => array('address' => 'care.siamits@gmail.com', 'name' => 'SiamiTs.com'),
//     'encryption' => 'ssl',
//     'username'   => 'care.siamits@gmail.com',
//     'password'   => 'Scs@072272571',
//     'sendmail'   => '/usr/sbin/sendmail -bs',
//     'pretend'    => false,
// );

// Hostinger
return array(
    'driver'     => 'smtp',
    'host'       => 'mx1.hostinger.in.th',
    'port'       => 465,
    'from'       => array('address' => 'no-reply@siamits.com', 'name' => 'SiamiTs.com'),
    'encryption' => 'ssl',
    'username'   => 'no-reply@siamits.com',
    'password'   => 'Scs@072272571',
    'sendmail'   => '/usr/sbin/sendmail -bs',
    'pretend'    => false,
);

// // Mailgun #1
// return array(
//     'driver'     => 'smtp',
//     'host'       => 'smtp.mailgun.org',
//     'port'       => 587,
//     'from'       => array('address' => 'no-reply@siamits.com', 'name' => 'SiamiTs.com'),
//     'encryption' => 'tls',
//     'username'   => 'postmaster@sandboxf91d72ec42d84027904e56073b2c6ebd.mailgun.org',
//     'password'   => 'e388503ce16a9e0372bb4636802e19a1',
//     'sendmail'   => '/usr/sbin/sendmail -bs',
//     'pretend'    => false,
// );

// // Mailgun #2
// return array(
//     'driver'     => 'smtp',
//     'host'       => 'smtp.mailgun.org',
//     'port'       => 587,
//     'from'       => array('address' => 'postmaster@siamits.com', 'name' => 'SiamiTs.com'),
//     'encryption' => 'tls',
//     'username'   => 'postmaster@siamits.com',
//     'password'   => '664127c1f7ad7a3e4790556067ff0a50',
//     'sendmail'   => '/usr/sbin/sendmail -bs',
//     'pretend'    => false,
// );
