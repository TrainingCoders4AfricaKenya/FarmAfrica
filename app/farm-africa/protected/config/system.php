<?php
const BASE_URL = 'http://localhost/FarmAfrica/index.php';
return array(
    'adminEmail' => 'webmaster@example.com',
    'LOG_DIR' => '/var/log/applications/FarmAfrica/UI/',
    /*the default # of items on admin page*/
    'DEFAULT_ADMIN_PAGE_SIZE' => 10,
    
    'NEW_ACCOUNT_BASE_URL' => BASE_URL.'/users/setPassword',
);
?>
