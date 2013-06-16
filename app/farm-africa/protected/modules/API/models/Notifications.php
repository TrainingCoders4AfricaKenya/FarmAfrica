<?php

/**
 * This is the model class for table "notifications".
 *
 * The followings are the available columns in table 'notifications':
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
 *
 * The followings are the available model relations:
 * @property NotificationTypes $notificationType
 */
class Notifications extends GenericAR {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notifications the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notifications';
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
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'notificationType_' => array(self::BELONGS_TO, 'NotificationTypes', 'notificationTypeID'),
            'status_' => array(self::BELONGS_TO, 'StatusCodes', 'status'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'notificationID' => 'Notification',
            'notificationTypeID' => 'Notification Type',
            'message' => 'Message',
            'destinationAddress' => 'Destination Address',
            'messageDetails' => 'Message Details',
            'status' => 'Status',
            'dateCreated' => 'Date Created',
            'dateModified' => 'Date Modified',
            'createdBy' => 'Created By',
            'modifiedBy' => 'Modified By',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('notificationID', $this->notificationID);
        $criteria->compare('notificationTypeID', $this->notificationTypeID);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('destinationAddress', $this->destinationAddress, true);
        $criteria->compare('messageDetails', $this->messageDetails, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('dateModified', $this->dateModified, true);
        $criteria->compare('createdBy', $this->createdBy);
        $criteria->compare('modifiedBy', $this->modifiedBy);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    

}