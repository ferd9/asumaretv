<?php

/**
 * This is the model class for table "meme_flag".
 *
 * The followings are the available columns in table 'meme_flag':
 * @property string $meme_flag_id
 * @property string $meme_fk
 * @property string $user_fk
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Meme $memeFk
 * @property User $userFk
 */
class MemeFlag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemeFlag the static model class
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
		return 'meme_flag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meme_fk, user_fk, created_at', 'required'),
			array('meme_fk, user_fk', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('meme_flag_id, meme_fk, user_fk, created_at', 'safe', 'on'=>'search'),
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
			'meme' => array(self::BELONGS_TO, 'Meme', 'meme_fk'),
			'user' => array(self::BELONGS_TO, 'Usuario', 'user_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'meme_flag_id' => 'Meme Flag',
			'meme_fk' => 'Meme Fk',
			'user_fk' => 'User Fk',
			'created_at' => 'Created At',
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

		$criteria->compare('meme_flag_id',$this->meme_flag_id,true);
		$criteria->compare('meme_fk',$this->meme_fk,true);
		$criteria->compare('user_fk',$this->user_fk,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}