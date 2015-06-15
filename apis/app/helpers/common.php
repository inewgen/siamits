<?php


/**
 * [mksize description]
 * @param  [type] $bytes [description]
 * @return [type]        [description]
 */
if (!function_exists('mksize')) {
    function mksize($bytes)
    {
        if ($bytes < 1000 * 1024) {
            return number_format($bytes / 1024, 2) . " KB";
        } elseif ($bytes < 1000 * 1048576) {
            return number_format($bytes / 1048576, 2) . " MB";
        } elseif ($bytes < 1000 * 1073741824) {
            return number_format($bytes / 1073741824, 2) . " GB";
        } else {
            return number_format($bytes / 1099511627776, 2) . " TB";
        }
    }
}

/**
 * [getImageSizeCDN description]
 * @param  [type] $url     [description]
 * @param  [type] $width   [description]
 * @param  [type] $height  [description]
 * @param  array  $options [description]
 * @return [type]          [description]
 */
if (!function_exists('getImageSizeCDN')) {
    function getImageSizeCDN($url, $width, $height, $options = array())
    {
        $url = "http://i.weloveshopping.com/image/api.php?src=$url&w=$width&h=$height";

        return $url;
    }
}

/**
 * post json format
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('requestJson')) {
    function requestJson($url, $post, $request = 'GET')
    {
        $content = json_encode($post);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'SugarConnector/1.4');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($content)));
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "$request");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($curl);
        $errorno = curl_errno($curl);
        $errormsg = curl_error($curl);
        curl_close($curl);

        return $response;
    }
}

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getStatusText')) {
    function getStatusText($value)
    {
        $lang = array('0' => 'false', '1' => 'true');

        return $lang[$value];
    }
}

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getStatusId')) {
    function getStatusId($value)
    {
        $lang = array('false' => 0, 'true' => 1);

        return $lang[$value];
    }
}

if (!function_exists('getInventoriesPublishText')) {
    function getInventoriesPublishText($value)
    {
        $lang = array('0' => 'false', '1' => 'true');

        return $lang[$value];
    }
}

if (!function_exists('getInventoriesPublishId')) {
    function getInventoriesPublishId($value)
    {
        $lang = array('false' => 0, 'true' => 1);

        return $lang[$value];
    }
}

/** use approve document **/
if (!function_exists('getMonitorStatusId')) {
    function getMonitorStatusId($value)
    {

        $lang = array('pendding' => 0, 'processing' => 1, 'waiting' => 2, 'approved' => 3, 'reject' => 4);

        return isset($lang[$value]) ? $lang[$value] : '';
    }
}

/** use approve document **/
if (!function_exists('getMonitorStatusText')) {
    function getMonitorStatusText($value=0)
    {

        $lang = array('0' => 'pendding', '1' => 'processing', '2' => 'waiting', '3' => 'approved', '4' => 'reject');
        if ($value==0) {
            return $lang[0];
        }

        return isset($lang[$value]) ? $lang[$value] : '';
    }
}

/** use approve document **/
if (!function_exists('getApprovedStatusId')) {
    function getApprovedStatusId($value)
    {

        $lang = array('waiting' => 0, 'processing' => 1,'approved'=> 2, 'reject' => 3,'banned' => 4);

        return isset($lang[$value]) ? $lang[$value] : '';
    }
}

/** use approve document **/
if (!function_exists('getApprovedStatusText')) {
    function getApprovedStatusText($value=0)
    {

        $lang = array('0' => 'waiting', '1' => 'processing', '2' => 'approved', '3' => 'reject', '4' => 'banned');
        if ($value==0) {
            return $lang[0];
        }

        return isset($lang[$value]) ? $lang[$value] : '';
    }
}

if (!function_exists('getBusinessTypeId')) {
    function getBusinessTypeId($value)
    {
        $lang = array('individual' => 1, 'business' => 2);

        return $lang[$value];
    }
}

if (!function_exists('getBusinessTypeText')) {
    function getBusinessTypeText($value)
    {
        $lang = array('1' => 'individual', '2' => 'business');

        return $lang[$value];
    }
}

