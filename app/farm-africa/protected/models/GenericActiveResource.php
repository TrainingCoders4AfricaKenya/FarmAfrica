<?php

/**
 * Description of GenericActiveResource
 * this class extends EActiveResource and is extended by all other model classes
 * for the FarmAfrica front-end
 * @author muya
 */
class GenericActiveResource extends EActiveResource {
    
    
    public $id;
    public $primaryKey;
    public $narration;
    /**
     * defines properties for the resource
     * @return array
     */
    public function properties() {

        return array(
            'status' => array('type' => 'integer'),
            'dateCreated' => array('type' => 'datetime'),
            'createdBy' => array('type' => 'integer'),
            'dateModified' => array('type' => 'timestamp'),
            'modifiedBy' => array('type' => 'integer'),
        );
    }
    
    /**
     * defines the model's attribute labels
     * @return array
     */
    public function attributeLabels() {
        return array(
            'status' => Yii::t(Yii::app()->language, 'status'),
            'dateCreated' => Yii::t(Yii::app()->language, 'dateCreated'),
            'createdBy' => Yii::t(Yii::app()->language, 'createdBy'),
            'dateModified' => Yii::t(Yii::app()->language, 'dateModified'),
            'modifiedBy' => Yii::t(Yii::app()->language, 'modifiedBy'),
        );
    }

    /**
     * this function defines the CArrayDataProvider attributes that will be used
     * when loading the admin view
     * @return type
     */
    public function dataProviderAttributes() {
        //refer to Yii's CArrayDataProvider documentation
        //modify to taste
        return array(
            'caseSensitiveSort' => true,
            'sort' => array(
                'attributes' => array(
                    'id',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
                //un-comment to use these fields
                /*
                  'id' => '',
                  'keyField' => '',
                  'data' => array(),
                  'itemCount'=> integer,
                  'rawData' => array(),
                  'totalItemCount' => integer
                 */
        );
    }
    
    public function save($runValidation = true, $attributes = null) {
        if ($this->isNewResource) {
            Utils::log('DEBUG', 'NEW RESOURCE');
            //if this is a new record, set createdBy, dateCreated, modifiedBy 
            //(dateModified is auto in db)
            $this->status = StatCodes::ES_ACTIVE;
            $this->createdBy = Yii::app()->user->userID;
            $this->dateCreated = Utils::now();
            $this->modifiedBy = Yii::app()->user->userID;
            $this->dateModified = Utils::now();
        } else {
            Utils::log('DEBUG', 'UPDATE RESOURCE');
            //for update, just set modifiedBy (dateModified is auto in db)
            $this->dateModified = Utils::now();  //just in case :-)
            $this->modifiedBy = Yii::app()->user->userID;
        }
        return parent::save($runValidation, $attributes);
    }

    /**
     * add default params (dateCreated, createdBy, dateModified, modifiedBy)
     * where necessary
     */
//    protected function beforeValidate() {
//        Utils::log('DEBUG', 'WILL RUN BEFORE VALIDATE: '.CJSON::encode($this->getValidators()));
////        die();
//        if ($this->isNewResource) {
//            Utils::log('DEBUG', 'NEW RESOURCE');
//            //if this is a new record, set createdBy, dateCreated, modifiedBy 
//            //(dateModified is auto in db)
//            $this->status = 1;
//            $this->createdBy = Yii::app()->user->userID;
//            $this->dateCreated = Utils::now();
//            $this->modifiedBy = Yii::app()->user->userID;
//            $this->dateModified = Utils::now();
//        } else {
//            Utils::log('DEBUG', 'UPDATE RESOURCE');
//            //for update, just set modifiedBy (dateModified is auto in db)
//            $this->dateModified = Utils::now();  //just in case :-)
//            $this->modifiedBy = Yii::app()->user->userID;
//        }
//        Utils::log('DEBUG', 'CURRENT STATE: '.CJSON::encode($this));
//        parent::beforeValidate();
//    }

}

?>
