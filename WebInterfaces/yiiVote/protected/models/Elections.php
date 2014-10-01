<?php

/**
 * This is the model class for table "Elections".
 *
 * The followings are the available columns in table 'Elections':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $start
 * @property string $end
 * @property integer $ElectionCommittees_id
 *
 * The followings are the available model relations:
 * @property ElectionCommittees $electionCommittees
 * @property ElectionsSub[] $electionsSubs
 * @property Users[] $users
 */
class Elections extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Elections';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start, end, ElectionCommittees_id', 'required'),
			array('ElectionCommittees_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('description', 'length', 'max'=>2048),
			//Check if the start and end are valid dates
			//Ullman p. 94
			//array('start','date', 'format'=>'yyyy-MM-dd-HH-mm',
			//array('end','date', 'format'=>'yyyy-MM-dd-HH-mm'),
			//Compare attribute
			//array('end','compare','compareAttribute'=>'start','operator'=>'>','on'=>'Insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, start, end, ElectionCommittees_id', 'safe', 'on'=>'search'),
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
			'electionCommittees' => array(self::BELONGS_TO, 'ElectionCommittees', 'ElectionCommittees_id'),
			'electionsSubs' => array(self::HAS_MANY, 'ElectionsSub', 'Elections_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'start' => 'Start',
			'end' => 'End',
			'ElectionCommittees_id' => 'Election Committees',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('ElectionCommittees_id',$this->ElectionCommittees_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Elections the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
