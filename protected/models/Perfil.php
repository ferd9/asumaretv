<?php

/**
 * This is the model class for table "w_perfil".
 *
 * The followings are the available columns in table 'w_perfil':
 * @property string $w_perfil
 * @property string $idusuario
 * @property string $portada
 * @property string $hobbies
 * @property string $fav_musica
 * @property string $fav_peliculas
 * @property string $fav_artistas
 * @property string $fav_libros
 * @property string $colegio
 * @property string $instituto
 * @property string $universidad
 * @property string $trabajo
 * @property string $puesto
 * @property string $lema_personal
 * @property string $peor_enemigo
 * @property string $fav_webs
 * @property integer $idprivacidad
 */
class Perfil extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Perfil the static model class
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
		return 'w_perfil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idusuario', 'required'),
			array('idprivacidad', 'numerical', 'integerOnly'=>true),
			array('idusuario', 'length', 'max'=>20),
			array('colegio, instituto, universidad, trabajo, puesto', 'length', 'max'=>120),
			array('peor_enemigo', 'length', 'max'=>180),
			array('portada, hobbies, fav_musica, fav_peliculas, fav_artistas, fav_libros, lema_personal, fav_webs', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('w_perfil, idusuario, portada, hobbies, fav_musica, fav_peliculas, fav_artistas, fav_libros, colegio, instituto, universidad, trabajo, puesto, lema_personal, peor_enemigo, fav_webs, idprivacidad', 'safe', 'on'=>'search'),
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
			'w_perfil' => 'W Perfil',
			'idusuario' => 'Idusuario',
			'portada' => 'Portada',
			'hobbies' => 'Hobbies',
			'fav_musica' => 'Fav Musica',
			'fav_peliculas' => 'Fav Peliculas',
			'fav_artistas' => 'Fav Artistas',
			'fav_libros' => 'Fav Libros',
			'colegio' => 'Colegio',
			'instituto' => 'Instituto',
			'universidad' => 'Universidad',
			'trabajo' => 'Trabajo',
			'puesto' => 'Puesto',
			'lema_personal' => 'Lema Personal',
			'peor_enemigo' => 'Peor Enemigo',
			'fav_webs' => 'Fav Webs',
			'idprivacidad' => 'Idprivacidad',
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

		$criteria->compare('w_perfil',$this->w_perfil,true);
		$criteria->compare('idusuario',$this->idusuario,true);
		$criteria->compare('portada',$this->portada,true);
		$criteria->compare('hobbies',$this->hobbies,true);
		$criteria->compare('fav_musica',$this->fav_musica,true);
		$criteria->compare('fav_peliculas',$this->fav_peliculas,true);
		$criteria->compare('fav_artistas',$this->fav_artistas,true);
		$criteria->compare('fav_libros',$this->fav_libros,true);
		$criteria->compare('colegio',$this->colegio,true);
		$criteria->compare('instituto',$this->instituto,true);
		$criteria->compare('universidad',$this->universidad,true);
		$criteria->compare('trabajo',$this->trabajo,true);
		$criteria->compare('puesto',$this->puesto,true);
		$criteria->compare('lema_personal',$this->lema_personal,true);
		$criteria->compare('peor_enemigo',$this->peor_enemigo,true);
		$criteria->compare('fav_webs',$this->fav_webs,true);
		$criteria->compare('idprivacidad',$this->idprivacidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}