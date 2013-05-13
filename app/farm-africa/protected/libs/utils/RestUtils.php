<?php
/**
 * Description of RestUtils
 *
 * @author muya
 */
class RestUtils {
    public static function getStatusCodeMessage($status) {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    }
    
    public static function createDataProvider($model, $dataProviderAttributes = null){
        
        //we have to create an array which will be used to return a CArrayDataProvider
        $className = get_class($model);
        if(!$className){
            return null;
        }
        $dataItems = $className::model()->findAll();
        if($dataProviderAttributes == null){
            //if this isn't defined, use settings for this model
            $dataProviderAttributes = $className::model()->dataProviderAttributes();
        }
        $dataProvider=new CArrayDataProvider($dataItems, $dataProviderAttributes);
        return $dataProvider;
    }
    
    public static function getDataProviderColumnNames($model, $columnsToDisplay = array()){
        $className = get_class($model);
        if(!$className){
            return null;
        }
        $attributeLabels = $className::model()->attributeLabels();
        $columnNames = array();
        foreach($attributeLabels as $k=>$v){
            if(!in_array($k, $columnsToDisplay))
                continue;
            $columnNames[] = $k.':raw:'.$v;
        }
        Utils::log('INFO', 'COLUMNS: '.CJSON::encode($columnNames));
        return $columnNames;
    }
    
    public static function formatPOSTData($dataArray){
        $fields_string = '';
        foreach ($dataArray as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        return $fields_string;
    }
}

?>
