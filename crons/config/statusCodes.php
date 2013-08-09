<?php

/*
 * Status Codes for use within FarmAfrica Crons
 */
## GENERAL STATUS CODES
define('SC_GENERIC_SUCCESS_CODE', 1);
define('SC_GENERIC_FAILURE_CODE', 2);

define('SC_SMS_SEND_FAILED_CODE', 301);
define('SC_SMS_SEND_SUCCESS_CODE', 302);
define('SC_POLL_SMS_FAILED_CODE', 303);
define('SC_POLL_SMS_SUCCESS_CODE', 304);
define('SC_UNPROCESSED_INBOUND_SMSC_CODE', 305);


## DESCRIPTIONS
define('SC_GENERIC_FAILURE_DESC', 'Failed');
define('SC_GENERIC_SUCCESS_DESC', 'Success');

define('SC_SMS_SEND_FAILED_DESC', 'Failed to send SMS');
define('SC_SMS_SEND_SUCCESS_DESC', 'SMS Sent Successfully');
define('SC_POLL_SMS_FAILED_DESC', 'Failed to poll for SMS');
define('SC_POLL_SMS_SUCCESS_DESC', 'Successfully polled for SMS');
?>