/**
 * get status id for approve status
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getDocumentTypeId')) {
    function getDocumentTypeId($value)
    {
        $lang = array('register' => 1, 'ccw' => 2);
        $id = isset($lang[$value]) ? $lang[$value] : false;

        return $id;
    }
}
/**
 * get status text for approve status
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getDocumentTypeText')) {
    function getDocumentTypeText($value)
    {
        $lang = array('1' => 'register', '2' => 'ccw');
        $text = isset($lang[$value]) ? $lang[$value] : false;

        return $text;
    }
}

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getTaxableText')) {
    function getTaxableText($value)
    {
        $lang = array('false' => 0, 'true' => 1);

        return $lang[$value];
    }
}

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getTutorialConfig')) {
    function getTutorialConfig($value = null)
    {
        $current_url = Request::fullUrl();
        $config = array(
            'knowledge' => array(
                'name' => _s('Knowledge'),
                'path_script' => 'tutorial',
                'prev_step' => '',
                'next_step_name' => _s('Shop Information'),
                'next_step' => 'store',
                'desc' => _s('Knowledge description tooltips'),
                'icon' => 'icon-file-alt white icon-2x',
                'img' => 'sign-tutorial.png'
                ),
            'setting' => array(
                'name' => _s('Shop Information'),
                'path_script' => 'store',
                'prev_step' => 'knowledge',
                'next_step_name' => _s('Add product'),
                'next_step' => 'product/create',
                'desc' => _s('Shop Information description tooltips'),
                'icon' => 'icon-list-alt white icon-2x',
                'img' => 'sign-shopinfo.png'
                ),
            'category' => array(
                'name' => _s('Category'),
                'path_script' => 'category/create',
                'prev_step' => 'setting',
                'next_step_name' => _s('Add product'),
                'next_step' => 'product/create',
                'desc' => _s('Category description tooltips'),
                'icon' => 'icon-sitemap white icon-2x',
                'img' => 'sign-category.png'
                ),
            'open' => array(
                'name' => _s('Open shop'),
                'path_script' => 'setting',
                'prev_step' => 'shipping',
                'next_step_name' => '',
                'next_step' => '',
                'desc' => _s('Open shop description tooltips'),
                'icon' => 'icon-home white icon-2x',
                'img' => 'sign-openshop.png'
                ),
            'store' => array(
                'name' => 'Manage shop information',
                'path_script' => 'admin/store',
                'prev_step' => '',
                'next_step_name' => 'Register truemoney account',
                'next_step' => 'admin/payment',
                'desc' => 'Manage shop information description tooltips',
                'class' => 'step1',
                'icon' => ''
                ),
            'payment' => array(
                'name' => 'Register truemoney account',
                'path_script' => 'admin/payment',
                'prev_step' => 'store',
                'next_step_name' => 'Manage product',
                'next_step' => 'admin/product/create',
                'desc' => 'Register truemoney account description tooltips',
                'class' => 'step2',
                'icon' => ''
                ),
            'product' => array(
                'name' => 'Manage product',
                'path_script' => 'admin/product/create',
                'prev_step' => 'payment',
                'next_step_name' => 'Shipping setting',
                'next_step' => 'shipping',
                'desc' => 'Manage product description tooltips',
                'class' => 'step3',
                'icon' => ''
                ),
            'p_quickedit' => array(
                'name' => 'Quick Edit product',
                'path_script' => 'admin/product',
                'prev_step' => '',
                'next_step_name' => '',
                'next_step' => '',
                'desc' => 'Quick Edit product description tooltips',
                'class' => '',
                'icon' => ''
                ),
            'shipping' => array(
                'name' => 'Shipping setting',
                'path_script' => 'admin/shipping',
                'prev_step' => 'product',
                'next_step_name' => '',
                'next_step' => '',
                'desc' => _s('Shipping setting description tooltips'),
                'class' => 'step4',
                'icon' => ''
                ),
        );

        return (isset($config[$value])) ? $config[$value] : $config;
    }
}

/**
 * Print the given value and kill the script.
 *
 * @param  mixed  $value
 * @return void
 */
