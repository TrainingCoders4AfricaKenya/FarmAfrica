<?php

/**
 * This is the model class for table "inboundMessages".
 *
 * The followings are the available columns in table 'inboundMessages':
 * @property string $inboundMessageID
 * @property string $sourceAddress
 * @property string $messageContent
 * @property string $externalTransactionID
 * @property string $status
 * @property string $dateCreated
 * @property string $dateModified
 */
class InboundMessages extends GenericAR
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InboundMessages the static model class
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
		return 'inboundMessages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dateCreated, dateModified', 'required'),
			array('sourceAddress', 'length', 'max'=>15),
			array('externalTransactionID', 'length', 'max'=>250),
			array('status', 'length', 'max'=>11),
			array('messageContent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('inboundMessageID, sourceAddress, messageContent, externalTransactionID, status, dateCreated, dateModified', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'inboundMessageID' => 'Inbound Message',
			'sourceAddress' => 'Source Address',
			'messageContent' => 'Message Content',
			'externalTransactionID' => 'External Transaction',
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

		$criteria->compare('inboundMessageID',$this->inboundMessageID,true);
		$criteria->compare('sourceAddress',$this->sourceAddress,true);
		$criteria->compare('messageContent',$this->messageContent,true);
		$criteria->compare('externalTransactionID',$this->externalTransactionID,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateModified',$this->dateModified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}