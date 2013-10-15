<?php

/**
 * This is the model class for table "w_imagen".
 *
 * The followings are the available columns in table 'w_imagen':
 * @property string $idImagen
 * @property string $nombre
 * @property string $idusuario
 * @property string $nombre_original
 * @property string $descripcion
 * @property string $extension
 * @property string $url
 * @property string $tipo
 * @property integer $alto
 * @property integer $ancho
 * @property string $thumbnail
 * @property integer $idcategoria
 * @property string $etiquetas
 * @property integer $fecha
 * @property integer $eliminado
 * @property integer $featured
 */
class Imagen extends CActiveRecord
{
    public $_oldTags;
    public $imagen;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Imagen the static model class
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
		return 'w_imagen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, idusuario, nombre_original, extension, url, tipo, alto, ancho, thumbnail, idcategoria, etiquetas, fecha', 'required'),
			array('alto, ancho, idcategoria, fecha, eliminado, featured', 'numerical', 'integerOnly'=>true),
			array('nombre, nombre_original', 'length', 'max'=>180),
			array('idusuario, extension', 'length', 'max'=>20),
			array('url, thumbnail, etiquetas', 'length', 'max'=>250),
			array('tipo', 'length', 'max'=>6),
                        array('descripcion','length','max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idImagen, nombre, idusuario, nombre_original, extension, url, tipo, alto, ancho, thumbnail, idcategoria, etiquetas, fecha, eliminado', 'safe', 'on'=>'search'),
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
			'idImagen' => 'Id Imagen',
			'nombre' => 'Nombre',
			'idusuario' => 'Idusuario',
			'nombre_original' => 'Nombre Original',
                        'descripcion'=>'Descripcion',
			'extension' => 'Extension',
			'url' => 'Url',
			'tipo' => 'Tipo',
			'alto' => 'Alto',
			'ancho' => 'Ancho',
			'thumbnail' => 'Thumbnail',
			'idcategoria' => 'Selecciona Una categoria',
			'etiquetas' => 'Etiquetas',
			'fecha' => 'Fecha',
			'eliminado' => 'Eliminado',
                        'featured'=>'Destacado'
		);
	}
        
         public function behaviors() {
            return array(
                'ImageBehavior' => array(
                    'class' => 'application.components.behavior.ImageBehavior',
                  ),
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

		$criteria->compare('idImagen',$this->idImagen,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('idusuario',$this->idusuario,true);
		$criteria->compare('nombre_original',$this->nombre_original,true);
		$criteria->compare('extension',$this->extension,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('alto',$this->alto);
		$criteria->compare('ancho',$this->ancho);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		$criteria->compare('idcategoria',$this->idcategoria);
		$criteria->compare('etiquetas',$this->etiquetas,true);
		$criteria->compare('fecha',$this->fecha);
		$criteria->compare('eliminado',$this->eliminado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function normalizeTags()
	{
		$this->etiquetas=Etiquetas::array2string(array_unique(Etiquetas::string2array($this->etiquetas)));
	}
        
        public function getTags()
        {
            return array_unique(Etiquetas::string2array($this->etiquetas));
        } 
        
         public function getPostRelacionados()
        {
            $criteria = new CDbCriteria();
            $criteria->select = array("idImagen","nombre","thumbnail","descripcion","etiquetas","MATCH(descripcion,etiquetas) AGAINST('".$this->etiquetas."') AS score");
            $criteria->condition = "MATCH(descripcion,etiquetas) AGAINST('".$this->etiquetas."') and idImagen != ".$this->idImagen;
            $criteria->order = "score";
            $criteria->limit= 5;
            return $this->findAll($criteria);
        }
        
        public function getByTags($tag)
        {
            $criteria = new CDbCriteria();
            $criteria->select = array("idImagen","url","nombre","thumbnail","descripcion","etiquetas","MATCH(etiquetas) AGAINST('".$tag."') AS score");
            $criteria->condition = "MATCH(etiquetas) AGAINST('".$tag."')";
            $criteria->order = "score";
            //$criteria->limit= 5;
            return $criteria;
        }
}