<?php

/**
 * This is the model class for table "w_comentarios".
 *
 * The followings are the available columns in table 'w_comentarios':
 * @property integer $cid
 * @property string $comentario_thread_id
 * @property integer $padre_comentario_id
 * @property integer $c_user
 * @property integer $c_date
 * @property string $c_body
 * @property integer $c_votos
 * @property string $c_status
 * @property string $c_ip
 */
class Comentarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comentarios the static model class
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
		return 'w_comentarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comentario_thread_id, c_user, c_date, c_body, c_ip', 'required'),
			array('padre_comentario_id, c_user, c_date, c_votos', 'numerical', 'integerOnly'=>true),
			array('c_status', 'length', 'max'=>1),
                        array('comentario_thread_id', 'length', 'max'=>60),
                        array('c_body', 'length', 'max'=>300),
                        array('c_body', 'length', 'min'=>2),
			array('c_ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cid, comentario_thread_id, padre_comentario_id, c_user, c_date, c_body, c_votos, c_status, c_ip', 'safe', 'on'=>'search'),
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
                    'hilo' => array(self::BELONGS_TO, 'ComentarioHilo', 'comentario_thread_id'),
                    'usuario' => array(self::BELONGS_TO, 'Usuario', 'c_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cid' => 'Cid',
			'comentario_thread_id' => 'Comentario Thread',
			'padre_comentario_id' => 'Padre Comentario',
			'c_user' => 'usuario',
			'c_date' => 'Fechae',
			'c_body' => 'Comentario',
			'c_votos' => 'Votos',
			'c_status' => 'Estado',
			'c_ip' => 'IP',
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
		$criteria->compare('comentario_thread_id',$this->comentario_thread_id,true);
		$criteria->compare('padre_comentario_id',$this->padre_comentario_id);
		$criteria->compare('c_user',$this->c_user);
		$criteria->compare('c_date',$this->c_date);
		$criteria->compare('c_body',$this->c_body,true);
		$criteria->compare('c_votos',$this->c_votos);
		$criteria->compare('c_status',$this->c_status,true);
		$criteria->compare('c_ip',$this->c_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate() {            
            if($this->isNewRecord)
            {
                $this->c_user = Yii::app()->user->getState("pk");
                $this->c_date = time();
                $this->c_votos = 0;
                $this->c_status = 1;
                $this->c_ip = Yii::app()->request->getUserHostAddress();
            }           
            return parent::beforeValidate();
        }
        
        public function getUser()
        {
            return Usuario::model()->findByPk($this->c_user);
        }
        
//        public function beforeSave() {
//            $this->c_body = Util::removeEmptyParrafo($this->c_body);
//            parent::beforeSave();
//        }
        
        public function afterSave() {
            $this->updateComentsPost();
            parent::afterSave();
        }
        
        private function updateComentsPost()
        {
            $ch = ComentarioHilo::model()->find("nombre_thread=:name",array(
                ':name'=>$this->comentario_thread_id
            ));
            
            if(!is_null($ch))
            {
               $criteria = new CDbCriteria;
                //$criteria->select = 'post_comments'; // select fields which you want in output
                $criteria->condition='post_id=:post_id';
                $criteria->params=array(':post_id'=>$ch->w_idthreads);
                $post = Post::model()->find($criteria);                                
                if(!is_null($post))
                {
                   $post->post_comments +=1;
                   
                   if(!$post->save(true,array('post_comments')))
                   {                       
                       throw new CHttpException(500,"Error: no se pudo actualizar contador de comentarios ".$post->post_comments); 
                   }
                  
                }else
                {
                    throw new CHttpException(500,"Error: Intento de comentar un post no existente ".$ch->w_idthreads); 
                }  
            }else
            {
                throw new CHttpException(500,"Error: Intento de comentar un post no existente ".$ch->w_idthreads); 
            }
           
            
        }
}