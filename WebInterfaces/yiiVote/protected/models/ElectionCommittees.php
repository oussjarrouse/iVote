<?php

/**
 * This is the model class for table "ElectionCommittees".
 *
 * The followings are the available columns in table 'ElectionCommittees':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $users_id
 *
 * The followings are the available model relations:
 * @property Users[] $users
 * @property Elections[] $elections
 */
class ElectionCommittees extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ElectionCommittees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, users_id', 'required'),
			array('status, users_id', 'numerical', 'integerOnly'=>true),
			//Status can take two values only: Inactive = 0 or Active = 1  
			array('status', 'in', 'range'=>range(0, 1)),
			array('name', 'length', 'max'=>256),
			array('description', 'length', 'max'=>2048),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, status, users_id', 'safe', 'on'=>'search'),
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
			'users' => array(self::MANY_MANY, 'Users', 'ElectionCommittees_has_users(ElectionCommittees_id, users_id)'),
			'elections' => array(self::HAS_MANY, 'Elections', 'ElectionCommittees_id'),
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
			'status' => 'Status',
			'users_id' => 'Users',
		);
	}
	
	protected function beforeSave()
	{
		if($this->isNewRecord())
		{
			$this->status = 1;// (active)
			$this->users_id = Yii::app()->user->id;
		}
		return parent::befbeforeSave();
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
		$criteria->compare('status',$this->status);
		$criteria->compare('users_id',$this->users_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ElectionCommittees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
