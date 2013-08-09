#!/usr/bin/php
<?php
/*
 * Script to poll for any SMS for us from the provider, and store it in our system
 * (inboundMessages)
 * 
 * PROCEESS
 * invoke foreign API for sms
 *      get credentials
 *      get date required
 * parse response, get all requests. order them in reverse, try to insert, use 
 * unique_id in response to prevent duplicates
 */
require_once dirname(__FILE__).'/../lib/DBUtils.php';

CronUtils::log('INFO', 'about to start polling SMS', __FILE__, __FUNCTION__, __LINE__);

$pollSMSResponse = CronUtils::pollSMS();

if ($pollSMSResponse['STATUS_TYPE'] != SC_GENERIC_SUCCESS_CODE) {
    CronUtils::log('ERROR', 'error occurred while polling for SMS: ' . json_encode($pollSMSResponse), __FILE__, __FUNCTION__, __LINE__);
    die();
}

$pollSMSResult = $pollSMSResponse['DATA']['result'];

CronUtils::log('INFO', 'response from API: ' . json_encode($pollSMSResult), __FILE__, __FUNCTION__, __LINE__);

//parse the result
$parsedPolledSMSResponse = CronUtils::parsePolledSMSResult($pollSMSResult);

if (!$parsedPolledSMSResponse || count($parsedPolledSMSResponse) < 0) {
    CronUtils::log('ERROR', 'error occurred while parsing polled SMS ', __FILE__, __FUNCTION__, __LINE__);
    die();
}

//loop thru whatever we've gotten, insert into db
foreach ($parsedPolledSMSResponse as $sms) {
    /*
     * -----------------------+------------------+------+-----+-------------------+-----------------------------+
      | inboundMessageID      | int(11) unsigned | NO   | PRI | NULL              | auto_increment              |
      | sourceAddress         | varchar(15)      | YES  |     | NULL              |                             |
      | messageContent        | text             | YES  |     | NULL              |                             |
      | externalTransactionID | varchar(250)     | YES  |     | NULL              |                             |
      | status                | int(11) unsigned | NO   |     | 305               |                             |
      | dateCreated           | datetime         | NO   |     | NULL              |                             |
      | dateModified          | timestamp        | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
      +-----------------------+------------------+---
     */
    $insertInboundSQL = 'INSERT INTO inboundMessages (sourceAddress, messageContent, externalTransactionID, status, dateCreated) ';
    $insertInboundSQL .= ' VALUES (:sourceAddress, :content, :extTrxID, :status, :dateCreated)';
    $insertInboundParams = array(
        ':sourceAddress' => $sms['source'],
        ':content' => $sms['content'],
        ':extTrxID' => $sms['externalTransactionID'],
        ':status' => SC_UNPROCESSED_INBOUND_SMSC_CODE,
        ':dateCreated' => CronUtils::now(),
    );

    $insertInboundResponse = DBUtils::executePreparedStatement($insertInboundSQL, $insertInboundParams, null, null, true);

    if ($insertInboundResponse['STATUS_TYPE'] != SC_GENERIC_SUCCESS_CODE) {
        CronUtils::log('ERROR', 'FAILED TO INSERT INBOUND SMS | DETAILS: ' .
                json_encode($insertInboundResponse) . ' QUERY: ' . $insertInboundSQL
                . ' | PARAMS: ' . json_encode($insertInboundParams), __FILE__, __FUNCTION__, __LINE__);
        continue;
    }
    CronUtils::log('INFO', 'SUCCESSFULLY INSERTED INBOUND SMS', __FILE__, __FUNCTION__, __LINE__);
}
CronUtils::log('INFO', 'COMPLETED POLL FOR INBOUND SMS', __FILE__, __FUNCTION__, __LINE__);

?>
