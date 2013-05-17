<?php
/**
 * Description of StatCodes
 * Defines status codes used in the system
 * Should map to records in statusCodes table
 * all status code variable names should end with _CODE, e.g. SUCCESS_CODE
 * all status code description variable names should end with _DESC, e.g. SUCCESS_DESC
 * @author muya
 */
class StatCodes {
    /* ENTITY STATES */
    const ES_ACTIVE = 1;  //entity state active
    const ES_INACTIVE = 2;  //entity state inactive
    
    /* GENERAL STATUS CODES */
    const SUCCESS_CODE = 1;
    const FAILED_CODE = 2;
    
    /* API STATUS CODES */
    const REQUESTED_MODEL_NOT_EXIST_CODE = 200;
    const MODEL_MISSING_CODE = 201;
    
    /* API STATUS DESCRIPTIONS */
    const MODEL_MISSING_DESC = 'Model is missing from the API request';
    const REQUESTED_MODEL_NOT_EXIST_DESC = 'The requested model does not exist';
}

?>
