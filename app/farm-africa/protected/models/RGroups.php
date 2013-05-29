<?php

/**
 * This is the ActiveResource model class for table "groups".
 *
 * The following are the available columns in table 'groups':
 * @property string $groupID
 * @property string $groupName
 * @property string $description
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 */
class RGroups extends GenericActiveResource {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return RRGroups the static model class
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
                    'resource' => 'groups',
                    'idProperty' => 'groupID',
                    'container' => 'groups',
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
                    'groupID' => array('type' => 'integer'),
                    'groupName' => array('type' => 'string'),
                    'description' => array('type' => 'string'),
                    'status' => array('type' => 'integer'),
                    'dateCreated' => array('type' => 'string'),
                    'createdBy' => array('type' => 'integer'),
                    'dateModified' => array('type' => 'string'),
                    'modifiedBy' => array('type' => 'integer'),
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
            array('groupName, description, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
            array('groupName', 'length', 'max' => 45),
            array('description', 'length', 'max' => 200),
            array('status, createdBy, modifiedBy', 'length', 'max' => 11),
            // The following rule is ugetDsed by search().
            // Please remove those attributes that should not be searched.
            array('groupID, groupName, description, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'groups';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return CMap::mergeArray(
                        array(
                    'groupID' => Yii::t(Yii::app()->language, 'groupID'),
                    'groupName' => Yii::t(Yii::app()->language, 'groupName'),
                    'description' => Yii::t(Yii::app()->language, 'description'),
                    'status' => Yii::t(Yii::app()->language, 'status'),
                    'dateCreated' => Yii::t(Yii::app()->language, 'dateCreated'),
                    'createdBy' => Yii::t(Yii::app()->language, 'createdBy'),
                    'dateModified' => Yii::t(Yii::app()->language, 'dateModified'),
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
                    'groupID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'rgroups-admin',
            'keyField' => 'groupID',
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