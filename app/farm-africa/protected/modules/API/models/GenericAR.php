<?php

/**
 * Description of GenericAR
 * this class extends CActiveRecord, all models will extend this one
 * it performs additional validation/actions that is required for all models, 
 * specific to the FarmAfrica project
 * @author muya
 */
class GenericAR extends CActiveRecord {
    
    const CREATE = 1;
    const UPDATE = 2;
    const VIEW = 3;
    const DELETE = 4;
    
    /**
     * @var int $status 
     */
    public $status;
    /**
     * @var string $dateCreated the date on which the record was created
     */
    public $dateCreated;
    /**
     * @var int the userID of the user who created the record
     */
    public $createdBy;
    /**
     * @var string the date on which the record was last modified 
     */
    public $dateModified;
    /**
     * @var int the userID of the user who last modified the record 
     */
    public $modifiedBy;
    /**
     * @var string reasons for performing certain actions on the system 
     */ 
    public $narration;
    
    /**
     * this function determines what action to perform on the given model
     * @param int $action
     * @param GenericAR $model
     * @param boolean $override
     */
    public function modelAction($action, $model, $override = false){
        Utils::log('INFO', 'ABOUT TO PERFORM MODEL ACTION: '.$action, __CLASS__, __FUNCTION__, __LINE__);
        $modelActionResponse = array();
        switch ($action) {
            case self::CREATE:
                $modelActionResponse = $this->create($override);
                break;
            case self::UPDATE:
                break;
            case self::VIEW:
                break;
            case self::DELETE:
                break;
            default:
                break;
        }
    }
    
    /**
     * this function saves a model
     * it will save default values for the model
     * @param GenericAR $model
     * @param boolean $override
     */
    private function create($override = false){
        $actionResponse = array();
        $this->insertedBy = Yii::app()->user->userID;
        $this->modifiedBy = Yii::app()->user->userID;
        $this->dateCreated = Utils::now();
        $this->status = StatCodes::ES_ACTIVE;
        
        $actionResponse['STATUS'] = $this->save();
        if(!$actionResponse['STATUS']){
            //save failed
            Utils::log('ERROR', 'AN ERROR OCCURRED WHILE TRYING TO SAVE THE MODEL', __CLASS__, __FUNCTION__, __LINE__);
        }
        else{
            //save was ok
        }
    }
    
    /**
     * add default params (dateCreated, createdBy, dateModified, modifiedBy)
     * where necessary
     */
    protected function beforeValidate() {
        if($this->isNewRecord){
            //if this is a new record, set createdBy, dateCreated, modifiedBy 
            //(dateModified is auto in db)
            $this->createdBy = Yii::app()->user->userID;
            $this->dateCreated = Utils::now();
            $this->modifiedBy = Yii::app()->user->userID;
        }
        else{
            //for update, just set modifiedBy (dateModified is auto in db)
            $this->dateModified = Utils::now();  //just in case :-)
            $this->modifiedBy = Yii::app()->user->userID;
        }
        parent::beforeValidate();
    }
}

?>
