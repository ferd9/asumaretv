<?php

/**
 * This is the model class for table "w_comentario_hilo".
 *
 * The followings are the available columns in table 'w_comentario_hilo':
 * @property integer $w_idthreads
 * @property string $nombre_thread
 * @property integer $f_creacion
 */
class ComentarioHilo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ComentarioHilo the static model class
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
		return 'w_comentario_hilo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_thread', 'required'),
			array('f_creacion', 'numerical', 'integerOnly'=>true),
			array('nombre_thread', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('w_idthreads, nombre_thread, f_creacion', 'safe', 'on'=>'search'),
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
			'w_idthreads' => 'W Idthreads',
			'nombre_thread' => 'Nombre Thread',
			'f_creacion' => 'F Creacion',
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

		$criteria->compare('w_idthreads',$this->w_idthreads);
		$criteria->compare('nombre_thread',$this->nombre_thread,true);
		$criteria->compare('f_creacion',$this->f_creacion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}