<?php

/**
 * This is the ActiveResource model class for table "userGroupMappings".
 *
 * The following are the available columns in table 'userGroupMappings':
 * @property string $userGroupMappingID
 * @property string $userID
 * @property string $groupID
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 */
class RUserGroupMappings extends GenericActiveResource {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RUserGroupMappings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Defines the resource property of this class
 	 */
    public function rest(){
    	return CMap::mergeArray(
    		parent::rest(), array(
    			'resource' => 'userGroupMappings',
    			'idProperty' => 'userGroupMappingID',
    			'container' => 'userGroupMappings',
    			'multiContainer' => 'DATA',
    		)
    	);
 	}

 	/**
 	 * Model properties and data types
 	 */
 	public function properties(){
 		return CMap::mergeArray(
 			parent::properties(),
 			array(
				'userGroupMappingID' => array('type' => 'string'),
				'userID' => array('type' => 'string'),
				'groupID' => array('type' => 'string'),
				'status' => array('type' => 'string'),
				'dateCreated' => array('type' => 'string'),
				'createdBy' => array('type' => 'string'),
				'dateModified' => array('type' => 'string'),
				'modifiedBy' => array('type' => 'string'),
 			)
 		);
 	}

 	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, groupID, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
			array('userID, groupID, status, createdBy, modifiedBy', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userGroupMappingID, userID, groupID, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userGroupMappings';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			array(
                'userGroupMappingID' => Yii::t(Yii::app()->language, 'userGroupMappingID'),
                'userID' => Yii::t(Yii::app()->language, 'userID'),
                'groupID' => Yii::t(Yii::app()->language, 'groupID'),
                'status' => Yii::t(Yii::app()->language, 'status'),
                'dateCreated' => Yii::t(Yii::app()->language, 'dateCreated'),
                'createdBy' => Yii::t(Yii::app()->language, 'createdBy'),
                'dateModified' => Yii::t(Yii::app()->language, 'dateModified'),
                'modifiedBy' => Yii::t(Yii::app()->language, 'modifiedBy'),
							),
			parent::attributeLabels()
		);
	}

	/**
     * this function defines the CArrayDataProvider attributes that will be used
     * when loading the admin view
     * @return type
     */
    public function dataProviderAttributes(){
    	return array(
            'caseSensitiveSort' => true,
            'sort' => array(
                'attributes' => array(
                    'userGroupMappingID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'ruser-group-mappings-admin',
            'keyField' => 'userGroupMappingID',
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