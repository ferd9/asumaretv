<?php

/**
 * This is the model class for table "w_usuario".
 *
 * The followings are the available columns in table 'w_usuario':
 * @property string $idusuario
 * @property string $username
 * @property string $sessionid
 * @property string $token_id
 * @property integer $time_token
 * @property string $avatar
 * @property string $nombre
 * @property string $apellido_p
 * @property string $apellido_m
 * @property string $email
 * @property string $passwd
 * @property string $salt
 * @property string $sexo
 * @property string $descripcion
 * @property string $hobbies
 * @property integer $nivel
 * @property integer $strikes
 * @property integer $confirmado
 * @property string $word_comfirm
 * @property string $dir_files
 * @property integer $last_login
 * @property integer $fec_login
 * @property integer $fechareg
 * @property integer $activo
 * @property integer $$dia
 * @property integer $mes
 * @property integer $anio
 * @property integer $is_admin
 */
class Usuario extends CActiveRecord
{
	public $verficarEmail;
        public $foto;
	public $badUserNames = array("user","pass","stack","name","html",
								"asumaretv","elaprendiz","about","aboutus",
								"admin","administer","administor","administrater",
								"administrator","anonymous","auther","author","blogger",
								"contact","contactus","contributer","contributor","cpanel",
								"delete","directer","director","editer","editor","email",
								"emailus","guest","info","loggedin","loggedout","login",
								"logout","moderater","moderator","mysql","nobody","operater",
								"operator","oracle","owner","postmaster","president","registar",
								"register","registrar","root","signout","test","user","vicepresident",
								"webmaster","moderador","administrador","correo","autor","anonimo",
								"contacto","ingresar","sql","php","javascript"
								);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuario the static model class
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
		return 'w_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, nombre, email, passwd, salt, fechareg, ,dia,mes,anio', 'required','message'=>'{attribute} no puede ser vacio.'),
			array('is_admin, nivel, strikes, confirmado, last_login, fec_login, fechareg, activo,dia,mes,anio', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>35,'message'=>'Tu {attribute} de tener máximo {max} letras.'),
			array('username', 'length', 'min'=>3, 'tooShort'=>'Tu {attribute} de tener al menos {min} letras.'),
			array('passwd', 'length', 'min'=>6, 'tooShort'=>'Tu {attribute} de tener al menos {min} letras.'),
			array('sessionid', 'length', 'max'=>80),
			array('avatar', 'length', 'max'=>250),
			array('nombre', 'length', 'max'=>30),
			array('nombre', 'length', 'min'=>3,'tooShort'=>'Tu {attribute} de tener al menos {min} letras.'),
			array('apellido_p, apellido_m, dir_files', 'length', 'max'=>120),
			array('email, passwd, salt', 'length', 'max'=>45),
			array('sexo', 'length', 'max'=>1),
			array('sexo', 'required', 'message'=>'Por Favor especifique su genero.'),
			array('word_comfirm', 'length', 'max'=>160),
			array('descripcion, hobbies,dia,mes,anio', 'safe'),
			array('email, username', 'unique'),
			array('email', 'email'),
			array('verficarEmail', 'compare','compareAttribute'=>'email','on'=>'insert'),
			array('username', 'match','pattern'=>"#^[a-z][\da-z_]{3,35}[a-z\d]\$#i",'message'=>'El {attribute} solo debe contener letras, numeros y guion bajo.'),
			array('username', 'match','pattern'=>"/\b(" . implode($this->badUserNames,"|") . ")\b/i",'not'=>true,'message'=>'Este {attribute} ya ha sido usado.'),
			array('nombre', 'match','pattern'=>"/^[a-zA-Z]+(\s[a-zA-Z]+){0,4}$/",'message'=>'El {attribute} no es valido.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idusuario, username, sessionid, avatar, nombre, apellido_p, apellido_m, email, passwd, salt, sexo, descripcion, hobbies, nivel, strikes, confirmado, word_comfirm, dir_files, last_login, fec_login, fechareg, activo', 'safe', 'on'=>'search'),
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
                    'memes' => array(self::HAS_MANY, 'Meme', 'user_fk'),
                    'likes' => array(self::HAS_MANY, 'MemeLike', 'user_fk'),
                    'followers' => array(self::HAS_MANY, 'UserFollow', 'following_id'),
                    'followings' => array(self::HAS_MANY, 'UserFollow', 'user_fk'),
                    'flags' => array(self::HAS_MANY, 'MemeFlag', 'user_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idusuario' => 'Idusuario',
			'username' => 'Nombre de Usuario',
			'sessionid' => 'Sessionid',
			'avatar' => 'Avatar',
			'nombre' => 'Nombre',
			'apellido_p' => 'Apellido P',
			'apellido_m' => 'Apellido M',
			'email' => 'Email',
			'passwd' => 'Contraseña',
			'salt' => 'Salt',
			'sexo' => '¿Eres?',
			'descripcion' => 'Descripcion',
			'hobbies' => 'Hobbies',
			'nivel' => 'Nivel',
			'strikes' => 'Strikes',
			'confirmado' => 'Confirmado',
			'word_comfirm' => 'Word Comfirm',
			'dir_files' => 'Dir Files',
			'last_login' => 'Last Login',
			'fec_login' => 'Fec Login',
			'fechareg' => 'Fechareg',
			'activo' => 'Activo',
			'verficarEmail'=>'Repite tu Email',	
			'dia'=>"Dia",
			'mes'=>"Fecha de Nacimientos",
			'anio'=>'Año'			
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

		$criteria->compare('idusuario',$this->idusuario,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('sessionid',$this->sessionid,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido_p',$this->apellido_p,true);
		$criteria->compare('apellido_m',$this->apellido_m,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('hobbies',$this->hobbies,true);
		$criteria->compare('nivel',$this->nivel);
		$criteria->compare('strikes',$this->strikes);
		$criteria->compare('confirmado',$this->confirmado);
		$criteria->compare('word_comfirm',$this->word_comfirm,true);
		$criteria->compare('dir_files',$this->dir_files,true);
		$criteria->compare('last_login',$this->last_login);
		$criteria->compare('fec_login',$this->fec_login);
		$criteria->compare('fechareg',$this->fechareg);
		$criteria->compare('activo',$this->activo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeValidate(){
		if($this->isNewRecord)
		{
			//$formatFecha = strtotime($this->mes."/".$this->dia."/".$this->anio);
			$this->fechareg = time();
			$t_hasher = new PasswordHash(8, TRUE);			
			$hash = $t_hasher->HashPassword($this->passwd);
			$this->salt = $hash; 
			$this->passwd = $hash;
			$this->token_id = Util::getToken();
			// 1 day measured in seconds = 60 seconds * 60 minutes * 24 hours
			$segundosDia = 86400;
			$this->time_token = time()+$segundosDia;
			
		}
		
		return parent::beforeValidate();
	}
	
	protected function afterValidate(){
		if($this->isNewRecord)
		{
			$errores =	$this->getErrors();
			if(count($errores)>0)
			{
				$this->passwd = "";
				
			}
		}
		return parent::afterValidate();
	}
	
	protected function afterSave()
	{
		//url generada para activar cuenta de usuario
		//$urlToken = Yii::app()->getController()->createUrl("site/activar",array('token'=>$this->token_id));
		//mandar url al email del usuario.
		$perfil = new Perfil();
		$perfil->idusuario = $this->idusuario;
		$perfil->idprivacidad = 4;
		if($perfil->save())
		{
			return parent::afterSave();
		}
		
	}
        
        public function getTop_users() {
        
        $q = new CDbCriteria(array(
                    'join' => 'INNER JOIN meme m ON m.user_fk = t.idusuario',
                    'group' => 'm.user_fk',
                    'order' => 'COUNT(m.user_fk) DESC',
                    'condition' => 't.activo = 1',
                    'limit' => 10,
                ));
        
        return Usuario::model()->findAll($q);
    }
    
     public static function follow($user_fk) {
        if(
            Usuario::model()->exists('idusuario = :user_fk', array(':user_fk' => $user_fk)) &&
            !UserFollow::model()->exists('user_fk = :user_id AND following_id = :following_id', array(':user_id' => Yii::app()->user->getState('pk'), ':following_id' => $user_fk))
        ) {
            $userFollow = new UserFollow();
            $userFollow->user_fk = Yii::app()->user->getState('pk');
            $userFollow->following_id = $user_fk;
            $userFollow->created_at =  new CDbExpression('NOW()');
            $userFollow->save();
            return self::model()->findByPk($user_fk);
        }
        return false;
    }
    
    public static function unfollow($user_fk) {
        if($userFollow = UserFollow::model()->findByAttributes(array('user_fk' => Yii::app()->user->getState('pk'), 'following_id' => $user_fk)))
         {
            $userFollow->delete();
            return self::model()->findByPk($user_fk);
        }
        return false;
    }
    
    public static function isFollowing($user_fk) {
        return UserFollow::model()->findByAttributes(array('user_fk' => Yii::app()->user->getState('pk'), 'following_id' => $user_fk));
    }
    
     public function scopes() {
        return array(
            'visible' => array(
                'condition' => 'w_usuario.activo',
            ),
        );
    }
}