<?php

/**
 * Description of APIUtils
 * this class contains utility functions used specifically by the API module
 * @author muya
 */
class APIUtils {
    
    /**
     * @var array Holds the response that the core API functions will return
     */
    public static $modelActionRespose = array(); 
    
    
    /**
     * this function loops through model errors ($model->errors), and packages 
     * them into an array (PHP or JSON) that can be returned by the API
     * @param CModel $model the model that has errors
     * @param string $returnType the format in which the errors will be returned
     * can be either <b>json</b> or <b>array</b>. Defaults to json
     */
    public static function packageModelErrors($model, $returnType = 'json') {
        $modelErrors = array();
        if (!$model->hasErrors()) {
            //model has no errors, return empty array
            return Utils::formatArray($modelErrors, $returnType);
        }
        //model has errors, loop through them and add them to modelErrors
        foreach ($model->getErrors() as $attribute => $attr_errors) {
            $modelErrors['modelErrors'][$attribute] = $attr_errors;
        }
        Utils::log('INFO', 'MODEL ERRORS PACKAGED: '.CJSON::encode($modelErrors), __CLASS__, __FUNCTION__, __LINE__);
        //return the model errors
        return Utils::formatArray($modelErrors, $returnType);
    }
    
    
    /**
     * this function handles the <b>list</b> functionality for our models
     * basically, it does a findAll() for the method
     * @param string $modelName
     * @return array The response from the model action
     */
    public static function listModel($modelName, $attributes = null){
        Utils::log('INFO', 'ABOUT TO FETCH LIST MODEL', __CLASS__, __FUNCTION__, __LINE__);
        
        $className = Utils::parseClassName($modelName);
        
        if(!class_exists($className) || is_a('CActiveRecord', $className)){
            //invalid model provided
            $modelActionRespose = Utils::formatResponse(null, StatCodes::REQUESTED_MODEL_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::REQUESTED_MODEL_NOT_EXIST_DESC);
            Utils::log('ERROR', 'REQUESTED MODEL DOES NOT EXIST | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        $model = new $className();
        if(!$model){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::FAILED_CODE, StatCodes::FAILED_CODE, Yii::t(Yii::app()->language, 'generalError'));
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO INITIALIZE THE MODEL | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        $modelRecords = $model->findAll();
        if(is_array($modelRecords) && empty($modelRecords)){
            Utils::log('INFO', 'NO RECORDS FOUND | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
        }
        else if(!$modelRecords){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::FAILED_CODE, StatCodes::FAILED_CODE, Yii::t(Yii::app()->language, 'generalError'));
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO FETCH MODEL RECORDS | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        
        //prepare response
        $modelRows = array(); //the data that will be returned
        foreach ($modelRecords as $m) {
            $modelRows[] = $m->attributes;
        }
        $recordCount = count($modelRows);
        //add logic for counting # of records to prevent sending of too many records at once
        Utils::log('INFO', $recordCount.' '.$className.' records found.', __CLASS__, __FUNCTION__, __LINE__);
        $modelActionResponseData = array();
        $modelActionResponseData[$modelName] = $modelRows;
        $modelActionRespose = Utils::formatResponse($modelActionResponseData, 
                StatCodes::SUCCESS_CODE, StatCodes::SUCCESS_CODE, Yii::t(
                        Yii::app()->language, 'successfullyFetched{className}Records', 
                        array('{className}' => $className)));
        return $modelActionRespose;
    }
    
    /**
     * this function handles the <b>create</b> functionality for our models
     * @param string $modelName
     * @param array $attributes
     */
    public static function createModel($modelName, $attributes = array()){
        Utils::log('INFO', 'ABOUT TO CREATE MODEL', __CLASS__, __FUNCTION__, __LINE__);
        
        $className = Utils::parseClassName($modelName);
        
        if(!class_exists($className) || is_a('CActiveRecord', $className)){
            //invalid model provided
            $modelActionRespose = Utils::formatResponse(null, StatCodes::REQUESTED_MODEL_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::REQUESTED_MODEL_NOT_EXIST_DESC);
            Utils::log('ERROR', 'REQUESTED MODEL DOES NOT EXIST | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        $model = new $className();
        if(!$model){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::FAILED_CODE, StatCodes::FAILED_CODE, Yii::t(Yii::app()->language, 'generalError'));
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO INITIALIZE THE MODEL | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        
        //load attributes to model
        $model = self::loadModelAttributes($model, $attributes);
        
        //try to save model
        $saveResponse = $model->modelAction(GenericAR::CREATE);
        if (!$saveResponse['STATUS']) {
            //an error occurred during the save
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE SAVING MODEL |  ' . CJSON::encode($saveResponse), __CLASS__, __FUNCTION__, __LINE__, false);
            $modelActionResposeData = APIUtils::packageModelErrors($model, 'array');
            $modelActionRespose = Utils::formatResponse($modelActionResposeData, StatCodes::MODEL_ERROR_DURING_CREATE_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_ERROR_DURING_CREATE_DESC);
        } else {
            //save was ok.
            Utils::log('INFO', $className.' MODEL CREATED SUCCESSFULLY', __CLASS__, __FUNCTION__, __LINE__);
            $modelActionResposeData = (isset($saveResponse['DATA'])) ? $saveResponse['DATA'] : null;
            $modelActionRespose = Utils::formatResponse($modelActionResposeData, StatCodes::MODEL_CREATED_SUCCESSFULLY_CODE, StatCodes::SUCCESS_CODE, StatCodes::MODEL_CREATED_SUCCESSFULLY_CODE);
        }
        return $modelActionRespose;
    }
    
    /**
     * this function handles the <b>update</b> functionality for our models
     * @param type $modelName
     * @param type $id
     * @param type $attributes
     * @return type
     */
    public static function updateModel($modelName, $id, $attributes){
        Utils::log('INFO', 'ABOUT TO UPDATE MODEL | modelName: '.$modelName.' | id: '.$id, __CLASS__, __FUNCTION__, __LINE__);
        
        $className = Utils::parseClassName($modelName);
        
        if(!class_exists($className) || is_a('CActiveRecord', $className)){
            //invalid model provided
            $modelActionRespose = Utils::formatResponse(null, StatCodes::REQUESTED_MODEL_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::REQUESTED_MODEL_NOT_EXIST_DESC);
            Utils::log('ERROR', 'REQUESTED MODEL DOES NOT EXIST | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        
        $model = new $className();
        
        $modelRecord = $model->findByPk($id);
        
        if(!$modelRecord){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::RECORD_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::RECORD_NOT_EXIST_DESC);
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO FETCH MODEL RECORDS | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        
        //load attributes to model
        $modelRecord = self::loadModelAttributes($modelRecord, $attributes);
        
        //try to save model
        $saveResponse = $modelRecord->modelAction(GenericAR::UPDATE);
        if (!$saveResponse['STATUS']) {
            //an error occurred during the save
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE UPDATING MODEL |  ' . CJSON::encode($saveResponse), __CLASS__, __FUNCTION__, __LINE__, false);
            $modelActionResposeData = APIUtils::packageModelErrors($modelRecord, 'array');
            $modelActionRespose = Utils::formatResponse($modelActionResposeData, StatCodes::MODEL_ERROR_DURING_UPDATE_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_ERROR_DURING_UPDATE_DESC);
        } else {
            //save was ok.
            Utils::log('INFO', $className.' MODEL UPDATED SUCCESSFULLY', __CLASS__, __FUNCTION__, __LINE__);
            $modelActionResposeData = (isset($saveResponse['DATA'])) ? $saveResponse['DATA'] : null;
            $modelActionRespose = Utils::formatResponse($modelActionResposeData, StatCodes::MODEL_UPDATED_SUCCESSFULLY_CODE, StatCodes::SUCCESS_CODE, StatCodes::MODEL_UPDATED_SUCCESSFULLY_CODE);
        }
        return $modelActionRespose;
    }
    
    /**
     * this function handles the <b>view</b> functionality for our models
     * @param type $modelName
     * @param type $id
     * @return type
     */
    public static function viewModel($modelName, $id){
        Utils::log('INFO', 'ABOUT TO FETCH LIST MODEL | modelName: '.$modelName.' | id: '.$id, __CLASS__, __FUNCTION__, __LINE__);
        
        $className = Utils::parseClassName($modelName);
        
        if(!class_exists($className) || is_a('CActiveRecord', $className)){
            //invalid model provided
            $modelActionRespose = Utils::formatResponse(null, StatCodes::REQUESTED_MODEL_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::REQUESTED_MODEL_NOT_EXIST_DESC);
            Utils::log('ERROR', 'REQUESTED MODEL DOES NOT EXIST | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        
        $model = new $className();
        if(!$model){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::FAILED_CODE, StatCodes::FAILED_CODE, Yii::t(Yii::app()->language, 'generalError'));
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO INITIALIZE THE MODEL | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        $modelRecord = $model->findByPk($id);
        
        if(!$modelRecord){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::RECORD_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::RECORD_NOT_EXIST_DESC);
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO FETCH MODEL RECORDS | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        Utils::log('INFO', 'REQUESTED RECORD FOUND', __CLASS__, __FUNCTION__, __LINE__);
        $modelActionResponseData = array();
        $modelActionResponseData[$modelName] = $modelRecord;
        $modelActionRespose = Utils::formatResponse($modelActionResponseData, 
                StatCodes::SUCCESS_CODE, StatCodes::SUCCESS_CODE, Yii::t(
                        Yii::app()->language, 'successfullyFetched{className}Records', 
                        array('{className}' => $className)));
        return $modelActionRespose;
    }
    
    /**
     * 
     * @param type $modelName
     * @param type $id
     */
    public static function deleteModel($modelName, $id){
        Utils::log('INFO', 'ABOUT TO FETCH DELETE MODEL | modelName: '.$modelName.' | id: '.$id, __CLASS__, __FUNCTION__, __LINE__);
        
        $className = Utils::parseClassName($modelName);
        
        if(!class_exists($className) || is_a('CActiveRecord', $className)){
            //invalid model provided
            $modelActionRespose = Utils::formatResponse(null, StatCodes::REQUESTED_MODEL_NOT_EXIST_CODE, StatCodes::FAILED_CODE, StatCodes::REQUESTED_MODEL_NOT_EXIST_DESC);
            Utils::log('ERROR', 'REQUESTED MODEL DOES NOT EXIST | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        
        $model = new $className();
        if(!$model){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::FAILED_CODE, StatCodes::FAILED_CODE, Yii::t(Yii::app()->language, 'generalError'));
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO INITIALIZE THE MODEL | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        $modelRecord = $model->findByPk($id);
        
        try {
            $deleteResult = $modelRecord->delete();
        } catch (Exception $exc) {
            $modelActionRespose = Utils::formatResponse(null, StatCodes::FAILED_CODE, StatCodes::FAILED_CODE, Yii::t(Yii::app()->language, 'generalError'));
            Utils::log('EXCEPTION', 'AN EXCEPTION OCCURRED WHILE TRYING TO DELETE THE MODEL | '.CJSON::encode($exc), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }

        if(!$deleteResult){
            $modelActionRespose = Utils::formatResponse(null, StatCodes::MODEL_ERROR_DURING_DELETE_CODE, StatCodes::FAILED_CODE, StatCodes::MODEL_ERROR_DURING_DELETE_DESC);
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO DELETE THE MODEL | '.CJSON::encode($modelActionRespose), __CLASS__, __FUNCTION__, __LINE__);
            return $modelActionRespose;
        }
        Utils::log('INFO', 'RECORD DELETED SUCCESSFULLY', __CLASS__, __FUNCTION__, __LINE__);
        $modelActionRespose = Utils::formatResponse(null, 
                StatCodes::SUCCESS_CODE, StatCodes::SUCCESS_CODE, Yii::t(
                        Yii::app()->language, 'successfullyDeleted{className}Records', 
                        array('{className}' => $className)));
        return $modelActionRespose;
    }
    
    /**
     * function to assign a model attributes to the model
     * @param CModel $model the model to be loaded
     * @param array $attributes key value pairs of attributes
     * @return CModel $model the model with it's attributes loaded
     */
    private static function loadModelAttributes($model, $attributes){
        foreach ($attributes as $var => $value) {
            if ($model->hasAttribute($var)) {
                $model->$var = $value;
            } 
        }
        return $model;
    }
}

?>
