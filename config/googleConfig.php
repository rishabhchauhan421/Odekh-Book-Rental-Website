<?php

//Include Google client library 
include_once '../vendor/google/Google_Client.php';
include_once '../vendor/google/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$gclientId = '408585403119-p6qopkc5tqe176ia0mbs4l939u9l5qdr.apps.googleusercontent.com';
$gclientSecret = 'uLAQiFcqF9iDExTO_KUBsKVb';
$gredirectURL = 'http://odekh.com/googleredirect.php/';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to Odekh.com');
$gClient->setClientId($gclientId);
$gClient->setClientSecret($gclientSecret);
$gClient->setRedirectUri($gredirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>