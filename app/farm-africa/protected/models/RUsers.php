<?php

/**
 * Description of RUsers
 *
 * @author muya
 */
class RUsers extends EActiveResource {
    /* The id that uniquely identifies a person. This attribute is not defined
     * as a property      
     * because we don't want to send it back to the service like a name, surname or    
     * gender etc.
     */

    public $id;
    public $primaryKey;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Defines the resource property of this class
     */
    public function rest() {
        return CMap::mergeArray(
                        parent::rest(), array(
                    'resource' => 'users',
                    'idProperty' => 'id',
                        )
        );
    }

    //let's define some properties and their data types
    public function properties() {
        return array(
            'userID' => array('type' => 'integer'),
            'userName' => array('type' => 'string'),
            'firstName' => array('type' => 'string'),
            'lastName' => array('type' => 'string'),
            'emailAddress' => array('type' => 'string'),
            'phoneNumber' => array('type' => 'string'),
            'status' => array('type' => 'integer'),
            'dateCreated' => array('type' => 'datetime'),
            'createdBy' => array('type' => 'integer'),
            'dateModified' => array('type' => 'timestamp'),
            'modifiedBy' => array('type' => 'integer'),
        );
    }

    /* Define the rules */

    public function rules() {
        return array(
            array('userName, firstName, lastName, status, dateCreated, createdBy, dateModified, modifiedBy', 'required'),
            array('userName', 'length', 'max' => 30),
            array('firstName, lastName', 'length', 'max' => 45),
            array('emailAddress', 'length', 'max' => 100),
            array('phoneNumber', 'length', 'max' => 15),
            array('status, createdBy, modifiedBy', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('userID, userName, firstName, lastName, emailAddress, phoneNumber, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'userID' => 'User',
            'userName' => 'User Name',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'emailAddress' => 'Email Address',
            'phoneNumber' => 'Phone Number',
            'status' => 'Status',
            'dateCreated' => 'Date Created',
            'createdBy' => 'Created By',
            'dateModified' => 'Date Modified',
            'modifiedBy' => 'Modified By',
        );
    }
    
    /**
     * this function defines the CArrayDataProvider attributes that will be used
     * when loading the admin view
     * @return type
     */
    public function dataProviderAttributes(){
        //refer to Yii's CArrayDataProvider documentation
        //modify to taste
        return array(
            'caseSensitiveSort' => true,
            'sort'=>array(
                'attributes'=>array(
                     'userID',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            //un-comment to use these fields
            /*
            'id' => '',
            'keyField' => '',
            'data' => array(),
            'itemCount'=> integer,
            'rawData' => array(),
            'totalItemCount' => integer
             */
        );
    }

}

?>
