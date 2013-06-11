<?php

/**
 * This is the model class for table "notificationTypes".
 *
 * The followings are the available columns in table 'notificationTypes':
 * @property string $notificationTypeID
 * @property string $notificationTypeName
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 *
 * The followings are the available model relations:
 * @property Notifications[] $notifications
 */
class NotificationTypes extends GenericAR {
    const EMAIL = 1;
    const SMS = 2;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NotificationTypes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'notificationTypes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('notificationTypeName, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
            array('notificationTypeName', 'length', 'max' => 30),
            array('status, createdBy, modifiedBy', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('notificationTypeID, notificationTypeName, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'notifications' => array(self::HAS_MANY, 'Notifications', 'notificationTypeID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'notificationTypeID' => 'Notification Type',
            'notificationTypeName' => 'Notification Type Name',
            'status' => 'Status',
            'dateCreated' => 'Date Created',
            'createdBy' => 'Created By',
            'dateModified' => 'Date Modified',
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

        $criteria->compare('notificationTypeID', $this->notificationTypeID);
        $criteria->compare('notificationTypeName', $this->notificationTypeName, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('createdBy', $this->createdBy);
        $criteria->compare('dateModified', $this->dateModified, true);
        $criteria->compare('modifiedBy', $this->modifiedBy);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}