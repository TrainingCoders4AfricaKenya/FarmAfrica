<?php

/**
 * This is the ActiveResource model class for table "products".
 *
 * The following are the available columns in table 'products':
 * @property string $productID
 * @property string $productName
 * @property string $description
 * @property string $productTypeID
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 */
class RProducts extends GenericActiveResource {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RRProducts the static model class
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
    			'resource' => 'products',
    			'idProperty' => 'productID',
    			'container' => 'products',
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
				'productID' => array('type' => 'string'),
				'productName' => array('type' => 'string'),
				'description' => array('type' => 'string'),
				'productTypeID' => array('type' => 'string'),
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
			array('productName, description, productTypeID, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
			array('productName', 'length', 'max'=>45),
			array('description', 'length', 'max'=>200),
			array('productTypeID, status, createdBy, modifiedBy', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('productID, productName, description, productTypeID, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			array(
									'productID' => Yii::t(Yii::app()->language, 'productID'),
									'productName' => Yii::t(Yii::app()->language, 'productName'),
									'description' => Yii::t(Yii::app()->language, 'description'),
									'productTypeID' => Yii::t(Yii::app()->language, 'productTypeID'),
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
                    'productID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'rproducts-admin',
            'keyField' => 'productID',
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