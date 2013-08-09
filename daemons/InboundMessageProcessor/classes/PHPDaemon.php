<?php

require_once("DatabaseUtilities.php");
require_once("WorkerException.php");

/**
 * Script to process something.
 */
class PHPDaemon {

    /**
     * Constructor.
     */
    function __construct() {
        // Initialise things here
    }

    /**
     * Processes something.
     *
     * @param object $mysqli MySQL connection object
     *
     * @return void
     */
    public function process($mysqli, $log) {
        error_log("INFO :: " . date("y-m-d H:i:s") . " About to get the unprocessed requests." . "\n", 3, $log);


        //Build Query
        
        $query = 'SELECT inboundMessageID, messageContent, externalTransactionID, sourceAddress, status FROM inboundMessages WHERE status=305';
        //Execute the query
        $result = DatabaseUtilities::executeQuery($mysqli, $query);
        //Returned result
        error_log("INFO :: " . date("y-m-d H:i:s") . " Unprocessed requests." . count($result) . "\n", 3, $log);
        //if count is greater than 0
        if (count($result) > 0) {
            $i = 0; //count tracker
            foreach ($result as $row) {
                //Assign the values we will be working with

                $inboundMessageID = $row['inboundMessageID'];
                $messageContent = $row['messageContent'];
                $externalTransactionID = $row['externalTransactionID'];
                $sourceAddress = $row['sourceAddress'];

                //Log
                error_log("INFO :: " . date("y-m-d H:i:s") . "::About to process request MESSAGE-" . $messageContent . " msgID-" . $inboundMessageID .  "\n", 3, $log);

                //process...
                
                $insertIntoTransactionSQL = 'INSERT INTO transactions (serviceID, initiatorMSISDN, status, dateCreated)'
                        . ' VALUES (1, "'.$sourceAddress.'", 500, now())';
                DatabaseUtilities::insert($mysqli, $insertIntoTransactionSQL);
                
                //update original to processed
                $updateInboundSQL = 'UPDATE inboundMessages SET status=306 WHERE inboundMessageID='.$inboundMessageID. ' LIMIT 1';
                DatabaseUtilities::update($mysqli, $updateInboundSQL);
                error_log("INFO :: " . date("y-m-d H:i:s") . "::Successfully processed request " . "\n", 3, $log);
                
                
                $i++;
            }
        }
    }

}

?>