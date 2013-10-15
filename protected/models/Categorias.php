<?php

/**
 * This is the model class for table "w_categorias".
 *
 * The followings are the available columns in table 'w_categorias':
 * @property integer $cid
 * @property integer $c_orden
 * @property string $c_nombre
 * @property string $c_seo
 * @property string $c_img
 */
class Categorias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categorias the static model class
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
		return 'w_categorias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_orden, c_nombre, c_seo', 'required'),
			array('c_orden', 'numerical', 'integerOnly'=>true),
			array('c_nombre, c_seo, c_img', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cid, c_orden, c_nombre, c_seo, c_img', 'safe', 'on'=>'search'),
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
			'cid' => 'Cid',
			'c_orden' => 'C Orden',
			'c_nombre' => 'C Nombre',
			'c_seo' => 'C Seo',
			'c_img' => 'C Img',
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

		$criteria->compare('cid',$this->cid);
		$criteria->compare('c_orden',$this->c_orden);
		$criteria->compare('c_nombre',$this->c_nombre,true);
		$criteria->compare('c_seo',$this->c_seo,true);
		$criteria->compare('c_img',$this->c_img,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getIdAndName()
        {
            $lista = array();
            $criteria = new CDbCriteria;
            $criteria->select = 't.cid, c_nombre'; // select fields which you want in output
            //$criteria->condition = 't.status = 1';

            $data = $this->findAll($criteria);
            foreach ($data as $mdl=>$val) {
                $lista[$val->cid] = $val->c_nombre;
            }
            return $lista;
            
        }
}