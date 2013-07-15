<?php

/*
 * PROCESS
 * pick unprocessed sms notification
 * buld request to be sent
 * send request, update appropriately.
 */
require_once '../lib/DBUtils.php';

CronUtils::log('INFO', 'about to start processing SMS notifications', __FILE__, __FUNCTION__, __LINE__);

$fetchPendingSMSNotificationsSQL = 'SELECT notificationID, notificationTypeID, '
        . ' message, destinationAddress, messageDetails, status,dateCreated FROM '
        . ' notifications WHERE notificationTypeID=:SMSNotificationType AND '
        . ' status=:unprocessedNotification LIMIT '.SMS_NOTIFICATION_PROCESSING_LIMIT;

$fetchPendingSMSNotificationsParams = array(
    ':SMSNotificationType' => SMS_NOTIFICATION_TYPE,
    ':unprocessedNotification' => UNPROCESSED_SMS_NOTIFICATION,
);

$pendingSMSNotificationsResponse = DBUtils::executePreparedStatement(
                $fetchPendingSMSNotificationsSQL, $fetchPendingSMSNotificationsParams);

if ($pendingSMSNotificationsResponse['STATUS_TYPE'] != SC_GENERIC_SUCCESS_CODE) {
    CronUtils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO FETCH PENDING SMS '
            .' NOTIFICATIONS. PROCESSING WILL STOP' .
            json_encode($pendingSMSNotificationsResponse), __FILE__, __FUNCTION__, __LINE__);
    exit();
}

$pendingSMSNotifications = $pendingSMSNotificationsResponse['DATA'];
$notificationsCount = count($pendingSMSNotifications);

CronUtils::log('INFO', 'SUCCESSFULLY FETCHED '.count($pendingSMSNotifications).' UNPROCESSED NOTIFICATIONS', __FILE__, __FUNCTION__, __LINE__);

if($notificationsCount < 1){
    CronUtils::log('INFO', 'THERE WERE NO NOTIFICATIONS TO PROCESS. PROCESS WILL TERMINATE.'
            .' | NOTIFICATIONS COUNT: '.$notificationsCount, __FILE__, __FUNCTION__, __LINE__);
    exit();
}

//loop through the notifications, sending them out
foreach ($pendingSMSNotifications as $notification) {
    //extract details and call process to send them
    
    $currNotificationID = (isset($notification['notificationID'])) ? $notification['notificationID'] : null;
    $message = (isset($notification['message'])) ? $notification['message'] : null;
    $destinationAddress = (isset($notification['destinationAddress'])) ? $notification['destinationAddress'] : null;
    
    $sendSMSResponse = CronUtils::sendSMS($destinationAddress, $message);
    
    if($sendSMSResponse['STATUS_CODE'] != SC_SMS_SEND_SUCCESS_CODE){
        //update to sent successfully
        $updateToStatus = SC_SMS_SEND_SUCCESS_CODE;
        $statusMessage = json_encode($sendSMSResponse['DATA']);
    }
    else{
        //update to failed send
        $updateToStatus = SC_SMS_SEND_FAILED_CODE;
        $statusMessage = json_encode($sendSMSResponse['DATA']);
    }
    
    $updateSMSNotificationSQL = 'UPDATE notifications SET status=:updateToStatus, '
            .' statusMessage=:statusMessage WHERE notificationID = :notificationID LIMIT 1';
    $updateSMSNotificationParams = array(
        ':updateToStatus' => (int)$updateToStatus,
        ':statusMessage' => $statusMessage,
        ':notificationID' => $currNotificationID,
    );
    
    $updateSMSNotificationResponse = DBUtils::executePreparedStatement($updateSMSNotificationSQL, $updateSMSNotificationParams, PDO::FETCH_ASSOC, null, true,true);
    
    CronUtils::log('INFO', 'UPDATE SMS NOTIFICATION RESPONSE: '.json_encode($updateSMSNotificationResponse), __FILE__, __FUNCTION__, __LINE__);
}

CronUtils::log('INFO', 'SEND SMS NOTIFICATION COMPLETE', __FILE__, __FUNCTION__, __LINE__);


?>
