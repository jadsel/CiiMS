<?php

/**
 * This is the model class for table "content_metadata".
 *
 * The followings are the available columns in table 'content_metadata':
 * @property integer $id
 * @property integer $content_id
 * @property string $key
 * @property string $value
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Content $content
 */
class ContentMetadata extends CiiModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContentMetadata the static model class
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
		return 'content_metadata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_id, key, value', 'required'),
			array('content_id', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>50),
			// The following rule is used by search().
			array('id, content_id, key, value, created, updated', 'safe', 'on'=>'search'),
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
			'content' => array(self::BELONGS_TO, 'Content', 'content_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'content_id' => Yii::t('ciims.models.ContentMetadata', 'Content ID'),
			'key' 		 => Yii::t('ciims.models.ContentMetadata', 'Key'),
			'value' 	 => Yii::t('ciims.models.ContentMetadata', 'Value'),
			'created'	 => Yii::t('ciims.models.ContentMetadata', 'Created'),
			'updated' 	 => Yii::t('ciims.models.ContentMetadata', 'Updated')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('t.key',$this->key,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
