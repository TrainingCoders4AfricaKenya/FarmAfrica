<?php

/**
 * Description of RUsers
 *
 * @author muya
 */
class RUsers extends GenericActiveResource {

    /**
     * Returns the static model of the specified AR class.
     * @param type $className
     * @return type
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
                    'resource' => 'users',
                    'idProperty' => 'userID',
                    'container' => 'users',
                    'multiContainer' => 'DATA',
                        )
        );
    }

    //let's define some properties and their data types
    public function properties() {
        return CMap::mergeArray(parent::properties(), array(
                    'userID' => array('type' => 'integer'),
                    'userName' => array('type' => 'string'),
                    'firstName' => array('type' => 'string'),
                    'lastName' => array('type' => 'string'),
                    'emailAddress' => array('type' => 'string'),
                    'phoneNumber' => array('type' => 'string'),
        ));
    }

    /* Define the rules */

    public function rules() {
        return array(
           array('userName, firstName, lastName', 'required'),
            array('userName', 'length', 'max' => 30),
            array('firstName, lastName', 'length', 'max' => 45),
            array('emailAddress', 'length', 'max' => 100),
            array('phoneNumber', 'length', 'max' => 15),
//            array('status, createdBy, modifiedBy', 'length', 'max' => 11),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('userID, userName, firstName, lastName, emailAddress, phoneNumber, status, dateCreated, createdBy, dateModified, modifiedBy', 'safe', 'on' => 'search'),
        );
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return CMap::mergeArray(array(
                    'userID' => Yii::t(Yii::app()->language, 'userID'),
                    'userName' => Yii::t(Yii::app()->language, 'userName'),
                    'firstName' => Yii::t(Yii::app()->language, 'firstName'),
                    'lastName' => Yii::t(Yii::app()->language, 'lastName'),
                    'emailAddress' => Yii::t(Yii::app()->language, 'email'),
                    'phoneNumber' => Yii::t(Yii::app()->language, 'phoneNumber'),
                        ), parent::attributeLabels());
    }

    /**
     * this function defines the CArrayDataProvider attributes that will be used
     * when loading the admin view
     * @return type
     */
    public function dataProviderAttributes() {
        //refer to Yii's CArrayDataProvider documentation
        //modify to taste
        return array(
            'caseSensitiveSort' => true,
            'sort' => array(
                'attributes' => array(
                    'userID',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => 'users-admin',
            'keyField' => 'userID',
                //un-comment to use these fields
                /*
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
