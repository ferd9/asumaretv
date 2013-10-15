<?php

/**
 * This is the model class for table "meme_like".
 *
 * The followings are the available columns in table 'meme_like':
 * @property string $meme_like_id
 * @property string $meme_fk
 * @property string $user_fk
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Meme $memeFk
 * @property User $userFk
 */
class MemeLike extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemeLike the static model class
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
		return 'meme_like';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meme_fk, user_fk', 'length', 'max'=>10),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('meme_like_id, meme_fk, user_fk, created_at', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'meme_like_id' => Yii::t('yii', 'Meme Like'),
			'meme_fk' => Yii::t('yii', 'Meme'),
			'user_fk' => Yii::t('yii', 'User'),
			'created_at' => Yii::t('yii', 'Created At'),
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

		$criteria->compare('meme_like_id',$this->meme_like_id,true);
		$criteria->compare('meme_fk',$this->meme_fk,true);
		$criteria->compare('user_fk',$this->user_fk,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function scopes() {
            return array(
                'visible' => array('condition' => 'meme.is_active = 1 and meme.is_published = 1'),
                'weekly' => array('condition' => 't.created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)'),
            );
        }
}