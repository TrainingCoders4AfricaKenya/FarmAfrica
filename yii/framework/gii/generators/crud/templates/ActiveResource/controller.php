<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new <?php echo $this->getARModelClass(); ?>;

		if(isset($_POST['<?php echo $this->getARModelClass(); ?>'])){
			//only attempt to save if POST is set
			Utils::log('INFO', 'POST REQUEST: '.CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
			$model->attributes=$_POST['<?php echo $this->getARModelClass(); ?>'];
			Utils::log('INFO', 'ATTRIBUTES: '.CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);

			//attempt to save
			try{
				$saveOK = $model->save();
                if ($saveOK) {
                    Utils::log('INFO', 'MODEL SAVE  OK', __CLASS__, __FUNCTION__, __LINE__);
                    $this->redirect(array('view', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
                } else {
                    Utils::log('INFO', 'SAVE NOT OK'.CJSON::encode($model->getErrors()));
                    $this->render('create', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }
			}
			catch (EActiveResourceRequestException $resourceExc) {
				//Catch EActiveResourceRequestException which is thrown in case of any errors
				Utils::log('EXCEPTION', 'EActiveResourceRequestException ON CREATE <?php echo $this->getARModelClass(); ?> | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array)  CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: '.Utils::printArray($modelErrors));
                if($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])){
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO CREATE <?php echo $this->getARModelClass(); ?> | '
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
			}
			catch (Exception $exc) {
				//error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO CREATE <?php echo $this->getARModelClass(); ?>  | '
                        .CJSON::encode($exc),__CLASS__, __FUNCTION__, __LINE__ );
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 
                	'sorryAnErrorOccurredWhileCreatingThe{model}Record', array('{model}' => '<?php echo $this->modelClass ?>')));
                $this->render('create', array(
                    'model' => $model,
                ));
                Yii::app()->end();
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if(isset($_POST['<?php echo $this->getARModelClass(); ?>'])){
			//only attempt to save if POST is set
			Utils::log('INFO', 'POST REQUEST: '.CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
			$model->attributes=$_POST['<?php echo $this->getARModelClass(); ?>'];
			Utils::log('INFO', 'ATTRIBUTES: '.CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);

			//attempt to save
			try{
				$saveOK = $model->save();
                if ($saveOK) {
                    Utils::log('INFO', 'MODEL SAVE  OK', __CLASS__, __FUNCTION__, __LINE__);
                    $this->redirect(array('view', 'id' => $model-><?php echo $this->tableSchema->primaryKey; ?>));
                } else {
                    Utils::log('INFO', 'SAVE NOT OK'.CJSON::encode($model->getErrors()));
                    $this->render('update', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }
			}
			catch (EActiveResourceRequestException $resourceExc) {
				//Catch EActiveResourceRequestException which is thrown in case of any errors
				Utils::log('EXCEPTION', 'EActiveResourceRequestException ON UPDATE <?php echo $this->getARModelClass(); ?> | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array)  CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: '.Utils::printArray($modelErrors));
                if($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])){
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO UPDATE <?php echo $this->getARModelClass(); ?> | '
                            .CJSON::encode($errorMsg),__CLASS__, __FUNCTION__, __LINE__ );
                    Yii::app()->user->setFlash('error', 'Error occurred');
                }
                else{
                    $model->addErrors($modelErrors['modelErrors']);
                }
                
                $this->render('update', array(
                    'model' => $model,
                ));
                Yii::app()->end();
			}
			catch (Exception $exc) {
				//error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO UPDATE <?php echo $this->getARModelClass(); ?>  | '
                        .CJSON::encode($exc),__CLASS__, __FUNCTION__, __LINE__ );
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 
                	'sorryAnErrorOccurredWhileUpdatingThe{model}Record', array('{model}' => '<?php echo $this->modelClass ?>')));
                $this->render('update', array(
                    'model' => $model,
                ));
                Yii::app()->end();
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
		exit();
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

		Utils::log('DEBUG', 'REQUEST: '.CJSON::encode($_REQUEST));


		if(isset($_POST['<?php echo $this->getARModelClass(); ?>'])){
			Utils::log('INFO', 'POST REQUEST: '.CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__);
			$model->attributes=$_POST['<?php echo $this->getARModelClass(); ?>'];
            Utils::log('INFO', 'ATTRIBUTES: '.CJSON::encode($model->attributes), __CLASS__, __FUNCTION__, __LINE__);

            //attempt to save
			try{
				$deleteOK = $model->deleteById($id);
                if ($deleteOK) {
                    Utils::log('INFO', 'MODEL DELETE  OK', __CLASS__, __FUNCTION__, __LINE__);
                    $this->redirect(array('admin'));
                } else {
                    Utils::log('INFO', 'MODEL DELETE NOT OK'.CJSON::encode($model->getErrors()));
                    $this->render('delete', array(
                        'model' => $model,
                    ));
                    Yii::app()->end();
                }
			}
			catch (EActiveResourceRequestException $resourceExc) {
				//Catch EActiveResourceRequestException which is thrown in case of any errors
				Utils::log('EXCEPTION', 'EActiveResourceRequestException ON DELETE <?php echo $this->getARModelClass(); ?> | CODE: '
                        . $resourceExc->getCode() . ' | MESSAGE: ' . $resourceExc->getMessage(), __CLASS__, __FUNCTION__, __LINE__);
                //an error occurred while doing processing
                $modelErrors = array();
                $errorMsg = $resourceExc->getMessage();
                $modelErrors = (array)  CJSON::decode($errorMsg);
                $modelErrors = (isset($modelErrors['DATA'])) ? $modelErrors['DATA'] : null;
                Utils::log('DEBUG', 'MODEL ERRORS CONTENT: '.Utils::printArray($modelErrors));
                if($modelErrors == null || empty($modelErrors) || !isset($modelErrors['modelErrors'])){
                    //error that occurred wasn't model-related
                    Utils::log('ERROR', 'NON-MODEL ERROR OCCURRED WHILE TRYING TO DELETE <?php echo $this->getARModelClass(); ?> | '
                            .CJSON::encode($errorMsg),__CLASS__, __FUNCTION__, __LINE__ );
                    Yii::app()->user->setFlash('error', 'Error occurred');
                }
                else{
                    $model->addErrors($modelErrors['modelErrors']);
                }
                
                $this->render('delete', array(
                    'model' => $model,
                ));
                Yii::app()->end();
			}
			catch (Exception $exc) {
				//error that occurred wasn't model-related
                Utils::log('EXCEPTION', 'AN Exception OCCURRED WHILE TRYING TO DELETE <?php echo $this->getARModelClass(); ?>  | '
                        .CJSON::encode($exc),__CLASS__, __FUNCTION__, __LINE__ );
                Yii::app()->user->setFlash('error', Yii::t(Yii::app()->language, 
                	'sorryAnErrorOccurredWhileDeletingThe{model}Record', array('{model}' => '<?php echo $this->modelClass ?>')));
                $this->render('delete', array(
                    'model' => $model,
                ));
                Yii::app()->end();
			}
		}

		$this->render('delete',array(
			'model'=>$model,
		));
		exit();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect('admin');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new <?php echo $this->getARModelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->getARModelClass(); ?>']))
			$model->attributes=$_GET['<?php echo $this->getARModelClass(); ?>'];

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
	 * @return <?php echo $this->modelClass; ?> the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		
		try {
            $model = <?php echo $this->getARModelClass(); ?>::model()->findById($id);
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
	 * @param <?php echo $this->modelClass; ?> $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
