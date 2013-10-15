<?php

/**
 * This is the model class for table "w_posts".
 *
 * The followings are the available columns in table 'w_posts':
 * @property string $post_id
 * @property integer $post_user
 * @property integer $post_category
 * @property string $post_thumb
 * @property string $post_descripcion
 * @property string $post_title
 * @property string $post_body
 * @property integer $post_date
 * @property integer $post_update
 * @property string $post_tags
 * @property integer $post_comments
 * @property integer $post_shared
 * @property integer $post_favoritos
 * @property integer $post_cache
 * @property string $post_ip
 * @property integer $post_visitantes
 * @property integer $post_status
 * @property string $post_link
 * @property string $post_type
 */
class Post extends CActiveRecord
{
    //ejecutar esta opcion en la tabla para poder obtener post relacionados
    //ALTER TABLE w_posts ADD FULLTEXT (post_title, post_body)

    public $_oldTags;
    public $score;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return 'w_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_user, post_category, post_title, post_body, post_date, post_tags, post_comments, post_shared, post_favoritos, post_cache, post_ip', 'required'),
			array('post_user, post_category, post_date, post_update, post_comments, post_shared, post_favoritos, post_cache, post_visitantes, post_status', 'numerical', 'integerOnly'=>true),
			array('post_thumb, post_link', 'length', 'max'=>250),
			array('post_descripcion', 'length', 'max'=>300),
			array('post_title', 'length', 'max'=>60),
			array('post_tags', 'length', 'max'=>128),
			array('post_ip', 'length', 'max'=>15),
			array('post_type', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, post_user, post_category, post_thumb, post_descripcion, post_title, post_body, post_date, post_update, post_tags, post_comments, post_shared, post_favoritos, post_cache, post_ip, post_visitantes, post_status, post_link, post_type', 'safe', 'on'=>'search'),
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
                    'categoria' => array(self::BELONGS_TO, 'Categorias', 'post_category'),
                    'usuario' => array(self::BELONGS_TO, 'Usuario', 'post_user'),
                    'comentariohilo' => array(self::BELONGS_TO, 'ComentarioHilo', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_id' => 'Post',
			'post_user' => 'Post User',
			'post_category' => 'Categoria',
			'post_thumb' => 'Post Thumb',
			'post_descripcion' => 'Descripcion',
			'post_title' => 'Titulo',
			'post_body' => 'Contenido del Post',
			'post_date' => 'Post Date',
			'post_update' => 'Post Update',
			'post_tags' => 'Palabras Claves',
			'post_comments' => 'Post Comments',
			'post_shared' => 'Post Shared',
			'post_favoritos' => 'Post Favoritos',
			'post_cache' => 'Post Cache',
			'post_ip' => 'Post Ip',
			'post_visitantes' => 'Post Visitantes',
			'post_status' => 'Post Status',
			'post_link' => 'Post Link',
			'post_type' => 'Post Type',
		);
	}
        
        public function behaviors() {
            return array(
                'PostBehavior' => array(
                    'class' => 'application.components.behavior.PostBehavior',
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

		$criteria->compare('post_id',$this->post_id,true);
		$criteria->compare('post_user',$this->post_user);
		$criteria->compare('post_category',$this->post_category);
		$criteria->compare('post_thumb',$this->post_thumb,true);
		$criteria->compare('post_descripcion',$this->post_descripcion,true);
		$criteria->compare('post_title',$this->post_title,true);
		$criteria->compare('post_body',$this->post_body,true);
		$criteria->compare('post_date',$this->post_date);
		$criteria->compare('post_update',$this->post_update);
		$criteria->compare('post_tags',$this->post_tags,true);
		$criteria->compare('post_comments',$this->post_comments);
		$criteria->compare('post_shared',$this->post_shared);
		$criteria->compare('post_favoritos',$this->post_favoritos);
		$criteria->compare('post_cache',$this->post_cache);
		$criteria->compare('post_ip',$this->post_ip,true);
		$criteria->compare('post_visitantes',$this->post_visitantes);
		$criteria->compare('post_status',$this->post_status);
		$criteria->compare('post_link',$this->post_link,true);
		$criteria->compare('post_type',$this->post_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function normalizeTags()
	{
		$this->post_tags=Etiquetas::array2string(array_unique(Etiquetas::string2array($this->post_tags)));
	}
        
        public function getTags()
        {
            return array_unique(Etiquetas::string2array($this->post_tags));
        }       
        
        public function getPostRelacionados()
        {
            $criteria = new CDbCriteria();
            $criteria->select = array("post_thumb","post_descripcion","post_title","post_body","MATCH(post_title,post_body) AGAINST('".$this->post_title."') AS score");
            $criteria->condition = "MATCH(post_title,post_body) AGAINST('".$this->post_title."') and post_id != ".$this->post_id;
            $criteria->order = "score";
            $criteria->limit= 5;
            return $this->findAll($criteria);
        }
        public function getUser()
        {
            $criteria = new CDbCriteria();
            $criteria->select = array("idusuario","username","avatar","descripcion");
            return Usuario::model()->findByPk($this->post_user, $criteria);
        }
}