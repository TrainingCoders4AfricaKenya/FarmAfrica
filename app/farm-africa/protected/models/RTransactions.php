<?php

/**
 * This is the ActiveResource model class for table "transactions".
 *
 * The following are the available columns in table 'transactions':
 * @property string $transactionID
 * @property string $serviceID
 * @property string $productID
 * @property string $initiatorID
 * @property string $initiatorMSISDN
 * @property string $receiverID
 * @property string $status
 * @property string $dateCreated
 * @property string $dateModified
 */
class RTransactions extends GenericActiveResource {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return RRTransactions the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Defines the resource property of this class
     */
    public function rest() {
        return CMap::mergeArray(
                        parent::rest(), array(
                    'resource' => 'transactions',
                    'idProperty' => 'transactionID',
                    'container' => 'transactions',
                    'multiContainer' => 'DATA',
                        )
        );
    }

    /**
     * Model properties and data types
     */
    public function properties() {
        return CMap::mergeArray(
                        parent::properties(), array(
                    'transactionID' => array('type' => 'string'),
                    'serviceID' => array('type' => 'string'),
                    'productID' => array('type' => 'string'),
                    'initiatorID' => array('type' => 'string'),
                    'initiatorMSISDN' => array('type' => 'string'),
                    'receiverID' => array('type' => 'string'),
                    'status' => array('type' => 'string'),
                    'dateCreated' => array('type' => 'string'),
                    'dateModified' => array('type' => 'string'),
                    'fk_serviceID_serviceName' => array('type' => 'string'),
                        )
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status, dateCreated, dateModified', 'required'),
            array('serviceID, productID, initiatorID, receiverID, status', 'length', 'max' => 11),
            array('initiatorMSISDN', 'length', 'max' => 15),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('transactionID, serviceID, productID, initiatorID, initiatorMSISDN, receiverID, status, dateCreated, dateModified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'transactions';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return CMap::mergeArray(
                        array(
                    'transactionID' => Yii::t(Yii::app()->language, 'transactionID'),
                    'serviceID' => Yii::t(Yii::app()->language, 'serviceID'),
                    'productID' => Yii::t(Yii::app()->language, 'productID'),
                    'initiatorID' => Yii::t(Yii::app()->language, 'initiatorID'),
                    'initiatorMSISDN' => Yii::t(Yii::app()->language, 'initiatorMSISDN'),
                    'receiverID' => Yii::t(Yii::app()->language, 'receiverID'),
                    'status' => Yii::t(Yii::app()->language, 'status'),
                    'dateCreated' => Yii::t(Yii::app()->language, 'dateCreated'),
                    'dateModified' => Yii::t(Yii::app()->language, 'dateModified'),
                    'fk_serviceID_serviceName' => Yii::t(Yii::app()->language, 'Service Name'),
                        ), parent::attributeLabels()
        );
    }

    /**
     * this function defines the CArrayDataProvider attributes that will be used
     * when loading the admin view
     * @return type
     */
    public function dataProviderAttributes() {
        return array(
            'caseSensitiveSort' => true,
            'sort' => array(
                'attributes' => array(
                    'transactionID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'rtransactions-admin',
            'keyField' => 'transactionID',
                //un-comment to use these fields
                /*
                  'data' => array(),
                  'itemCount'=> integer,
                  'rawData' => array(),
                  'totalItemCount' => integer
                 */
        );
    }

}