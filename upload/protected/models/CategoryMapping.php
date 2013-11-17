<?php

/**
 * This is the model class for table "category_mapping".
 *
 * The followings are the available columns in table 'category_mapping':
 * @property integer $id
 * @property integer $category_id
 * @property integer $site_id
 * @property string $site_category_id
 * @property string $site_url
 * @property string $name
 */
class CategoryMapping extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoryMapping the static model class
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
		return 'category_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id, site_category_id', 'required'),
			array('category_id, site_id', 'numerical', 'integerOnly'=>true),
			array('site_category_id, name', 'length', 'max'=>20),
			array('site_url', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, site_id, site_category_id, site_url, name', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'category_id' => '分类ID',
			'site_id' => '商城ID',
			'site_category_id' => '商城分类ID',
			'site_url' => '商城分类链接',
			'name' => '商城分类名称',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('site_id',$this->site_id);
		$criteria->compare('site_category_id',$this->site_category_id,true);
		$criteria->compare('site_url',$this->site_url,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
