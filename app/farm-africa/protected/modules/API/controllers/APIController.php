<?php

/**
 * Description of APIController
 * this controller decides to which model the traffic will go, and how it will
 * be processed
 * Controller should ALWAYS return/echo a JSON response before ending the app
 * @author muya
 */
class APIController extends Controller {
    /**
     * function to get all models
     */
    public function actionList() {
        Utils::log('INFO', 'ACTION LIST INVOKED | GET CONTENTS: '.CJSON::encode($_GET), __CLASS__, __FUNCTION__, __LINE__, false);
        
        //parse to get which model is required
        $model = (isset($_GET['model'])) ? $_GET['model'] : null;
        $model = trim($model);
        
        if(is_null($model) || $model == ''){
            //model not provided
            $response = Utils::formatResponse(null, StatCodes::MODEL_MISSING_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_MISSING_DESC);
            Utils::log('ERROR', 'MODEL NOT PROVIDED IN actionList:  | '.CJSON::encode($response), __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatArray($response);
        }
        Utils::log('INFO', 'MODEL FOUND: '.$model, __CLASS__, __FUNCTION__, __LINE__);
        $listActionResponse = APIUtils::listModel($model);
        Utils::log('INFO', 'RESPONSE FROM listModel ACTION: '.CJSON::encode($listActionResponse), __CLASS__, __FUNCTION__, __LINE__);
        
        //parse the response and determine appropriate action
        
        //use STATUS_TYPE to determine success or failure
        if(!$listActionResponse || !isset($listActionResponse['STATUS_TYPE']) || $listActionResponse['STATUS_TYPE'] != StatCodes::SUCCESS_CODE){
            Utils::log('INFO', 'A SERVER ERROR OCCURRED ', __CLASS__, __FUNCTION__, __LINE__);
            //this was a server error
            $this->_sendResponse(500, $listActionResponse);
        }
        else{
            //everything was ok
            Utils::log('INFO', 'list REQUEST WAS OK', __CLASS__, __FUNCTION__, __LINE__);
            $this->_sendResponse(200, $listActionResponse['DATA'][$model]);
        }
        Yii::app()->end();
    }
    
    /**
     * function to create a new model
     */
    public function actionCreate(){
        Utils::log('INFO', 'ACTION CREATE INVOKED ', __CLASS__, __FUNCTION__, __LINE__);
        
        //parse to get which model is required
        $model = (isset($_GET['model'])) ? $_GET['model'] : null;
        $model = trim($model);
        
        if(is_null($model) || $model == ''){
            //model not provided
            $response = Utils::formatResponse(null, StatCodes::MODEL_MISSING_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_MISSING_DESC);
            Utils::log('ERROR', 'MODEL NOT PROVIDED IN actionCreate:  | '.CJSON::encode($response), __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatArray($response);
        }
        Utils::log('INFO', 'MODEL FOUND: '.$model, __CLASS__, __FUNCTION__, __LINE__);
        
        //extract attributes from POST
        if(!isset($_POST) || empty($_POST)){
            //model attributes not provided
            $response = Utils::formatResponse(null, StatCodes::MODEL_ATTRIBUTES_MISSING_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_ATTRIBUTES_MISSING_DESC);
            Utils::log('ERROR', 'MODEL ATTRIBUTES NOT PROVIDED IN actionCreate:  | '.CJSON::encode($response), __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatArray($response);
        }
        $attributes = $_POST;
        
        $createActionResponse = APIUtils::createModel($model, $attributes);
        
        //use STATUS_TYPE to determine success or failure
        if(!$createActionResponse || !isset($createActionResponse['STATUS_TYPE']) || $createActionResponse['STATUS_TYPE'] != StatCodes::SUCCESS_CODE){
            Utils::log('INFO', 'A SERVER ERROR OCCURRED ON create REQUEST', __CLASS__, __FUNCTION__, __LINE__);
            //this was a server error
            $this->_sendResponse(500, $createActionResponse);
        }
        else{
            //everything was ok
            Utils::log('INFO', 'create REQUEST WAS OK', __CLASS__, __FUNCTION__, __LINE__);
            $this->_sendResponse(200, $createActionResponse['DATA']['model']);
        }
        
        Yii::app()->end();
        
        Utils::log('INFO', 'RESPONSE FROM listModel ACTION: '.CJSON::encode($createActionResponse), __CLASS__, __FUNCTION__, __LINE__);
        
        //parse the response and determine appropriate action
        
        //use STATUS_TYPE to determine success or failure
        if(!$createActionResponse || !isset($createActionResponse['STATUS_TYPE']) || $createActionResponse['STATUS_TYPE'] != StatCodes::SUCCESS_CODE){
            Utils::log('INFO', 'A SERVER ERROR OCCURRED ', __CLASS__, __FUNCTION__, __LINE__);
            //this was a server error
            $this->_sendResponse(500, $createActionResponse);
        }
        else{
            //everything was ok
            Utils::log('INFO', 'list REQUEST WAS OK', __CLASS__, __FUNCTION__, __LINE__);
            $this->_sendResponse(200, $createActionResponse['DATA'][$model]);
        }
        Yii::app()->end();
        
        Utils::log('DEBUG', 'REQUEST: ' . CJSON::encode($_REQUEST), __CLASS__, __FUNCTION__, __LINE__, false);
        switch ($_GET['model']) {
            case 'users':
                Utils::log('DEBUG', 'GET REQUEST: ' . CJSON::encode($_GET), __CLASS__, __FUNCTION__, __LINE__, false);
                $model = new Users();
                break;

            default:
                //model not implemented error
                $this->_sendResponse(501, sprintf('Error: Mode <b>create</b> is not implemented for model <b>%s</b>', $_GET['model']));
                Yii::app()->end();
                break;
        }
        //try to assign POST values to attributes
        if(isset($_POST)){
            Utils::log('DEBUG', 'POST REQUEST: ' . CJSON::encode($_POST), __CLASS__, __FUNCTION__, __LINE__, false);
        }
        foreach ($_POST as $var => $value) {
            Utils::log('DEBUG', 'var: ' . $var . ' | value: ' . $value, __CLASS__, __FUNCTION__, __LINE__, false);
            //check if model has this attribute
            if ($model->hasAttribute($var)) {
                $model->$var = $value;
            } else {
                $this->_sendResponse(500, sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, $_GET['model']));
            }
        }

        //try to save model
        $saveResponse = $model->modelAction(GenericAR::CREATE);
        if (!$saveResponse['STATUS']) {
            Utils::log('INFO', 'AN ERROR OCCURRED WHILE SAVING MODEL |  ' . CJSON::encode($saveResponse), __CLASS__, __FUNCTION__, __LINE__, false);
            Utils::log('INFO', 'THE MODEL |  ' . CJSON::encode($model), __CLASS__, __FUNCTION__, __LINE__, false);
            // Errors occurred
            $msg = APIUtils::packageModelErrors($model->getErrors());
            $this->_sendResponse(500, $msg);
        } else {
            $this->_sendResponse(200, CJSON::encode($model));
        }
    }
    
    /**
     * function to get a specific model
     */
    public function actionView() {
        Utils::log('INFO', 'ACTION VIEW INVOKED | GET CONTENTS: '. CJSON::encode($_GET), __CLASS__, __FUNCTION__, __LINE__);
        
        //parse to get which model is required
        $model = (isset($_GET['model'])) ? $_GET['model'] : null;
        $model = trim($model);
        
        if(is_null($model) || $model == ''){
            //model not provided
            $response = Utils::formatResponse(null, StatCodes::MODEL_MISSING_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_MISSING_DESC);
            Utils::log('ERROR', 'MODEL NOT PROVIDED IN actionList:  | '.CJSON::encode($response), __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatArray($response);
        }
        Utils::log('INFO', 'MODEL FOUND: '.$model, __CLASS__, __FUNCTION__, __LINE__);
        
        if(!isset($_GET['id']) || $_GET['id'] == ''){
            //model attributes not provided
            $response = Utils::formatResponse(null, StatCodes::MODEL_ATTRIBUTES_MISSING_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_ATTRIBUTES_MISSING_DESC);
            Utils::log('ERROR', 'MODEL ATTRIBUTES NOT PROVIDED IN actionView:  | '.CJSON::encode($response), __CLASS__, __FUNCTION__, __LINE__);
            return Utils::formatArray($response);
        }
        $id = $_GET['id'];
        Utils::log('DEBUG', 'WILL FETCH MODEL ID: '.$id, __CLASS__, __FUNCTION__, __LINE__);
        $viewActionResponse = APIUtils::viewModel($model, $id);
        
        Utils::log('INFO', 'RESPONSE FROM viewModel ACTION: '.CJSON::encode($viewActionResponse), __CLASS__, __FUNCTION__, __LINE__);
        
        //parse the response and determine appropriate action
        
        //use STATUS_TYPE to determine success or failure
        if((!$viewActionResponse || !isset($viewActionResponse['STATUS_TYPE']) 
                || $viewActionResponse['STATUS_TYPE'] != StatCodes::SUCCESS_CODE)
                && ($viewActionResponse['STATUS_CODE'] != StatCodes::RECORD_NOT_EXIST_CODE)){
            Utils::log('INFO', 'A SERVER ERROR OCCURRED ', __CLASS__, __FUNCTION__, __LINE__);
            //this was a server error
            $this->_sendResponse(500, $viewActionResponse);
        }
        else{
            //everything was ok
            Utils::log('INFO', 'view REQUEST WAS OK', __CLASS__, __FUNCTION__, __LINE__);
            $this->_sendResponse(200, $viewActionResponse['DATA'][$model]);
        }
        Yii::app()->end();
    }
    
    private function _sendResponse($status = 200, $body = '', $content_type = null) {
        if($content_type == null){
            $content_type = 'application/json';
        }
        $status_header =
                'HTTP/1/1 ' . $status . ' ' . RestUtils::getStatusCodeMessage($status);
        //set the status
        header($status_header);

        //set the content type
        header('Content-type: ' . $content_type);

        //pages with body are easy
        if ($body != '') {
            //send the body
            echo CJSON::encode($body);
            exit;
        } else {
            //a body is required if none is passed
            $message = '';

            switch ($status) {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI']
                            . ' was not found';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
                default:
                    $message = 'The server encountered an error processing your request.';
                    break;
                    
            }
            $body = $message;
        }
        echo CJSON::encode($body);
        exit;
    }
}

?>
