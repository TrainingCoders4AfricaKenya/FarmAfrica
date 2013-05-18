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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new RUsers();

        if (isset($_POST['RUsers'])) {
            Utils::log('INFO', 'POST REQUEST: '.CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
            $model->attributes = $_POST['RUsers'];
            Utils::log('INFO', 'ATTRIBUTES: '.CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);
            
            try {
                $saveOK = $model->save();
                if ($saveOK) {
                    Utils::log('INFO', 'SAVE  OK');
                    $this->redirect(array('view', 'id' => $model->userID));
                } else {
                    Utils::log('INFO', 'SAVE NOT OK'.CJSON::encode($model->getErrors()));
                }
            } catch (EActiveResourceRequestException $resourceExc) {
                Utils::log('EXCEPTION', 'EActiveResourceRequestException ON CREATE USER | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array)  CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: '.Utils::printArray($modelErrors));
                if($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])){
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO CREATE USER | '
                            .CJSON::encode($errorMsg),__CLASS__, __FUNCTION__, __LINE__ );
                    Yii::app()->user->setFlash('error', 'Error occurred');
                }
                else{
                    $model->addErrors($modelErrors['modelErrors']);
                }
                
                $this->render('create', array(
                    'model' => $model,
                ));
                Yii::app()->end();
                
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['RUsers'])) {
            $model->attributes = $_POST['RUsers'];
            if ($model->save()){
//                die('SAVE OK');
                $this->redirect(array('view', 'id' => $model->userID));
            }
                
        }
        
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

        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->userID));
        }

        $this->render('delete', array(
            'model' => $model,
        ));
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
        if (isset($_GET['Users']))
            $model->attributes = $_GET['Users'];
        
        //use model to get the data provider required
        $dataProvider = RestUtils::createDataProvider($model);
        
        if($dataProvider == null){
            throw new CHttpException(500, 'Server error occurred');
        }
        $this->render('admin', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
        ));
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
                    .$exc->getCode(). ' | MESSAGE: '.$exc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
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
