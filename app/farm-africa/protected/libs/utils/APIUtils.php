<?php

/**
 * Description of APIUtils
 * this class contains utility functions used specifically by the API module
 * @author muya
 */
class APIUtils {

    /**
     * this function loops through model errors ($model->errors), and packages 
     * them into an array (PHP or JSON) that can be returned by the API
     * @param CModel $model the model that has errors
     * @param string $returnType the format in which the errors will be returned
     * can be either <b>json</b> or <b>array</b>. Defaults to json
     */
    public static function packageModelErrors($model, $returnType = 'json') {
        $modelErrors = array();
        if (!isset($model->errors)) {
            //model has no errors, return empty array
            return Utils::formatArray($modelErrors, $returnType);
        }
        //model has errors, loop through them and add them to modelErrors
        foreach ($model->errors as $attribute => $attr_errors) {
            $modelErrors['modelErrors'][$attribute] = $attr_errors;
        }
        Utils::log('INFO', 'MODEL ERRORS PACKAGED: '.CJSON::encode($modelErrors), __CLASS__, __FUNCTION__, __LINE__);
        //return the model errors
        return Utils::formatArray($modelErrors, $returnType);
    }
    
    
    /**
     * this function handles the <b>list</b> functionality for our models
     * basically, it does a findAll() for the method
     * @param type $modelName
     * @return array The response from the model action
     */
    public static function listModel($modelName, $attributes = null){
        Utils::log('INFO', 'ABOUT TO FETCH LIST MODEL', __CLASS__, __FUNCTION__, __LINE__);
        /*
         * standardize model name, and try fetch the model
         */
        $modelActionRespose = array();
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
        if(!$modelRecords){
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

}

?>
