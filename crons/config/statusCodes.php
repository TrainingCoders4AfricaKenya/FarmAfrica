<?php

/*
 * Status Codes for use within FarmAfrica Crons
 */
## GENERAL STATUS CODES
define('SC_GENERIC_SUCCESS_CODE', 1);
define('SC_GENERIC_FAILURE_CODE', 2);

define('SC_SMS_SEND_FAILED_CODE', 301);
define('SC_SMS_SEND_SUCCESS_CODE', 302);


## DESCRIPTIONS
define('SC_GENERIC_FAILURE_DESC', 'Failed');
define('SC_GENERIC_SUCCESS_DESC', 'Success');

define('SC_SMS_SEND_FAILED_DESC', 'Failed to send SMS');
define('SC_SMS_SEND_SUCCESS_DESC', 'SMS Sent Successfully');
?>
