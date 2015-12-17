<!-- Start Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Contact</h2>
                <p></p>
            </div>
            <div class="col-md-6">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo URL::to('');?>">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Page Banner -->

<!-- Start Map -->
<div id="map" data-position-latitude="13.7674283" data-position-longitude="100.569847" data-marker-img="http://www.siamits.com/favicon.ico"></div>
<script>
    (function($) {
        $.fn.CustomMap = function(options) {

            var posLatitude = $('#map').data('position-latitude'),
                posLongitude = $('#map').data('position-longitude');

            var settings = $.extend({
                home: {
                    latitude: posLatitude,
                    longitude: posLongitude
                },
                text: '<div class="map-popup"><h4>SiamiTs.com</h4><p>The ultimate aim of education society.</p></div>',
                icon_url: $('#map').data('marker-img'),
                // icon_url: 'http://www.siamits.com/favicon.ico',
                zoom: 15
            }, options);

            var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

            return this.each(function() {
                var element = $(this);

                var options = {
                    zoom: settings.zoom,
                    center: coords,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    panControl: true,
                    disableDefaultUI: true,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.DEFAULT
                    },
                    overviewMapControl: true,
                };

                var map = new google.maps.Map(element[0], options);

                var icon = {
                    url: settings.icon_url,
                    origin: new google.maps.Point(0, 0)
                };

                var marker = new google.maps.Marker({
                    position: coords,
                    map: map,
                    icon: icon,
                    draggable: false
                });

                var info = new google.maps.InfoWindow({
                    content: settings.text
                });

                google.maps.event.addListener(marker, 'click', function() {
                    info.open(map, marker);
                });

                var styles = [{
                    "featureType": "landscape",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 65
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 51
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.highway",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.arterial",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 30
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "road.local",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 40
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "transit",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "administrative.province",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "lightness": -25
                    }, {
                        "saturation": -100
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "hue": "#ffff00"
                    }, {
                        "lightness": -25
                    }, {
                        "saturation": -97
                    }]
                }];

                map.setOptions({
                    styles: styles
                });
            });

        };
    }(jQuery));

    jQuery(document).ready(function() {
        jQuery('#map').CustomMap();
    });
</script>
<!-- End Map -->

<!-- Start Content -->
<a name="contact" id="contact"></a>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Contact Us</span></h4>

                <!-- Start Contact Form -->
                <div id="contact-form" class="contatct-form">
                    <div class="loader"></div>
                    <form action="<?php echo URL::to('contact');?>" class="contactForm" name="frm_main" id="frm_main" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Name<span class="required">*</span></label>
                                <span class="name-missing">Please enter your name</span>
                                <input id="name" name="name" type="text" value="" size="30">
                            </div>
                            <div class="col-md-4">
                                <label for="e-mail">Email<span class="required">*</span></label>
                                <span class="email-missing">Please enter a valid e-mail</span>
                                <input id="email" name="email" type="text" value="" size="30">
                            </div>
                            <div class="col-md-4">
                                <label for="e-mail">Mobile</label>
                                <span class="email-missing">Please enter a valid mobile</span>
                                <input id="mobile" name="mobile" type="text" value="" size="30">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="message">Add Your Comment<span class="required">*</span></label>
                                <span class="message-missing">Say something!</span>
                                <textarea id="message" name="message" cols="45" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo Config::get('web.recaptch-site-key');?>"></div>
                            </div>
                        </div>
                        <p>&nbsp;

                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" name="submit" class="button" id="submit_btn" value="Send Message">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="referer" value="<?php echo URL::to('contact');?>#contact">
                    </form>
                </div>
                <!-- End Contact Form -->
                <div class="hr1" style="margin-bottom:50px;"></div>

            </div>

            <!-- <div class="hr1" style="margin-bottom:50px;"></div> -->

            <div class="col-md-4">

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Information</span></h4>

                <!-- Some Info -->
                <p>เว็บไซต์รวบรวมความรู้ ข่าวสาร ความบันเทิง ทางด้านไอที และอื่น ๆ</p>

                <!-- Divider -->
                <div class="hr1" style="margin-bottom:10px;"></div>

                <!-- Info - Icons List -->
                <ul class="icons-list">
                    <li><i class="fa fa-globe">  </i> <strong>Address:</strong>  Rachadapisek Rd, Dindang, Bangkok, Thailand</li>
                    <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> <a href="mailto:support@siamits.com">support@siamits.com</a></li>
                    <li><i class="fa fa-mobile"></i> <strong>Phone:</strong> +662 644 2390</li>
                </ul>

                <!-- Divider -->
                <div class="hr1" style="margin-bottom:15px;"></div>

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Working Hours</span></h4>

                <!-- Info - List -->
                <ul class="list-unstyled">
                    <li><strong>Monday - Friday</strong> - 9am to 5pm</li>
                    <li><strong>Saturday</strong> - 9am to 2pm</li>
                    <li><strong>Sunday</strong> - Closed</li>
                </ul>

            </div>

        </div>

    </div>
</div>
<!-- End content -->