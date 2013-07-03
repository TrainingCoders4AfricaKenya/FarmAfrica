#!/usr/bin/php

<?php
require_once '../lib/phpmailer/JPhpMailer.php';
require_once '../config/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *  Author: @kioko
 *  @description
 */
$fetchPendingNotificationsSQL = 'select * from notifications where notificationTypeID=1 and status = 300';

$dbConn = mysql_connect('localhost', 'root', '');

mysql_select_db('farmAfrica');

$res = mysql_query($fetchPendingNotificationsSQL);

while ($row = mysql_fetch_array($res)) {
    $notifications[] = $row;
}
foreach ($notifications as $key => $value) {
    //decode message details
    $messageDetails = (array) json_decode($value['messageDetails']);
    $mailer = new JPhpMailer();

    $mailer->IsSMTP();
    $mailer->SMTPSecure = SMTP_SECURE;
    $mailer->Host = 'smtp.gmail.com';
    $mailer->Port = '465';
    $mailer->SMTPAuth = true;
$mailer->Username = 'no-reply@farmafrica.mygbiz.com';
    $mailer->Password = '#WingardiumLeviosa123*';
    $mailer->SetFrom($messageDetails['fromEmailAddress'], $messageDetails['fromName']);
    $mailer->Subject = $messageDetails['subject'];
    $mailer->AltBody = 'Use compatible browser';
    $mailer->MsgHTML($value['message']);
    $mailer->AddAddress($value['destinationAddress']);
    $mailer->Subject = $messageDetails['subject'];
    $mailer->Send();
       
    
    //Updata the notification to successful or Fail
}





?>
