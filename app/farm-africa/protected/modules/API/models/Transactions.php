<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property string $transactionID
 * @property string $serviceID
 * @property string $productID
 * @property string $initiatorID
 * @property string $initiatorMSISDN
 * @property string $receiverID
 * @property string $status
 * @property string $dateCreated
 * @property string $dateModified
 *
 * The followings are the available model relations:
 * @property Services $service
 * @property Users $initiator
 * @property Users $receiver
 * @property Products $product
 */
class Transactions extends GenericAR
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Transactions the static model class
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
		return 'transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, dateCreated, dateModified', 'required'),
			array('serviceID, productID, initiatorID, receiverID, status', 'length', 'max'=>11),
			array('initiatorMSISDN', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('transactionID, serviceID, productID, initiatorID, initiatorMSISDN, receiverID, status, dateCreated, dateModified', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'Services', 'serviceID'),
			'initiator' => array(self::BELONGS_TO, 'Users', 'initiatorID'),
			'receiver' => array(self::BELONGS_TO, 'Users', 'receiverID'),
			'product' => array(self::BELONGS_TO, 'Products', 'productID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'transactionID' => 'Transaction',
			'serviceID' => 'Service',
			'productID' => 'Product',
			'initiatorID' => 'Initiator',
			'initiatorMSISDN' => 'Initiator Msisdn',
			'receiverID' => 'Receiver',
			'status' => 'Status',
			'dateCreated' => 'Date Created',
			'dateModified' => 'Date Modified',
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

		$criteria->compare('transactionID',$this->transactionID,true);
		$criteria->compare('serviceID',$this->serviceID,true);
		$criteria->compare('productID',$this->productID,true);
		$criteria->compare('initiatorID',$this->initiatorID,true);
		$criteria->compare('initiatorMSISDN',$this->initiatorMSISDN,true);
		$criteria->compare('receiverID',$this->receiverID,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateModified',$this->dateModified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}