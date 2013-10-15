<?php

/**
 * This is the model class for table "w_etiquetas".
 *
 * The followings are the available columns in table 'w_etiquetas':
 * @property integer $idEtiquetas
 * @property string $nombre
 * @property integer $frecuencia
 * @property integer $fecha
 */
class Etiquetas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Etiquetas the static model class
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
		return 'w_etiquetas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('frecuencia, fecha', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEtiquetas, nombre, frecuencia, fecha', 'safe', 'on'=>'search'),
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
			'idEtiquetas' => 'Id Etiquetas',
			'nombre' => 'Nombre',
			'frecuencia' => 'Frecuencia',
			'fecha' => 'Fecha',
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

		$criteria->compare('idEtiquetas',$this->idEtiquetas);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('frecuencia',$this->frecuencia);
		$criteria->compare('fecha',$this->fecha);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}

	public static function array2string($tags)
	{
		return implode(', ',$tags);
	}
        
    public function addTags($tags)
    {
            $criteria=new CDbCriteria;
            $criteria->addInCondition('nombre',$tags);
            $this->updateCounters(array('frecuencia'=>1),$criteria);
            foreach($tags as $name)
            {
                    if(!$this->exists('nombre=:name',array(':name'=>$name)))
                    {
                            $tag=new Etiquetas();
                            $tag->nombre=$name;
                            $tag->frecuencia=1;
                            $tag->fecha=time();
                            $tag->save();
                    }
            }
    }
        
    public function updateFrequency($oldTags, $newTags)
    {
            $oldTags=self::string2array($oldTags);
            $newTags=self::string2array($newTags);
            $this->addTags(array_values(array_diff($newTags,$oldTags)));
            $this->removeTags(array_values(array_diff($oldTags,$newTags)));
    }
        
    public function removeTags($tags)
    {
            if(empty($tags))
                    return;
            $criteria=new CDbCriteria;
            $criteria->addInCondition('nombre',$tags);
            $this->updateCounters(array('frecuencia'=>-1),$criteria);
            $this->deleteAll('frecuencia<=0');
    }
        
        /**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestTags($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
			'condition'=>'nombre LIKE :keyword',
			'order'=>'frecuencia DESC, Nombre',
			'limit'=>$limit,
			'params'=>array(
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		$names=array();
		foreach($tags as $tag)
			$names[]=$tag->nombre;
		return $names;
	}
        
        /**
	 * Returns tag names and their corresponding weights.
	 * Only the tags with the top weights will be returned.
	 * @param integer the maximum number of tags that should be returned
	 * @return array weights indexed by tag names.
	 */
	public function findTagWeights($limit=20)
	{
		$models=$this->findAll(array(
			'order'=>'frecuencia DESC',
			'limit'=>$limit,
		));

		$total=0;
		foreach($models as $model)
			$total+=$model->frecuencia;

		$tags=array();
		if($total>0)
		{
			foreach($models as $model)
				$tags[$model->nombre]=8+(int)(16*$model->frecuencia/($total+10));
			ksort($tags);
		}
		return $tags;
	}
}