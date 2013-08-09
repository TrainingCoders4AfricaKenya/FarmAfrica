<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property string $productID
 * @property string $productName
 * @property string $description
 * @property string $productTypeID
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 *
 * The followings are the available model relations:
 * @property ProductTypes $productType
 * @property Transactions[] $transactions
 */
class Products extends GenericAR
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'productType' => array(self::BELONGS_TO, 'ProductTypes', 'productTypeID'),
			'transactions' => array(self::HAS_MANY, 'Transactions', 'productID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'productID' => 'Product',
			'productName' => 'Product Name',
			'description' => 'Description',
			'productTypeID' => 'Product Type',
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
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('productID',$this->productID,true);
		$criteria->compare('productName',$this->productName,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('productTypeID',$this->productTypeID,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('createdBy',$this->createdBy,true);
		$criteria->compare('dateModified',$this->dateModified,true);
		$criteria->compare('modifiedBy',$this->modifiedBy,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}