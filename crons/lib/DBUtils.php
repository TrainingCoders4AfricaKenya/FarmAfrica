<?php

/**
 * Description of DBUtils
 * this class contains DB-related utility functions for FarmAfrica crons
 * @author muya
 */
require_once dirname(__FILE__).'/../config/config.php';
require_once dirname(__FILE__).'/CronUtils.php';
class DBUtils {

    /**
     * function to connect to MySQL using more secure PDO method
     * 
     */
    public static function PDOConnect($db = null, $host = null, $user = null, $pass = null) {
        if ($db === null) {
            $db = DBNAME;
        }
        if ($host === null) {
            $host = DBHOST;
        }
        if ($user === null) {
            $user = DBUSER;
        }
        if ($pass === null) {
            $pass = DBPASS;
        }
        try {
            $connString = 'mysql:host=' . $host . ';dbname=' . $db;
            $conn = new PDO($connString, $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            CronUtils::log('EXCEPTION', 'AN ERROR OCCURRED WHILE TRYING TO CONNECT TO THE DATABASE | ' . $e->getCode() . ' | ' . $e->getMessage(), __LINE__, __FUNCTION__);
            return null;
        }
        return $conn;
    }

    /**
     * function to close a PDO connection
     * @param null $PDOConnection
     * @return type
     */
    public static function PDOClose($PDOConnection) {
        $PDOConnection = null;
        return;
    }

    /**
     * function that utilizes prepared statements & PDO methods to fetch data from db
     * @param string $tableName table from which to fetch data
     * @param array $columnsToFetch an array of columns to return, defaults to '' (all)
     * @param array $filters parameters to be used in WHERE as criteria
     * @return array    returns a formattedResponse (from @method formatResponse)
     */
    public static function PDOFetchRecords($tableName, $columnsToFetch = array(), $filters = array(), $dbConn = null, $fetchMode = PDO::FETCH_ASSOC) {
        if ($dbConn == null) {
            $dbConn = self::PDOConnect();
        }
        if ($dbConn == null) {
            return CronUtils::formatResponse(null, SC_GENERIC_FAILURE_CODE, 4, 'THERE WAS AN ERROR CONNECTING TO THE DATABASE');
        }

        //construct prepared statement
        //columns to fetch
        if (empty($columnsToFetch)) {
            $columns = ' * ';
        } else {
            $columns = implode(' , ', $columnsToFetch);
        }

        //where clause
        if (empty($filters)) {
            $where = '';
        } else {
            $where = ' WHERE ';
            $ANDCounter = 0;
            foreach ($filters as $k => $v) {
                if ($ANDCounter > 0) {
                    $where .= ' AND ';
                }
                $where .= $k . '=:' . $k . ' ';
                $ANDCounter++;
            }
            $where = rtrim($where, 'AND');
        }
        $preparedStatement = 'SELECT ' . $columns . ' FROM ' . $tableName . $where;

        $resultData = self::executePreparedStatement($preparedStatement, $filters, $fetchMode, $dbConn);

        return $resultData;
    }

    /**
     * function to execute prepared mysql statements
     * @param type $SQL the prepared statement to be executed
     * @param type $params  the params to bind to the statement
     * @param type $fetchMode   format of fetched data(if any) defaults to associative array (PDO::FETCH_ASSOC)
     * @param type $dbConn  the db connection to be used
     * @param type $noFetch if set to true, method will not attempt to fetch any 
     * data SET TO TRUE FOR INSERT & UPDATE STATEMENTS
     * @return formatResponse ARRAY
     */
    public static function executePreparedStatement($SQL, $params, $fetchMode = null, $dbConn = null, $noFetch = FALSE, $getLastInsert = FALSE) {
        if ($dbConn == null) {
            $dbConn = self::PDOConnect();
        }
        if ($dbConn == null) {
            return CronUtils::formatResponse(null, SC_GENERIC_FAILURE_CODE, SC_GENERIC_FAILURE_CODE, 'THERE WAS AN ERROR CONNECTING TO THE DATABASE');
        }
        if($fetchMode == null){
            $fetchMode = PDO::FETCH_ASSOC;
        }
        try {

            CronUtils::log('INFO', 'SQL TO BE EXECUTED: ' . $SQL, __LINE__, __FUNCTION__);
            $stmt = $dbConn->prepare($SQL);
            $executeStatus = $stmt->execute($params);
            if ($noFetch == TRUE) {
                $results = $executeStatus;
            } else {
                $results = $stmt->fetchAll($fetchMode);
            }
        } catch (PDOException $exc) {
            CronUtils::log('EXCEPTION', 'A DATABASE ERROR OCCURRED | ' . $exc->getCode() . ' | ' . $exc->getMessage(), __LINE__, __FUNCTION__);
            return CronUtils::formatResponse(null, SC_GENERIC_FAILURE_CODE, SC_GENERIC_FAILURE_CODE, $exc->getMessage());
        } catch (Exception $e) {
            CronUtils::log('EXCEPTION', 'A GENERAL EXCEPTION OCCURRED | ' . $e->getCode() . ' | ' . $e->getMessage(), __LINE__, __FUNCTION__);
            return CronUtils::formatResponse(null, SC_GENERIC_FAILURE_CODE, SC_GENERIC_FAILURE_CODE, $e->getMessage());
        }
        //return data
//    flog(DEBUG, 'GETLASTINSERT:::'.$dbConn->lastInsertId());
        if ($getLastInsert == TRUE) {
            $lastInsert = $dbConn->lastInsertId();
            $results = $lastInsert;
        }
        CronUtils::log('INFO', 'ABOUT TO COMPLETE EXECUTE PREPARED STATEMENT ', __LINE__, __FUNCTION__);
        return CronUtils::formatResponse($results, SC_GENERIC_SUCCESS_CODE, SC_GENERIC_SUCCESS_CODE, SC_GENERIC_SUCCESS_DESC);
    }

}

?>
