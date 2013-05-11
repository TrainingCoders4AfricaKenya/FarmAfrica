<?php

/**
 * Description of TestRestController
 * 
 * Sample controller that implements RESTful services
 *
 * @author muya
 */
class TestRestController extends Controller {
    //Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD HEADERS
     */

    const APPLICATION_ID = 'ASCCPE';

    /**
     * Default response format either 'json' or 'xml'
     */
    private $format = 'json';

    /**
     * @return array action filters
     */
    public function filters() {
        return array();
    }

    // Actions
    /**
     * function to get all models
     */
    public function actionList() {
        Utils::log('DEBUG', 'ABOuT TO FETCH ALL USERS', __CLASS__, __FUNCTION__, __LINE__, false);
        //get the respective model instance
        switch ($_GET['model']) {
            case 'users':
                $models = Users::model()->findAll();
                break;

            default:
                //model not implemented error
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

    public function actionView() {
        //check if id was submitted via GET
        if (!isset($_GET['id'])) {
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing');
        }

        switch ($_GET['model']) {
            case 'users':
                $model = Users::model()->findByPk($_GET['id']);
                break;

            default:
                $this->_sendResponse(501, sprintf(
                                'Mode <b>view</b> is not implemented for model <b>%s</b>', $_GET['model']));
                Yii::app()->end();
                break;
        }

        //did we find the requested model? if not, raise an error
        if (is_null($model)) {
            $this->_sendResponse(404, 'No item found with id ' . $_GET['id']);
        } else {
            $this->_sendResponse(200, CJSON::encode($model));
        }
    }

    public function actionCreate() {
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
        if ($model->save()) {
            $this->_sendResponse(200, CJSON::encode($model));
        } else {
            // Errors occurred
            $msg = APIUtils::packageModelErrors($model);
            $this->_sendResponse(500, $msg);
        }
    }

    public function actionUpdate() {
        //parse the PUT parameters
        $json = file_get_contents('php://input');

        $put_vars = (array) CJSON::decode($json, true);  //true means use associative array
        Utils::log('DEBUG', 'PUT_VARS: ' . Utils::printArray($put_vars), __CLASS__, __FUNCTION__, __LINE__, false);

        switch ($_GET['model']) {
            case 'users':
                $model = Users::model()->findByPk($_GET['id']);
                break;
            default:
                //model not implemented error
                $this->_sendResponse(501, sprintf('Error: Mode <b>update</b> is not implemented for model <b>%s</b>', $_GET['model']));
                Yii::app()->end();
                break;
        }
        //check if we found the requested model
        if ($model === null) {
            $this->_sendResponse(400, sprintf('Error: Did not find any model <b>%s</b> with ID <b>%s</b>.', $_GET['model'], $_GET['id']));
        }

        // Try to assign PUT parameters to attributes
        foreach ($put_vars as $var => $value) {
            Utils::log('DEBUG', 'var: ' . $var . ' | value: ' . $value, __CLASS__, __FUNCTION__, __LINE__, false);
            // Does model have this attribute? If not, raise an error
            if ($model->hasAttribute($var))
                $model->$var = $value;
            else {
                $this->_sendResponse(500, sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, $_GET['model']));
            }
        }

        // Try to save the model
        if ($model->save())
            $this->_sendResponse(200, CJSON::encode($model));
        else
        // prepare the error $msg
        // Errors occurred
            $msg = "<h1>Error</h1>";
        $msg .= sprintf("Couldn't update model <b>%s</b>", $_GET['model']);
        $msg .= "<ul>";
        foreach ($model->errors as $attribute => $attr_errors) {
            $msg .= "<li>Attribute: $attribute</li>";
            $msg .= "<ul>";
            foreach ($attr_errors as $attr_error)
                $msg .= "<li>$attr_error</li>";
            $msg .= "</ul>";
        }
        $msg .= "</ul>";
        $this->_sendResponse(500, $msg);
    }

    public function actionDelete() {
        switch ($_GET['model']) {
            case 'users':
                $model = Users::model()->findByPk($_GET['id']);
                break;

            default:
                $this->_sendResponse(501, sprintf('Error: Mode <b>delete</b> is not implemented for model <b>%s</b>', $_GET['model']));
                Yii::app()->end();
        }
        // Was a model found? If not, raise an error
        if ($model === null)
            $this->_sendResponse(400, sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.", $_GET['model'], $_GET['id']));

        // Delete the model
        $num = $model->delete();

        if ($num > 0)
            $this->_sendResponse(200, $num);    //this is the only way to work with backbone
        else
            $this->_sendResponse(500, sprintf("Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.", $_GET['model'], $_GET['id']));
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
            echo $body;
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
            }
        }

        //servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

        // this should be templatized in a real-world solution
        $body = '<!DOCTYPE html">
            <html>
                    <head>
                            <meta charset="utf-8">
                            <title>' . $status . ' ' . RestUtils::getStatusCodeMessage($status) . '</title>
                    </head>
                    <body>
                            <h1>' . RestUtils::getStatusCodeMessage($status) . '</h1>
                            <p>' . $message . '</p>
                            <hr />
                            <address>' . $signature . '</address>
                    </body>
            </html>';
        echo $body;
        exit;
    }

}

?>