if (!function_exists('getTaxableId')) {
    function getTaxableId($value)
    {
        $lang = array('false' => 0, 'true' => 1);

        return $lang[$value];
    }
}

/**
 * [getInventoryManagementText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getInventoryManagementText')) {
    function getInventoryManagementText($value)
    {
        $lang = array('0' => 'blank', '1' => 'track');

        return $lang[$value];
    }
}

/**
 * [getInventoryManagementId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getInventoryManagementId')) {
    function getInventoryManagementId($value)
    {
        $lang = array('blank' => 0, 'track' => 1);

        return $lang[$value];
    }
}

/**
 * [getInventoryManagementText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getInventoryPolicyText')) {
    function getInventoryPolicyText($value)
    {
        $lang = array('0' => 'deny', '1' => 'continue');

        return $lang[$value];
    }
}

/**
 * [getInventoryManagementId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getInventoryPolicyId')) {
    function getInventoryPolicyId($value)
    {
        $lang = array('deny' => 0, 'continue' => 1);

        return $lang[$value];
    }
}

/**
 * [getRequiresShippingText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getRequiresShippingText')) {
    function getRequiresShippingText($value)
    {
        $lang = array('0' => 'false', '1' => 'true');

        return $lang[$value];
    }
}

/**
 * [getRequiresShippingId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getRequiresShippingId')) {
    function getRequiresShippingId($value)
    {
        $lang = array('false' => 0, 'true' => 1);

        return $lang[$value];
    }
}

/**
 * [getProductTypeText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getProductTypeText')) {
    function getProductTypeText($value)
    {
        $lang = array('1' => 'new', '2' => 'used');

        return $lang[$value];
    }
}

/**
 * [getProductTypeId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getProductTypeId')) {
    function getProductTypeId($value)
    {
        $lang = array('new' => 1, 'used' => 2);

        return $lang[$value];
    }
}

/**
 * [getProductPriceStatusText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getProductPriceStatusText')) {
    function getProductPriceStatusText($value)
    {
        $lang = array('0' => 'false', '1' => 'true');

        return $lang[$value];
    }
}

/**
 * [getProductPriceStatusId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getProductPriceStatusId')) {
    function getProductPriceStatusId($value)
    {
        $lang = array('false' => 0, 'true' => 1);

        return $lang[$value];
    }
}

/**
 * [getRateShippingTypeText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getRateShippingTypeText')) {
    function getRateShippingTypeText($value)
    {
        $lang = array('1' => 'price', '2' => 'weight', '3'=>'amount' , '4'=>'flat');

        return $lang[$value];
    }
}

/**
 * [getRateShippingTypeId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getRateShippingTypeId')) {
    function getRateShippingTypeId($value)
    {
        $lang = array('price' => 1, 'weight' => 2 , 'amount'=>3 , 'flat'=>4);

        return $lang[$value];
    }
}

/**
 * [getCollectionTypeText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getCollectionTypeText')) {
    function getCollectionTypeText($value)
    {
        $lang = array('1' => 'custom', '2' => 'smart');

        return isset($lang[$value]) ? $lang[$value] : 'custom';
    }
}

/**
 * [getCollectionTypeId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getCollectionTypeId')) {
    function getCollectionTypeId($value)
    {
        $lang = array('custom' => 1, 'smart' => 2);

        return isset($lang[$value]) ? $lang[$value] : 1;
    }
}

/**
 * [getCurrencyPaysBuy description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getCurrencyPaysBuy')) {
    function getCurrencyPaysBuy()
    {
        $currency = array(
            'Thai Baht' => 'TH',
            'Australian Dollar' => 'AU',
            'POUND STERLING' => 'GB',
            'EURO' => 'EU',
            'Hong Kong Dollar' => 'HK',
            'YEN (100)' => 'JP',
            'New Zealand Dollar' => 'NZ',
            'Singapore Dollar' => 'SG',
            'Swiss Franc' => 'CH',
            'US Dollar' => 'US'
        );

        return $currency;
    }
}

/**
 * [getCurrencyPayPal description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getCurrencyPayPal')) {
    function getCurrencyPayPal()
    {
        $currency = array(
            'Australian Dollar' => 'AUD',
            'Brazilian' => 'BRL',
            'Canadian Dollar' => 'CAD',
            'Czech Koruna' => 'CZK',
            'Danish Krone' => 'DKK',
            'Euro' => 'EUR',
            'Hong Kong Dollar' => 'HKD',
            'Hungarian Forint' => 'HUF',
            'Israeli New Sheqel' => 'ILS',
            'Japanese Yen' => 'JPY',
            'Malaysian Ringgit' => 'MYR',
            'Mexican Peso' => 'MXN',
            'Norwegian Krone' => 'NOK',
            'New Zealand Dollar' => 'NZD',
            'Philippine Peso' => 'PHP',
            'Polish Zloty' => 'PLN',
            'Pound Sterling' => 'GBP',
            'Singapore Dollar' => 'SGD',
            'Swedish Krona' => 'SEK',
            'Swiss Franc' => 'CHF',
            'Taiwan New Dollar' => 'TWD',
            'Thai Baht' => 'THB',
            'Turkish Lira' => 'TRY',
            'U.S. Dollar' => 'USD'
        );

        return $currency;
    }
}

/**
 * [getBankAccountType description]
 * @param  [type] $type [description]
 * @return [type]        [description]
 */
