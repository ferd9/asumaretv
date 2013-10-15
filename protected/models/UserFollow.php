<?php

/**
 * This is the model class for table "user_follow".
 *
 * The followings are the available columns in table 'user_follow':
 * @property string $user_follow_id
 * @property string $user_fk
 * @property string $following_id
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property User $userFk
 * @property User $follower
 */
class UserFollow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFollow the static model class
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
		return 'user_follow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_fk, following_id', 'length', 'max'=>10),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_follow_id, user_fk, following_id, created_at', 'safe', 'on'=>'search'),
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
			'following' => array(self::BELONGS_TO, 'Usuario', 'following_id'),
			'follower' => array(self::BELONGS_TO, 'Usuario', 'user_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_follow_id' => 'User Follow',
			'user_fk' => 'User Fk',
			'following_id' => 'Follower',
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

		$criteria->compare('user_follow_id',$this->user_follow_id,true);
		$criteria->compare('user_fk',$this->user_fk,true);
		$criteria->compare('following_id',$this->following_id,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function scopes() {
            return array(
                'follower_visible' => array('condition' => 'follower.activo = 1'),
                'following_visible' => array('condition' => 'following.activo = 1'),
            );
        }
}