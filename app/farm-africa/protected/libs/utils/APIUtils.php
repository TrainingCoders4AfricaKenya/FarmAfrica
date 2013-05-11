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

}

?>
