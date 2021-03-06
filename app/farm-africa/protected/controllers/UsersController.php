<?php

class UsersController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'setPassword' actions
                'actions' => array('setPassword', 'signup'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view',),
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    
     public function actionSignup() {
        $model = new RUsers();
        $this->layout = '';
        if (isset($_POST['RUsers'])) {
            Utils::log('INFO', 'POST REQUEST: ' . CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
            $model->attributes = $_POST['RUsers'];
            $model->group = ($_POST['RUsers']['group']) ? $_POST['RUsers']['group'] : null;
            Utils::log('INFO', 'ATTRIBUTES: ' . CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);
            if($model->group != 'buyer' && $model->group != 'seller'){
                $this->redirect(array('site/login'));
            }
            try {
                $saveOK = $model->save();
                if ($saveOK) {
                    Utils::log('INFO', 'SAVE  OK');
                    $this->redirect(array('site/login'));
                } else {
                    Utils::log('INFO', 'SAVE NOT OK' . CJSON::encode($model->getErrors()));
                     $this->render('/site/signup', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }
            } catch (EActiveResourceRequestException $resourceExc) {
                Utils::log('EXCEPTION', 'EActiveResourceRequestException ON CREATE USER | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array) CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: ' . Utils::printArray($modelErrors));
                if ($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])) {
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO CREATE USER | '
                            . CJSON::encode($errorMsg), __CLASS__, __FUNCTION__, __LINE__);
                    Yii::app()->user->setFlash('error', 'Error occurred');
                } else {
                    $model->addErrors($modelErrors['modelErrors']);
                }

                $this->render('/site/signup', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            } catch (Exception $exc) {
                //error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO CREATE USER | '
                        . CJSON::encode($exc->getCode()).'|'.$exc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 'sorryAnErrorOccurredWhileCreatingThe{model}Record', array('{model}' => 'User')));
                $this->render('/site/signup', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            }
        }

        $this->render('/site/signup', array(
                    'model' => $model,
                ));
        Yii::app()->end();
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new RUsers();

        if (isset($_POST['RUsers'])) {
            Utils::log('INFO', 'POST REQUEST: ' . CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
            $model->attributes = $_POST['RUsers'];
            Utils::log('INFO', 'ATTRIBUTES: ' . CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);

            try {
                $saveOK = $model->save();
                if ($saveOK) {
                    Utils::log('INFO', 'SAVE  OK');
                    $this->redirect(array('view', 'id' => $model->userID));
                } else {
                    Utils::log('INFO', 'SAVE NOT OK' . CJSON::encode($model->getErrors()));
                }
            } catch (EActiveResourceRequestException $resourceExc) {
                Utils::log('EXCEPTION', 'EActiveResourceRequestException ON CREATE USER | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array) CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: ' . Utils::printArray($modelErrors));
                if ($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])) {
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO CREATE USER | '
                            . CJSON::encode($errorMsg), __CLASS__, __FUNCTION__, __LINE__);
                    Yii::app()->user->setFlash('error', 'Error occurred');
                } else {
                    $model->addErrors($modelErrors['modelErrors']);
                }

                $this->render('create', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            } catch (Exception $exc) {
                //error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO CREATE USER | '
                        . CJSON::encode($exc), __CLASS__, __FUNCTION__, __LINE__);
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 'sorryAnErrorOccurredWhileCreatingThe{model}Record', array('{model}' => 'User')));
                $this->render('create', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['RUsers'])) {
            Utils::log('INFO', 'POST REQUEST: ' . CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
            $model->attributes = $_POST['RUsers'];
            Utils::log('INFO', 'ATTRIBUTES: ' . CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);

            try {
                $saveOK = $model->save();
                if ($saveOK) {
                    Utils::log('INFO', 'SAVE  OK');
                    $this->redirect(array('view', 'id' => $model->userID));
                } else {
                    Utils::log('INFO', 'SAVE NOT OK' . CJSON::encode($model->getErrors()));
                    $this->render('update', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }
            } catch (EActiveResourceRequestException $resourceExc) {
                Utils::log('EXCEPTION', 'EActiveResourceRequestException ON UPDATE USER | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array) CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: ' . Utils::printArray($modelErrors));
                if ($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])) {
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO UPDATE USER | '
                            . CJSON::encode($errorMsg), __CLASS__, __FUNCTION__, __LINE__);
                    Yii::app()->user->setFlash('error', 'Error occurred');
                } else {
                    $model->addErrors($modelErrors['modelErrors']);
                }

                $this->render('update', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            } catch (Exception $exc) {
                //error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO UPDATE USER | '
                        . CJSON::encode($exc), __CLASS__, __FUNCTION__, __LINE__);
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 'sorryAnErrorOccurredWhileUpdatingThe{model}Record', array('{model}' => 'User')));
                $this->render('update', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            }
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $this->render('update', array(
            'model' => $model,
        ));
        exit();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $model = $this->loadModel($id);

        Utils::log('DEBUG', 'REQUEST: ' . CJSON::encode($_REQUEST));

        if (isset($_POST['RUsers'])) {
            Utils::log('INFO', 'POST REQUEST: ' . CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
            $model->attributes = $_POST['RUsers'];
            Utils::log('INFO', 'ATTRIBUTES: ' . CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);

            try {
                $deleteOK = $model->deleteById($id);
                if ($deleteOK) {
                    Utils::log('INFO', 'DELETE  OK');
                    $this->redirect(array('admin'));
                } else {
                    Utils::log('INFO', 'DELETE NOT OK');
                    $this->render('update', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }
            } catch (EActiveResourceRequestException $resourceExc) {
                Utils::log('EXCEPTION', 'EActiveResourceRequestException ON DELETE USER | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array) CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: ' . Utils::printArray($modelErrors));
                if ($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])) {
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO UPDATE USER | '
                            . CJSON::encode($errorMsg), __CLASS__, __FUNCTION__, __LINE__);
                    Yii::app()->user->setFlash('error', 'Error occurred');
                } else {
                    $model->addErrors($modelErrors['modelErrors']);
                }

                $this->render('delete', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            } catch (Exception $exc) {
                //error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO DELETE USER | '
                        . CJSON::encode($exc), __CLASS__, __FUNCTION__, __LINE__);
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 'sorryAnErrorOccurredWhileDeletingThe{model}Record', array('{model}' => 'User')));
                $this->render('delete', array(
                    'model' => $model,
                ));
                Yii::app()->end();
            }
        }

        $this->render('delete', array(
            'model' => $model,
        ));
        Yii::app()->end();
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Users');
        $this->redirect('admin');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new RUsers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RUsers']))
            $model->attributes = $_GET['RUsers'];

        //use model to get the data provider required
        $dataProvider = RestUtils::createDataProvider($model);

        if ($dataProvider == null) {
            throw new CHttpException(500, 'Server error occurred');
        }
        $this->render('admin', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * controller action to allow users to set their password
     */
    public function actionSetPassword() {
        $this->layout = '//layouts/column1';
        Yii::app()->user->logout();
        /*
         * check for GET params
         * if not set, redirect to log in
         */
        //check for get params
        if ((!isset($_GET['e']) || !isset($_GET['t'])) && (!isset($_POST['phoneNumber']) || (!isset($_POST['token'])))) {
            Utils::log('ERROR', 'SET PASSWORD REQUEST WITHOUT TOKENS. GET REQUEST: ' . CJSON::encode($_GET)
                    . 'POST REQUEST: ' . CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
            $this->redirect($this->createUrl('/site/login'));
        }

        $setPasswordForm = new SetPasswordForm();

        //check if the form has been submitted & sessions have been set
        if (Yii::app()->request->isPostRequest && (isset($_POST['SetPasswordForm']))) {

            $setPasswordForm->attributes = $_POST['SetPasswordForm'];

            if ($setPasswordForm->validate()) {
                if ((isset($_GET['e'])) && (isset($_GET['t']))) {
                    $emailAddress = $identifier = $_GET['e'];
                    $token = $_GET['t'];
                } else if ((isset($_POST['phoneNumber'])) && (isset($_POST['token']))) {
                    //we expect that the user will have entered the token they received via mobile to a form
                    $phoneNumber = $identifier = $_POST['phoneNumber'];
                    $token = $_POST['token'];
                }
                $password = $_POST['SetPasswordForm']['newPassword'];

                //validate user password length
                $passwordLength = strlen($password);
                $minPassLength = Utils::getConfigValue('MIN_PASSWORD_LENGTH');
                if ($passwordLength < $minPassLength) {
                    Utils::log('INFO', 'USER PASSWORD ENTERERD IS LESS THAN ALLOWED LENGTH', __CLASS__, __FUNCTION__, __LINE__);
                    $setPasswordForm->addError('newPassword', Yii::t(Yii::app()->language, 'passwordMustBeAtLeast{length}Chars', array('{length}' => $minPassLength)));
                    $this->render('setPassword', array('model' => $setPasswordForm,));
                    exit();
                }

                //validate required characters
                $allowedChars = Utils::getConfigValue('ALLOWED_PASSWORD_CHAR');
                if (!preg_match($allowedChars, $password)) {
                    $setPasswordForm->addError('newPassword', Yii::t(Yii::app()->language, 'missingPasswordCharacters'));
                    $this->render('newPassword', array('model' => $setPasswordForm,));
                    exit();
                }

                //we're good to go
            } else {
                //failed validation
                Utils::log('ERROR', 'SET PASSWORD FROM VALIDATION FAILED', __CLASS__, __FUNCTION__, __LINE__);
                $this->render('setPassword', array('model' => $setPasswordForm));
                exit();
            }
        }

        Utils::log('DEBUG', 'POST NOT SET | REQUEST: ' . CJSON::encode($_REQUEST) . ' | SESSION: ' . Yii::app()->session['passwordRequestToken']);

        $authResponse = array();  //array to hold the authentication response received
        if ((isset($_GET['e'])) && (isset($_GET['t']))) {
            $emailAddress = $identifier = $_GET['e'];
            $token = $_GET['t'];
            $authResponse = SecurityUtils::authenticateEmailPasswordRequest($emailAddress, $token);
        } else if ((isset($_POST['phoneNumber'])) && (isset($_POST['token']))) {
            //we expect that the user will have entered the token they received via mobile to a form
            $phoneNumber = $identifier = $_POST['phoneNumber'];
            $token = $_POST['token'];
            $authResponse = SecurityUtils::authenticateSMSPasswordRequest($phoneNumber, $token);
        }

        //check auth response
        if (!isset($authResponse['STATUS_TYPE'])) {
            //something very wrong happened. we got an unusual response. redirect to log in
            Utils::log('ERROR', 'UNUSUAL authResponse FROM SecurityUtils: '
                    . CJSON::encode($authResponse), __CLASS__, __FUNCTION__, __LINE__, true);
            $this->redirect($this->createUrl('/site/login'));
        }
        Utils::log('INFO', 'AUTHRESPONSE: ' . CJSON::encode($authResponse), __CLASS__, __FUNCTION__, __LINE__);
        if ($authResponse['STATUS_CODE'] == StatCodes::PASSWORD_TOKEN_VALID_CODE) {
            //token is ok.
            //redirect to reset new password form...first set the request sessions
            Yii::app()->session['passwordRequestToken'] = $token;
            Yii::app()->session['passwordRequestIdentifier'] = $identifier;
            Yii::app()->session['passwordTokenExpired'] = false;

            Yii::app()->user->setFlash('success', Yii::t(Yii::app()->language, 'pleaseSetYourPassword'));
            $this->render('setPassword', array('model' => $setPasswordForm));
            exit();
        } else if ($authResponse['STATUS_CODE'] == StatCodes::PASSWORD_TOKEN_NOT_EXIST_CODE) {
            //invalid token. redirect to log in
            $this->redirect($this->createUrl('/site/login'));
        } else if ($authResponse['STATUS_CODE'] == StatCodes::PASSWORD_TOKEN_USED_CODE) {
            //token already used. redirect to log in
            Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 'passwordTokenUsed'));
            $this->redirect($this->createUrl('/site/login'));
        } else if ($authResponse['STATUS_CODE'] == StatCodes::PASSWORD_TOKEN_EXPIRED_CODE) {
            //token expired
            Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 'passwordTokenExpired'));
            Yii::app()->session['passwordTokenExpired'] = true;
            $this->render('setPassword', array('model' => $setPasswordForm));
            exit();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        try {
            $model = RUsers::model()->findById($id);
        } catch (Exception $exc) {
            Utils::log('EXCEPTION', 'AN Exception WAS THROWN WHILE FETCHING MODEL | CODE: '
                    . $exc->getCode() . ' | MESSAGE: ' . $exc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
            throw new CHttpException(404, 'The requested page does not exist.');
        }


        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
