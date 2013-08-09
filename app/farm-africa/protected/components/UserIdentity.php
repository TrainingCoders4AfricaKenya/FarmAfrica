<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $userID;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $users = array(
            // username => password
            'demo' => 'demo',
            'admin' => 'admin',
        );
//        RUsers::model()->
        $user = RUsers::model()->findAll(array('userName' => $this->username));
        if(!$user){
            Utils::log('INFO', 'user with username: '.$this->username.' not found', __CLASS__, __FUNCTION__, __LINE__);
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else{
            Utils::log('INFO', 'user with username: '.$this->username.'  found', __CLASS__, __FUNCTION__, __LINE__);
            $this->errorCode = self::ERROR_NONE;
        }
//        if (!isset($users[$this->username])) {
//            $this->errorCode = self::ERROR_USERNAME_INVALID;
//        } elseif ($users[$this->username] !== $this->password) {
//            $this->errorCode = self::ERROR_PASSWORD_INVALID;
//        } else {
//            $this->errorCode = self::ERROR_NONE;
//            $userCount = 1;
//            //set userID as will be used throughout the system
//            foreach ($users as $key => $value) {
//                if ($this->username == $key) {
//                    Yii::app()->user->setState('userID', $userCount);
//                    break;
//                }
//                $userCount++;
//            }
//        }

        return !$this->errorCode;
    }

}