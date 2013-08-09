<?php

/**
 * This is the ActiveResource model class for table "inboundMessages".
 *
 * The following are the available columns in table 'inboundMessages':
 * @property string $inboundMessageID
 * @property string $sourceAddress
 * @property string $messageContent
 * @property string $externalTransactionID
 * @property string $status
 * @property string $dateCreated
 * @property string $dateModified
 */
class RInboundMessages extends GenericActiveResource {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RRInboundMessages the static model class
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
    			'resource' => 'inboundMessages',
    			'idProperty' => 'inboundMessageID',
    			'container' => 'inboundMessages',
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
				'inboundMessageID' => array('type' => 'string'),
				'sourceAddress' => array('type' => 'string'),
				'messageContent' => array('type' => 'string'),
				'externalTransactionID' => array('type' => 'string'),
				'status' => array('type' => 'string'),
				'dateCreated' => array('type' => 'string'),
				'dateModified' => array('type' => 'string'),
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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'inboundMessages';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			array(
									'inboundMessageID' => Yii::t(Yii::app()->language, 'inboundMessageID'),
									'sourceAddress' => Yii::t(Yii::app()->language, 'sourceAddress'),
									'messageContent' => Yii::t(Yii::app()->language, 'messageContent'),
									'externalTransactionID' => Yii::t(Yii::app()->language, 'externalTransactionID'),
									'status' => Yii::t(Yii::app()->language, 'status'),
									'dateCreated' => Yii::t(Yii::app()->language, 'dateCreated'),
									'dateModified' => Yii::t(Yii::app()->language, 'dateModified'),
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
                    'inboundMessageID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'rinbound-messages-admin',
            'keyField' => 'inboundMessageID',
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