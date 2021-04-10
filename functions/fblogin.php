<?php
// Include FB config file && User class
require_once '../config/fbConfig.php';
require_once '../functions/user.php';

 // Get login url
$fb_loginURL = htmlspecialchars($helper->getLoginUrl($fbredirectURL, $fbPermissions));

?>