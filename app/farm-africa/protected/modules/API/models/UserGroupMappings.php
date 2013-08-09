<?php

/**
 * This is the model class for table "userGroupMappings".
 *
 * The followings are the available columns in table 'userGroupMappings':
 * @property string $userGroupMappingID
 * @property string $userID
 * @property string $groupID
 * @property string $status
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $modifiedBy
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Groups $group
 */
class UserGroupMappings extends GenericAR
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserGroupMappings the static model class
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
		return 'userGroupMappings';
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'userID'),
			'group' => array(self::BELONGS_TO, 'Groups', 'groupID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userGroupMappingID' => 'User Group Mapping',
			'userID' => 'User',
			'groupID' => 'Group',
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

		$criteria->compare('userGroupMappingID',$this->userGroupMappingID,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('groupID',$this->groupID,true);
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