if (!function_exists('getBankAccountType')) {
    function getBankAccountType()
    {
        $type = array(
            'saving' => 'Saving',
            'fixed_account' => 'Fixed Account',
            'current_deposit' => 'Current Deposit',
        );

        return $type;
    }
}

/**
 * [getBankAccountType description]
 * @param  [type] $type [description]
 * @return [type]        [description]
 */
if (!function_exists('getBankAccountCode')) {
    function getBankAccountCode()
    {
        $bankcode_desc["SCB"] = "Siam Commercial Bank Public Company Limited";
        $bankcode_desc["BBL"] = "Bangkok Bank Public Company Limited";
        $bankcode_desc["KBANK"] = "Kasikornbank Public Company Limited";
        $bankcode_desc["BAY"] = "Bank of Ayudhya Public Company Limited ";
        $bankcode_desc["SCIB"] = "Siam City Bank Public Company Limited";
        $bankcode_desc["TMB"] = "TMB Bank Public Company Limited";
        $bankcode_desc["KTB"] = "Krung Thai Bank Public Company Limited";
        $bankcode_desc["UOB"] = "United Overseas Bank (Thai) PCL";
        $bankcode_desc["HSBC"] = "Hong Kong & Shanghai Corporation Limited";
        $bankcode_desc["BT"] = "BANKTHAI Public Company Limited";
        $bankcode_desc["TBANK"] = "Thanachart Bank Public Company Limited";
        $bankcode_desc["SCBT"] = "Standard Chartered Bank (Thai) Public Company Limited";
        $bankcode_desc["CTB"] = "Citibank N.A.";

        return $bankcode_desc;
    }
}

/**
 * [getOrderStatus description]
 * @return [type] [description]
 */
if (!function_exists('getOrderStatus')) {
    function getOrderStatus()
    {
        $order_status = array(0 => 'initial', 1 => 'wait', 2 => 'checking', 3 => 'success', 4 => 'fail', 5 => 'pending', 6 => 'cancel');

        return $order_status;
    }
}

/**
 * [resize_url description]
 * @param  [type] $store_id [description]
 * @param  [type] $source   [description]
 * @param  [type] $name     [description]
 * @param  array  $options1 [description]
 * @param  array  $options2 [description]
 * @return [type]           [description]
 */
