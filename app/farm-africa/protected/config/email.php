<?php

/*
 * configs specific to users module
 */
return array(
    //Email credentials
    'MAILER_USERNAME' => 'no-reply@farmafrica.mygbiz.com', //Email username--to log in when sending emails
    'MAILER_PASSWORD' => 'mailpassword', //Email password used to send emails
    'MAILER_EMAIL' => 'no-reply@farmafrica.mygbiz.com', //email --to send emails

    //email details
    'EMAIL_HOST' => 'smtp.gmail.com',
    'EMAIL_PORT' => 465,
    'EMAIL_SMTP_SECURE' => 'ssl',
    'EMAIL_FROM_NAME' => 'FarmAfrica',
    'EMAIL_SIGNATURE_NAME' => 'FarmAfrica LTD',
    
    //misc email configs
);
?>
