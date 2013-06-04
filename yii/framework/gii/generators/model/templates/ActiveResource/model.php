<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * modifed by <b>kingkonig@gmail.com</b> for use in FarmAfrica
 */
?>
<?php 
	//let's define some variables that we'll use throughout, override if necessary
	$modelClass = $this->generateActiveResourceClassName($tableName); //modified to append an 'R' to class name

?>
<?php echo "<?php\n"; ?>

/**
 * This is the ActiveResource model class for table "<?php echo $tableName; ?>".
 *
 * The following are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
 */
class <?php echo $modelClass; ?> extends GenericActiveResource <?php //echo $this->baseClass."\n"; ?>
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return <?php echo $modelClass; ?> the static model class
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
    			'resource' => '<?php echo lcfirst($tableName); ?>',
    			'idProperty' => '<?php echo $this->getSingular(lcfirst($tableName)).'ID'; ?>',
    			'container' => '<?php echo lcfirst($tableName); ?>',
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
			<?php
			$counter = 0;
			foreach($columns as $name=>$column)
			{
				if($counter == 0)
					$tabSpace = "\t";
				else
					$tabSpace = "\t\t\t\t";
				$counter++;
				if($column->type==='integer')
				{
					echo $tabSpace."'$name' => array('type' => 'integer'),\n";
					// echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
				}
				else {
					echo $tabSpace."'$name' => array('type' => 'string'),\n";
				}
			}
			?>
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
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			array(
				<?php foreach($labels as $name=>$label): ?>
					<?php echo "'$name' => Yii::t(Yii::app()->language, '$name'),\n"; ?>
				<?php endforeach; ?>
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
                    '<?php echo $this->getSingular(lcfirst($tableName)).'ID'; ?>',
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->params['DEFAULT_ADMIN_PAGE_SIZE'],
            ),
            'id' => '<?php echo $this->class2id($this->modelClass); ?>-admin',
            'keyField' => '<?php echo $this->getSingular(lcfirst($tableName)).'ID'; ?>',
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