if (!function_exists('resize_url')) {
    function resize_url($store_id, $source, $name, $options1 = array(), $options2 = array())
    {
        $opt1 = '';
        $opt2 = '';
        $basic_params = array("w" => "width", "h" => "height", "c" => "crop", "g" => "gravity");

        if (count($options1) > 0) {
            foreach ($basic_params as $k => $v) {
                if (isset($options1[$k])) {
                    $opt1[] = $k . '_' . $options1[$k];
                }
            }
            // default params
            if (empty($options1['c'])) {
                $opt1[] = 'c_thumb';
            }

            $opt1 = implode(',', $opt1);
        }

        if (count($options2) > 0) {
            foreach ($basic_params as $k => $v) {
                if (isset($options2[$k])) {
                    $opt2[] = $k . '_' . $options2[$k];
                }
            }
            // default params
            if (empty($options2['c'])) {
                $opt2[] = 'c_thumb';
            }

            $opt2 = implode(',', $opt2);
            $opt2 = '/' . $opt2;
        }

        $_source = explode('.', $source);
        $source_name = $_source[0];
        $source_ext = $_source[1];

        $url = 'http://res.weloveshopping.com/' . $store_id . '/' . $opt1 . $opt2 . '/' . $source_name . '/' . $name . '.' . $source_ext;

        return $url;
    }
}

if (!function_exists('store_url')) {

    function store_url($lang = false)
    {
        $url = lang_url($lang);

        return URL::to($url);
    }

}

if (!function_exists('category_url')) {

    function category_url($data = false, $lang = false)
    {
        if (isset($data['id'])) {
            $url = lang_url($lang) . 'category/' . $data['id'];
        } else {
            $url = lang_url($lang) . 'category';
        }

        return URL::to($url);
    }

}

if (!function_exists('product_url')) {

    function product_url($data, $lang = false)
    {
        if (isset($data['id'])) {
            $url = lang_url($lang) . 'products/' . $data['id'];
        } else {
            $url = lang_url($lang) . 'products';
        }

        return URL::to($url);
    }

}

if (!function_exists('blog_url')) {

    function blog_url($data = false, $lang = false)
    {
        if (isset($data['id'])) {
            $url = lang_url($lang) . 'blogs/' . $data['id'];
        } else {
            $url = lang_url($lang) . 'blogs';
        }

        return URL::to($url);
    }

}

if (!function_exists('page_url')) {

    function page_url($data = false, $lang = false)
    {
        if (isset($data['id'])) {
            $url = lang_url($lang) . 'pages/' . $data['id'];
        } else {
            $url = lang_url($lang) . 'pages';
        }

        return URL::to($url);
    }

}

if (!function_exists('collection_url')) {

    function collection_url($data = false, $lang = false)
    {
        if (isset($data['id'])) {
            $url = lang_url($lang) . 'collections/' . $data['id'];
        } else {
            $url = lang_url($lang) . 'collections';
        }

        return URL::to($url);
    }

}

if (!function_exists('search_url')) {

    function search_url($data = false, $lang = false)
    {
        if (isset($data['id'])) {
            $url = lang_url($lang) . 'search/' . $data['id'];
        } else {
            $url = lang_url($lang) . 'search';
        }

        return URL::to($url);
    }

}

if (!function_exists('tag_url')) {

    function tag_url()
    {

    }

}

if (!function_exists('navication_url')) {

    function navication_url($data = false, $lang = false)
    {
        if (!isset($data['type'])) {
            return false;
        }

        $url = false;

        $_data = array(
                    'store_id' => $data['store_id'],
                    'id' => $data['value']
                );

        switch ($data['type']) {
            case 'page':
                $url = page_url($_data, $lang);
                break;
            case 'collection':
                $url = collection_url($_data, $lang);
                break;
            case 'blog':
                $url = blog_url($_data, $lang);
                break;
            case 'search':
                $url = search_url($_data, $lang);
                break;
            case 'http':
                $url = URL::to($data['value']);
                break;
            case 'frontpage':
                $url = store_url($lang);
                break;
        }

        return $url;
    }

}

