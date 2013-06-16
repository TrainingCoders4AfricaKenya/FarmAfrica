<?php

/**
 * This is the model class for table "statusCodes".
 *
 * The followings are the available columns in table 'statusCodes':
 * @property string $statusID
 * @property string $statusDesc
 * @property string $description
 * @property string $statusTypeID
 * @property string $statusCategoryID
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 *
 * The followings are the available model relations:
 * @property StatusTypes $statusType
 * @property StatusCategories $statusCategory
 */
class StatusCodes extends GenericAR {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return StatusCodes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'statusCodes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('statusID, statusDesc, statusTypeID, statusCategoryID, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
            array('statusID, statusTypeID, statusCategoryID, createdBy, modifiedBy', 'length', 'max' => 11),
            array('statusDesc', 'length', 'max' => 150),
            array('description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('statusID, statusDesc, description, statusTypeID, statusCategoryID, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'statusType' => array(self::BELONGS_TO, 'StatusTypes', 'statusTypeID'),
            'statusCategory' => array(self::BELONGS_TO, 'StatusCategories', 'statusCategoryID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'statusID' => 'Status',
            'statusDesc' => 'Status Desc',
            'description' => 'Description',
            'statusTypeID' => 'Status Type',
            'statusCategoryID' => 'Status Category',
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

        $criteria->compare('statusID', $this->statusID, true);
        $criteria->compare('statusDesc', $this->statusDesc, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('statusTypeID', $this->statusTypeID, true);
        $criteria->compare('statusCategoryID', $this->statusCategoryID, true);
        $criteria->compare('dateCreated', $this->dateCreated, true);
        $criteria->compare('createdBy', $this->createdBy, true);
        $criteria->compare('dateModified', $this->dateModified, true);
        $criteria->compare('modifiedBy', $this->modifiedBy, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function returnableForeignKeyFields() {
        return CMap::mergeArray(parent::returnableForeignKeyFields(), array(
            'statusID',
            'statusDesc',
            'description',
        ));
    }

}