<?php

/**
 * This is the ActiveResource model class for table "notifications".
 *
 * The following are the available columns in table 'notifications':
 * @property string $notificationID
 * @property string $notificationTypeID
 * @property string $message
 * @property string $destinationAddress
 * @property string $messageDetails
 * @property string $status
 * @property string $dateCreated
 * @property string $dateModified
 * @property string $createdBy
 * @property string $modifiedBy
 */
class RNotifications extends GenericActiveResource {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return RRNotifications the static model class
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
                    'resource' => 'notifications',
                    'idProperty' => 'notificationID',
                    'container' => 'notifications',
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
                    'notificationID' => array('type' => 'string'),
                    'notificationTypeID' => array('type' => 'string'),
                    'message' => array('type' => 'string'),
                    'destinationAddress' => array('type' => 'string'),
                    'messageDetails' => array('type' => 'string'),
                    'status' => array('type' => 'string'),
                    'dateCreated' => array('type' => 'string'),
                    'dateModified' => array('type' => 'string'),
                    'createdBy' => array('type' => 'string'),
                    'modifiedBy' => array('type' => 'string'),
                    'fk_notificationTypeID_notificationTypeName' => array('type' => 'string'),
                    'fk_status_statusDesc' => array('type' => 'string'),
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
            array('notificationTypeID, status, dateCreated, dateModified, createdBy, modifiedBy', 'required'),
            array('notificationTypeID, status, createdBy, modifiedBy', 'length', 'max' => 11),
            array('destinationAddress', 'length', 'max' => 100),
            array('message, messageDetails', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('notificationID, notificationTypeID, message, destinationAddress, messageDetails, status, dateCreated, dateModified, createdBy, modifiedBy', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notifications';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return CMap::mergeArray(
                        array(
                    'notificationID' => Yii::t(Yii::app()->language, 'notificationID'),
                    'fk_notificationTypeID_notificationTypeName' => Yii::t(Yii::app()->language, 'notificationTypeName'),
                    'notificationTypeID' => Yii::t(Yii::app()->language, 'notificationTypeID'),
                    'message' => Yii::t(Yii::app()->language, 'message'),
                    'destinationAddress' => Yii::t(Yii::app()->language, 'destinationAddress'),
                    'messageDetails' => Yii::t(Yii::app()->language, 'messageDetails'),
                    'status' => Yii::t(Yii::app()->language, 'status'),
                    'fk_status_statusDesc' => Yii::t(Yii::app()->language, 'status'),
                    'dateCreated' => Yii::t(Yii::app()->language, 'dateCreated'),
                    'dateModified' => Yii::t(Yii::app()->language, 'dateModified'),
                    'createdBy' => Yii::t(Yii::app()->language, 'createdBy'),
                    'modifiedBy' => Yii::t(Yii::app()->language, 'modifiedBy'),
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
                    'notificationID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'rnotifications-admin',
            'keyField' => 'notificationID',
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