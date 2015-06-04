<?php
    
if (ENV_MODE == 'dev') {
    return array(
        "base_url" => "http://www.siamits.dev/gauth/auth",
        "providers" => array(
            "Google" => array(
                "enabled" => true,
                "keys" => array(
                    "id" => "598465371184-mbc0mkjqgbeamf97j809dhoq8npkoeqf.apps.googleusercontent.com",
                    "secret" => "TqD-HevZa_ZuWd-d8GfaRshg"),
                "scope" => "https://www.googleapis.com/auth/userinfo.profile " . // optional
                "https://www.googleapis.com/auth/userinfo.email",
            )
        )
    );
} else {
    return array(
        "base_url" => "http://www.siamits.com/gauth/auth",
        "providers" => array(
            "Google" => array(
                "enabled" => true,
                "keys" => array(
                    "id" => "937095495765-ffnmq4j6rs7b8n20a577oie849oc41s9.apps.googleusercontent.com",
                    "secret" => "8NVl6-RFUnUOn5C7NdYn0RMR"),
                "scope" => "https://www.googleapis.com/auth/userinfo.profile " . // optional
                "https://www.googleapis.com/auth/userinfo.email",
            )
        )
    );
}