if (!function_exists('current_url')) {

    function current_url($lang = false, $default_lang = false)
    {
        if (getLangId($lang) == '') {
            $lang = false;
        }

        $segment_1 = Request::segment(1);
        $segment_language = $segment_1;
        $url = Request::fullUrl();

        if (getLangId($segment_language) == '') {
            $segment_language = false;
        }

        if (getLangId($default_lang) == '') {
            $default_lang = false;
        }

        if ($segment_language && $lang && ($lang == $default_lang)) {
            $url = str_replace("/" . $segment_language, "", $url);
        } elseif ($segment_language && $lang) {
            $url = str_replace("/" . $segment_language, "/" . $lang, $url);
        } elseif ($lang && ($lang == $default_lang)) {
            if ($segment_language) {
                $url = str_replace("/" . $segment_1, "/" . $lang, $url);
            } else {
                $url = str_replace("/" . $lang, "", $url);
            }
        } elseif ($lang && !$segment_language) {
            if ($segment_1) {
                $url = str_replace("/" . $segment_1, "/" . $lang . "/" . $segment_1, $url);
            } else {
                $url .= '/' . $lang;
            }
        }

        return URL::to($url);
    }

}

if (!function_exists('is_current_url')) {

    function is_current_url($url = false)
    {
        $current_url = Request::fullUrl();
        if (rtrim($current_url, '/') == rtrim($url, '/')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('lang_url')) {

    function lang_url($lang = false)
    {
        if (!$lang) {
            $selected_lang = Session::get('language');

            if (getLangId($selected_lang) == '') {
                $selected_lang = false;
            }

            //$default_lang = Store::getSettingById($data['store_id'])->language->default;
            $default_lang = false;
            $setting = App::make('StoreSetting');
            if (isset($setting->language)) {
                $default_lang = $setting->language->default;
            }

            if ($selected_lang != $default_lang) {
                $lang = $selected_lang . '/';
            }
        } elseif ($lang && $lang != '') {
            if (getLangId($lang) == '') {
                $lang = false;
            }

            //$default_lang = Store::getSettingById($data['store_id'])->language->default;
            $default_lang = false;
            $setting = App::make('StoreSetting');
            if (isset($setting->language)) {
                $default_lang = $setting->language->default;
            }

            if ($default_lang == $lang) {
                $lang = '/';
            } else {
                $lang .= '/';
            }
        } else {
            $lang = '';
        }

        return $lang;
    }

}

if (!function_exists('createDateFromTimezone')) {

    function createDateFromTimezone($datetime = false, $timezone = false)
    {
        //$date = \Carbon\Carbon::createFromTimeStamp(strtotime($datetime))->setTimezone($timezone);
        $date = \Carbon\Carbon::createFromTimeStamp(strtotime($datetime));
        $data = (object) array(
                            'date'=> $date->__toString(),
                            'timeago'=> $date->diffForHumans(),
                            'format' => $date->format('j F Y g:i A')
                            );

        return $data;

        //Config::set('cache.driver', 'memcached');

        /*$key = $datetime . '-' . $timezone;
        $minutes = 3600 * 24 * 3;

        return Cache::remember('helpers-createDateFromTimezone-' . $key, $minutes, function () use ($datetime, $timezone) {
            $date = \Carbon\Carbon::createFromTimeStamp(strtotime($datetime))->setTimezone($timezone);
            $data = (object) array(
                                'date'=> $date->__toString(),
                                'timeago'=> $date->diffForHumans(),
                                'format' => $date->format('j F Y g:i A')
                                );

            return $data;
        });*/
    }
}

if (!function_exists('createDate')) {

    function createDate($datetime = false)
    {
        $date = \Carbon\Carbon::createFromTimeStamp(strtotime($datetime));
        $data = (object) array(
                            'date'=> $date->__toString(),
                            'timeago'=> $date->diffForHumans(),
                            'format' => $date->format('j F Y g:i A')
                            );

        return $data;
    }
}

if (!function_exists('htmlMinify')) {

    function htmlMinify($html = false)
    {
        $minify  = \zz\Html\HTMLMinify::minify($html);

        return $minify;
    }
}

/**
 * [getExtensionFile description]
 * @param  [type] $mime_type [description]
 * @return [type]            [description]
 */
if (!function_exists('getExtensionFile')) {
    function getExtensionFile($mime_type)
    {
        $extensions = array(
            'image/jpeg' => 'jpg',
            'image/gif' => 'gif',
            'image/png' => 'png',
            'text/xml' => 'xml'
        );

        // Add as many other Mime Types / File Extensions as you like
        return isset($extensions[$mime_type]) ? $extensions[$mime_type] : '';
    }
}
