<?php

/**
 * Description of SecurityUtils
 * this class has security-related utility functions
 * @author muya
 */
class SecurityUtils {

    public static function authenticateEmailPasswordRequest($emailAddress, $token) {
        /*
         * check for existing email-token pair in db
         * check if time has expired, update the token
         * return formatResponse array with appropriate details
         */
        $passwordRequest = PasswordRequests::model()->find('identifier=:email AND token=:token', array(':email' => $emailAddress, ':token' => $token));
        if (!$passwordRequest) {
            //token does not exist
            Utils::log('INFO', 'USER PASSWORD TOKEN DOES NOT EXIST', __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatResponse(null, StatCodes::PASSWORD_TOKEN_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::PASSWORD_TOKEN_NOT_EXIST_DESC);
        }
        //check if it has been used
        if ($passwordRequest->status != StatCodes::ES_ACTIVE) {
            //token has been used
            Utils::log('INFO', 'USER PASSWORD TOKEN HAS ALREADY BEEN USED', __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatResponse(null, StatCodes::PASSWORD_TOKEN_USED_CODE, StatCodes::FAILED_CODE, StatCodes::PASSWORD_TOKEN_USED_DESC);
        }
        //check for expiry
        $expiryPeriod = Utils::getConfigValue('LINK_EXPIRY_TIME', 2);
        $expiryPeriodMetric = Utils::getConfigValue('LINK_EXPIRY_METRIC', 'hour');

        $expiryTime = self::calculateExpiryTime($expiryPeriod, $expiryPeriodMetric);

        $linkDateCreated = $passwordRequest->dateCreated;
        $currentTime = Utils::now();

//        $d_start = new DateTime($currentTime);
//        $d_end = new DateTime($linkDateCreated);
//        $diff = $d_start->diff($d_end);
//        $timeDifference = $diff->format('%s');

        $dateStart = strtotime($linkDateCreated);
        $dateEnd = strtotime($currentTime);

        $timeDifference = $dateEnd - $dateStart;

        if ($timeDifference > $expiryTime) {
            //link has expired. update and return with response
            Utils::log('INFO', 'USER PASSWORD TOKEN HAS EXPIRED | LINK DATE CREATED: '
                    . $linkDateCreated . ' | CURR TIME: ' . $currentTime . ' | DIFF: ' . $timeDifference . ' SECONDS', __CLASS__, __FUNCTION__, __LINE__);
            $passwordRequest->status = StatCodes::ES_INACTIVE;
            return Utils::formatResponse(null, StatCodes::PASSWORD_TOKEN_EXPIRED_CODE, StatCodes::FAILED_CODE, StatCodes::PASSWORD_TOKEN_EXPIRED_DESC);
        } else {
            //link is valid
            Utils::log('INFO', 'USER PASSWORD TOKEN IS VALID | LINK DATE CREATED: '
                    . $linkDateCreated . ' | CURR TIME: ' . $currentTime . ' | DIFF: ' . $timeDifference . ' SECONDS', __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatResponse(null, StatCodes::PASSWORD_TOKEN_VALID_CODE, StatCodes::SUCCESS_CODE, StatCodes::PASSWORD_TOKEN_VALID_DESC);
        }
    }

    /**
     * function to calculate expiry period in seconds
     * @param int $expiryPeriod the amount of time
     * @param string $expiryPeriodMetric the metric for the time. Allowed(hour, min, sec,day,week)
     */
    public static function calculateExpiryTime($expiryPeriod, $expiryPeriodMetric) {
        $expiryPeriod = (int) $expiryPeriod;
        //default metric is hr
        $multiplyBy = 3600; //# of sec in 1hr
        //parse metric
        if (stristr($expiryPeriodMetric, 'hour')) {
            $multiplyBy = 3600;
        } else if (stristr($expiryPeriodMetric, 'min')) {
            $multiplyBy = 60;
        } else if (stristr($expiryPeriodMetric, 'sec')) {
            $multiplyBy = 1;
        } else if (stristr($expiryPeriodMetric, 'day')) {
            $multiplyBy = 86400;
        } else if (stristr($expiryPeriodMetric, 'week')) {
            $multiplyBy = 86400 * 7;
        }

        return ($multiplyBy * $expiryPeriod);
    }

    /**
     * function to encrypt a value using the phpass extension
     * uses CRYPT_BLOWFISH
     * @param string $value
     * @return string the hashed password
     */
    public static function encrypt($value) {
        $phpass = Yii::getPathOfAlias('ext.phpass');

        // Turn off the library autoload
        spl_autoload_unregister(array('YiiBase', 'autoload'));

        include_once($phpass . DIRECTORY_SEPARATOR . 'PasswordHash.php');

        $t_hasher = new PasswordHash(8, false);
        $hash = $t_hasher->HashPassword($value);

        //Restore the autoloader
        spl_autoload_register(array('YiiBase', 'autoload'));

        return $hash;
    }

    /**
     * function to check password using phpass CheckPassword
     * @param type $entered
     * @param type $stored
     * @return boolean
     */
    public static function checkPassword($entered, $stored) {
        //Introduce new encryption algorithm--using phpass- CRYPT_BLOWFISH
        //Path alias for the phpass
        $phpass = Yii::getPathOfAlias('ext.phpass');

        // Turn off the library autoload
        spl_autoload_unregister(array('YiiBase', 'autoload'));

        include_once($phpass . DIRECTORY_SEPARATOR . 'PasswordHash.php');
        
        $t_hasher = new PasswordHash(8, false);
        
        $check = $t_hasher->CheckPassword($entered, $stored);

        //Restore the Yii  autoloader
        spl_autoload_register(array('YiiBase', 'autoload'));

        if ($check == true) {
            return true;
        } else {
            return false;
        }
    }

}

?>
