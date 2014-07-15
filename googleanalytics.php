<?php

/**
    Google Analytics
 *  @author:  Willem Labu
 *            Flint n Tinder
 *
 *  Google's Mobile Analytics was deprecated.
 *  Rewriting it as per the guidelines here: http://goo.gl/ii3Bvl  
 */


// Your UA code
$GA_ACCOUNT = "UA-XX-X";

// Using this in a MXit app?
$MXIT = true;

/**
 *  A unique identifier for the current user
 *  http://goo.gl/EeHnoo
 */
$UID = '';


/**
 *  A switch
 *
  true
 *
 *  BLOCKING
 *   Best to include this at the _bottom_ of your page.
 *
 *  Uses `file_get_contents`
 *  Make sure your server has `allow_url_fopen` turned on.
 *
  false
 *
 *  NON-BLOCKING
 *   Best to include this at the _top_ of your page.
 *
 *  Uses `exec` & `cURL`
 *  Make sure your server has `php_curl` installed and on.
 */
$BLOCKING_REQUEST = false;




/**************************************
 *   NO NEED TO EDIT ANYTHING BELOW   *
 **************************************/

// The current page URL
$PAGE = $_SERVER["REQUEST_URI"];

// GA's URL to POST to
$GA_URL = "http://www.google-analytics.com/collect";


// MXit specific overwrites
$UID = isset($_SERVER["HTTP_X_MXIT_USERID_R"]) ? md5($_SERVER["HTTP_X_MXIT_USERID_R"]) : $UID;
$UA  = isset($_SERVER["HTTP_X_DEVICE_USER_AGENT"]) ? $_SERVER["HTTP_X_DEVICE_USER_AGENT"] : $_SERVER['HTTP_USER_AGENT'];
$MXIT_PIXELS = isset($_SERVER["HTTP_UA_PIXELS"]) ? $_SERVER["HTTP_UA_PIXELS"] : '';


// Here we go!
if ($BLOCKING_REQUEST) {

  $data = array(
    'payload_data' => '',
    'v'     => '1',
    't'     => 'pageview',
    'dp'    => $PAGE,
    'tid'   => $GA_ACCOUNT,

    'cid'   => $UID,
    'uid'   => $UID,
    'ua'    => $UA,
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
  echo file_get_contents($GA_URL, false, $context);


} else {

  $url = "$GA_URL?payload_data&v=1&t=pageview&dp=" .
          urlencode($PAGE) . "&tid=$GA_ACCOUNT&cid=$UID&uid=$UID&ua=" .
          urlencode($UA)   . "&sr=$MXIT_PIXELS";

  $cmd = "curl '" . $url . "' > /dev/null 2>&1 &";

  // Hit!
  exec($cmd, $output, $exit);

}

?>
