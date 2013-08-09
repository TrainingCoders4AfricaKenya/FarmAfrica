<?php
/*
 * configs specific to users module
 */
return array(
    'LINK_EXPIRY_TIME' => 2, //time after which a link sent to user will expire
    'LINK_EXPIRY_METRIC' => 'hour(s)', //metric to be used for link expiry
    
    'MIN_PASSWORD_LENGTH' => 8,
    'ALLOWED_PASSWORD_CHAR' => '/[^A-Za-z0-9]|[!|%|$]/',
);
?>
