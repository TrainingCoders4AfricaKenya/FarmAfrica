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
        if(!$listActionResponse || !isset($listActionResponse['STATUS_TYPE'])){
            Utils::log('INFO', 'A SERVER ERROR OCCURRED ', __CLASS__, __FUNCTION__, __LINE__);
            //this was a server error
            $this->_sendResponse(500, $listActionResponse);
        }
        else{
            //everything was ok
            Utils::log('INFO', 'REQUEST WAS OK', __CLASS__, __FUNCTION__, __LINE__);
            $this->_sendResponse(200, $listActionResponse['DATA'][$model]);
        }
        Yii::app()->end();
        
        //get the respective model instance
        switch ($_GET['model']) {
            case 'users':
                $models = Users::model()->findAll();
                break;

            default:
                //model not implemented error
                $this->_sendResponse(501, 'Error: Mode list is not implemented for model '.$_GET['model']);
                $this->_sendResponse(501, sprintf('Error: Mode <b>list</b> is not implemented for model <b>%s</b>', $_GET['model']));
                Yii::app()->end();
                break;
        }
        
        if (empty($models)) {
            Utils::log('INFO', 'No users found', __CLASS__, __FUNCTION__, __LINE__, false);
        
            //no results found
            $this->_sendResponse(200, sprintf('No items found for model <b>%s</b>', $_GET['model']));
        } else {
            Utils::log('INFO', 'Users found', __CLASS__, __FUNCTION__, __LINE__, false);
            //prepare response
            $rows = array();
            foreach ($models as $model) {
                $rows[] = $model->attributes;
            }
            //send response
            $this->_sendResponse(200, CJSON::encode($rows));
        }
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
