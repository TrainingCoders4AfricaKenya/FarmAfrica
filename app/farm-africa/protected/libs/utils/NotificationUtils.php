<?php

/**
 * This class contains utility functions for the Notifications module
 * @author muya
 */
class NotificationUtils {

    /**
     * function to log a new account notification into notifications table,
     * to be sent accordingly
     * @param int $userID the userID of the new user
     * @param boolean $emailAlert if set to true, an email notification will be sent to user
     * @param boolean $SMSAlert if set to true, an SMS notification will be sent to user
     */
    public static function sendNewAccountNotification($userID, $emailAlert = true, $SMSAlert = true) {
        $user = Users::model()->findByPk($userID);
        if (!$user) {
            Utils::log('ERROR', 'User could not be found in the system.', __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatResponse(null, StatCodes::USER_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::USER_NOT_EXIST_DESC);
        }
        $responseDataArray = array(); //store any data that's supposed to be returned
        $responseMsg = ''; //store any info to be returned (pipe-separated)
        $userName = $user->userName;
        $fullName = $user->getFullName();
        if ($emailAlert) {
            //an email notification will be sent
            $emailAddress = $user->emailAddress;
            if (!$emailAddress || $emailAddress == '') {
                $responseMsg .= Yii::t(Yii::app()->language, 'userHasNoEmailAddressEmailNotificationNotSent') . '|';
            } else {
                $fromEmailAddress = Utils::getConfigValue('MAILER_EMAIL');
                $fromName = Utils::getConfigValue('EMAIL_FROM_NAME');
                $subject = Yii::t(Yii::app()->language, 'newAccountCreatedEmailSubject');

                $emailNotification = new Notifications();
                $emailNotification->notificationTypeID = NotificationTypes::EMAIL;
                $emailNotification->message = self::createNewAccountEmailMsg($userName, $emailAddress, $fullName);
                $emailNotification->messageDetails = self::assembleEmailMsgDetails($fromEmailAddress, $fromName, $subject);
                $emailNotification->destinationAddress = $emailAddress;
                $emailNotification->status = StatCodes::NEW_NOTIFICATION_CODE;
                $saveNotification = $emailNotification->modelAction(GenericAR::CREATE);
                if (!$saveNotification['STATUS']) {
                    Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO SAVE THE EMAIL NOTIFICATION: ' . CJSON::encode($saveNotification), __CLASS__, __FUNCTION__, __LINE__);
                    $responseMsg .= Yii::t(Yii::app()->language, 'errorWhenSavingEmailNotificationEmailAddressEmailNotificationNotSent') . '|';
                    $responseDataArray['EMAIL']['NOTIFICATION_RESPONSE'] = $saveNotification;
                    $responseDataArray['EMAIL']['STATUS'] = false;
                } else {
                    Utils::log('INFO', 'NEW ACCOUNT NOTIFICATION WAS CREATED SUCCESSFULLY', __CLASS__, __FUNCTION__, __LINE__);
                    $responseMsg .= Yii::t(Yii::app()->language, 'emailNotificationSent') . '|';
                    $responseDataArray['EMAIL']['NOTIFICATION_RESPONSE'] = $saveNotification;
                    $responseDataArray['EMAIL']['STATUS'] = true;
                }
            }
        }
        if ($SMSAlert) {
            //an SMS notification will be sent
            $phoneNumber = $user->phoneNumber;
        }
        return Utils::formatResponse($responseDataArray, StatCodes::SUCCESS_CODE, StatCodes::SUCCESS_CODE, $responseMsg);
    }

    public static function assembleEmailMsgDetails($fromEmailAddress = null, $fromName = null, $subject = null) {
        $msgDetails = array(
            'fromEmailAddress' => $fromEmailAddress,
            'fromName' => $fromName,
            'subject' => $subject,
        );
        return Utils::formatArray($msgDetails, 'json');
    }

    /**
     * function to create a new user account message to be sent via <b>email</b>
     * @param string $userName the recepients userName
     * @param string $fullName the full name of the recipient
     * @param string $expiryTime time after which the link sent to user will be 
     * invalid. Defaults to config value
     */
    public static function createNewAccountEmailMsg($userName, $emailAddress, $fullName = null, $expiryTime = null) {
        Utils::log('INFO', 'ABOUT TO CREATE A NEW ACCOUNT EMAIL MESSAGE', __CLASS__, __FUNCTION__, __LINE__);
        $newAccountToken = Utils::generateNewAccountToken($emailAddress);
        $newAccountURL = Utils::getConfigValue('NEW_ACCOUNT_BASE_URL') . '?e=' . $emailAddress . '&t=' . $newAccountToken;
        $articleContent = self::getNewAccountEmailContent($userName, $newAccountURL, $expiryTime, $fullName);
        $fullEmailMsg = self::generateEmailStructure($articleContent);
        return $fullEmailMsg;
    }

    /**
     * function to generate a HTML-structured email to be sent
     * @param string $mainArticle the HTML content that will go into the main part
     * of the email message
     * @return string
     */
    public static function generateEmailStructure($mainArticle) {
        $emailStructure = '
            <!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8" />
		<style type="text/css">
			body {
				font-family: "Droid Sans", "Arial", Sans-serif;
				font-size: .9em;
			}
			header {
				text-align: right;
				font-size: 2em;
				padding-bottom: 1%;
				border-bottom: double purple;
				color: darkgreen;
			}
			article{
				padding: 1%;
			}
			.main-div{
				background-color: #DCF5D4;
				border-radius: 5px;
				box-shadow: green 2px 2px 2px;
				padding: 2%;
			}
			.intro{
				font-size: 1.5em;
				color: gray;
			}
		</style>
	</head>
	<body>
		<div id="main" class="main-div">
			<header>
				' . Utils::getConfigValue('name') . '
			</header>
			<article>
				' . $mainArticle . '
			</article>
			<footer>
				Best Regards,<br/>
			   	The Good Guys at ' . Utils::getConfigValue('name') . '.<br/>

			   	' . Utils::getConfigValue('EMAIL_SIGNATURE_NAME') . '.<br/>
			   	<hr/>
			   	This email is CONFIDENTIAL and was auto-generated by the ' . Yii::app()->name . ' Application. Please do not reply.
			</footer>
		</div>
	</body>
</html>

        ';
        return $emailStructure;
    }

    /**
     * function to generate the HTML message to be sent when a new user account
     * is created
     * @param string $userName the user's userName
     * @param string $url the URL to allow the user to set their password
     * @param string $expiryTime the time after which the link is set to expire, 
     * e.g. '2 hours' or '1 day'
     * @param string $fullName the name to be used in the introductory part of the email
     * @return string
     */
    public static function getNewAccountEmailContent($userName, $url, $expiryTime = null, $fullName = null) {
        $intro = 'Hello' . (($fullName == null) ? '' : ' ' . $fullName) . '!';
        $expireIn = ($expiryTime == null) ? Utils::getConfigValue('LINK_EXPIRY_PERIOD', 2) . ' ' . Utils::getConfigValue('LINK_EXPIRY_METRIC', 'hour(s)') : $expiryTime;
        $content = '
            <span class="intro">' . $intro . '</span><br>
                        <p>Your ' . Utils::getConfigValue('name') . ' Account has been created!</p>
   
		     	<p>Kindly follow this link (' . $url . ') by clicking or pasting on your browser to access your account.</p>
        
                <p>
                	You will be asked to choose a password, after which you will log in with the username: <strong>' . $userName . '</strong>
                </p>

                <p>The link is valid only for ' . $expireIn . ', after which it will expire. The link can only be used once.</p>
            ';
        return $content;
    }

}

?>
