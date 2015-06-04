<?php

if (ENV_MODE == 'dev') {
        return array(
            "base_url" => "http://www.siamits.dev/fbauth/auth",
            "providers" => array (
                "Facebook" => array (
                    "enabled" => TRUE,
                    "keys" => array (
                        "id" => "1135073753185827", 
                        "secret" =>"f8b9cd2dfa4b649fb4347a13beb46c99"
                    ),
                    "scope" => "public_profile,email"
                )
            )
        );
    } else {
        return array(
            "base_url" => "http://www.siamits.com/fbauth/auth",
            "providers" => array (
                "Facebook" => array (
                    "enabled" => TRUE,
                    "keys" => array (
                    	"id" => "556319527843404", 
                    	"secret" =>"972805146ea8b4546d01d6ed06402bf7"
                    ),
                    "scope" => "public_profile,email"
                )
            )
        );
}