<?php

/**
 * This is the ActiveResource model class for table "productTypes".
 *
 * The following are the available columns in table 'productTypes':
 * @property string $productTypeID
 * @property string $productTypeName
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 */
class RProductTypes extends GenericActiveResource {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RProductTypes the static model class
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
    			'resource' => 'productTypes',
    			'idProperty' => 'productTypeID',
    			'container' => 'productTypes',
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
				'productTypeID' => array('type' => 'string'),
				'productTypeName' => array('type' => 'string'),
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
			array('productTypeName, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
			array('productTypeName', 'length', 'max'=>45),
			array('status, createdBy, modifiedBy', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productTypeID, productTypeName, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'productTypes';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			array(
									'productTypeID' => Yii::t(Yii::app()->language, 'productTypeID'),
									'productTypeName' => Yii::t(Yii::app()->language, 'productTypeName'),
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
                    'productTypeID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'rproduct-types-admin',
            'keyField' => 'productTypeID',
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