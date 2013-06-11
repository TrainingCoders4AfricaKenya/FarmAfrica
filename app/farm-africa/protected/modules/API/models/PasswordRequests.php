<?php

/**
 * This is the model class for table "passwordRequests".
 *
 * The followings are the available columns in table 'passwordRequests':
 * @property string $passwordRequestID
 * @property string $token
 * @property string $identifier
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 */
class PasswordRequests extends GenericAR {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PasswordRequests the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'passwordRequests';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('token, identifier, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
            array('token', 'length', 'max' => 256),
            array('identifier', 'length', 'max' => 150),
            array('status, createdBy, modifiedBy', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('passwordRequestID, token, identifier, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'passwordRequestID' => 'Password Request',
            'token' => 'Token',
            'identifier' => 'Identifier',
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

        $criteria->compare('passwordRequestID', $this->passwordRequestID, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('identifier', $this->identifier, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('createdBy', $this->createdBy, true);
        $criteria->compare('dateModified', $this->dateModified, true);
        $criteria->compare('modifiedBy', $this->modifiedBy, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}