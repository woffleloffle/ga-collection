<?php

/**
    Google Analytics
 *  @author:  Willem Labu
 *            Flint n Tinder
 *
 *  Google's Mobile Analytics was deprecated.
 *  Rewriting it as per the guidelines here: http://goo.gl/ii3Bvl  
 */

// Your UA code, can be mobile too.
$GA_ACCOUNT = "UA-XX-X";



// This is specific to MXit, so we'll use some of the user's stuff
$MXIT_UID = isset($_SERVER["HTTP_X_MXIT_USERID_R"]) ? $_SERVER["HTTP_X_MXIT_USERID_R"] : '777';
$MXIT_UA = isset($_SERVER["HTTP_X_DEVICE_USER_AGENT"]) ? $_SERVER["HTTP_X_DEVICE_USER_AGENT"] : $_SERVER['HTTP_USER_AGENT'];
$MXIT_PIXELS = isset($_SERVER["HTTP_UA_PIXELS"]) ? $_SERVER["HTTP_UA_PIXELS"] : '';

// The current page URL
$PAGE = $_SERVER["REQUEST_URI"];

// GA's new URL to POST to
$GA_URL = "http://www.google-analytics.com/collect";

$data = array(
  'payload_data' => '',
  'v'     => '1',
  't'     => 'pageview',
  'dp'    => $PAGE,
  'tid'   => $GA_ACCOUNT,

  'cid'   => $MXIT_UID,
  'uid'   => $MXIT_UID,
  'ua'    => $MXIT_UA,
  'sr'    => $MXIT_PIXELS
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);

// Hit!
file_get_contents($GA_URL, false, $context);

?>
