<?php

/**
 * This is the model class for table "meme".
 *
 * The followings are the available columns in table 'meme':
 * @property string $meme_id
 * @property string $user_fk
 * @property string $title
 * @property string $file
 * @property string $remix_id
 * @property integer $is_published
 * @property integer $likes_count
 * @property string $created_at
 * @property string $is_featured
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property Usuario $fkUser
 */
class Meme extends CActiveRecord {

    const LIKE_KEY = '_likes';

    public $img;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Meme the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'meme';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, file, user_fk', 'required'),
            array('is_published, likes_count', 'numerical', 'integerOnly' => true),
            array('user_fk', 'length', 'max' => 10),
            array('title', 'length', 'max' => 255),
            array('file', 'length', 'max' => 100),
            array('created_at, is_featured, is_active, remix_id', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('meme_id, user_fk, title, file, is_published, likes_count, created_at, remix_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'Usuario', 'user_fk'),
            'likes' => array(self::HAS_MANY, 'MemeLike', 'meme_fk'),
            'remixes' => array(self::HAS_MANY, 'Meme', 'remix_id'),
            'remixes_count' => array(self::STAT, 'Meme', 'remix_id'),
            'flags' => array(self::HAS_MANY, 'MemeFlag', 'meme_fk'),
            'flagged_times' => array(self::STAT, 'MemeFlag', 'meme_fk'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'meme_id' => Yii::t('yii', 'Meme'),
            'user_fk' => Yii::t('yii', 'User'),
            'title' => Yii::t('yii', 'Title'),
            'file' => Yii::t('yii', 'File'),
            'remix_id' => Yii::t('yii', 'Remix of'),
            'is_published' => Yii::t('yii', 'Is Published'),
            'likes_count' => Yii::t('yii', 'Likes Count'),
            'created_at' => Yii::t('yii', 'Created At'),
            'is_featured' => Yii::t('yii', 'Is Featured'),
            'is_active' => Yii::t('yii', 'Is Active'),
        );
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }

    public function getRemix_of() {
        if ($this->remix_id) {
            return self::model()->findByPk($this->remix_id);
        }

        return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('meme_id', $this->meme_id, true);
        $criteria->compare('user_fk', $this->user_fk, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('remix_id', $this->remix_id, true);
        $criteria->compare('is_published', $this->is_published);
        $criteria->compare('is_featured', $this->is_featured);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('likes_count', $this->likes_count);
        $criteria->compare('created_at', $this->created_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function saveMemeInSession($meme) {
        Yii::app()->session['_meme'] = $meme;
    }

    public static function popMemeFromSession() {
        $meme = Yii::app()->session['_meme'];
        if (is_array($meme) && !empty($meme)) {
            Yii::app()->session['_meme'] = array();
            return $meme;
        }

        return array();
    }

    public static function hasLiked($meme) {
        $likes = self::getLikes();
        if (in_array($meme->meme_id, $likes)) {
            return true;
        }
        return false;
    }

    public static function getLikes() {

        $likes = is_array(Yii::app()->session[self::LIKE_KEY]) ? Yii::app()->session[self::LIKE_KEY] : array();
        return $likes;
    }

    /**
     * 
     * @param Meme $meme
     * @return boolean
     */
    public static function like($meme) {
        $likes = self::getLikes();
        if (!self::hasLiked($meme)) {
            $likes[] = $meme->meme_id;
            $meme->saveAttributes(array('likes_count' => $meme->likes_count + 1));
            Yii::app()->session[self::LIKE_KEY] = $likes;

            if (!MemeLike::model()->findByAttributes(array('user_fk' => Yii::app()->user->getState('pk'), 'meme_fk' => $meme->meme_id))) {
                $memeLike = new MemeLike();
                $memeLike->user_fk = Yii::app()->user->getState('pk');
                $memeLike->meme_fk = $meme->meme_id;
                $memeLike->created_at = new CDbExpression('NOW()');
                $memeLike->save();                
                $e = new CEvent(Meme::model());
                $e->params['meme_like'] = $memeLike;
                Yii::app()->plugin->onMemeLike($e);
            }

            return true;
        }

        return false;
    }

    public static function unlike($meme) {
        $likes = self::getLikes();
        if (self::hasLiked($meme)) {
            $meme->saveAttributes(array('likes_count' => $meme->likes_count - 1));
            unset($likes[array_search($meme->meme_id, $likes)]);
            Yii::app()->session[self::LIKE_KEY] = $likes;

            if ($memeLike = MemeLike::model()->findByAttributes(array('user_fk' => Yii::app()->user->getState('pk'), 'meme_fk' => $meme->meme_id))) {
                $memeLike->delete();
                $e = new CEvent(Meme::model());
                $e->params['meme_like'] = $memeLike;
                Yii::app()->plugin->onMemeUnLike($e);
            }

            return true;
        }
        return false;
    }

    public function getPost_url() {
        $e = new CEvent($this);
        $e->params['post_url'] = Yii::app()->createAbsoluteUrl('site/index', array('id' => $this->meme_id));
        Yii::app()->plugin->onMemePostUrl($e);
        return $e->params['post_url'];
    }

    public function getUrl() {
        return Yii::app()->getBaseUrl(true) . '/memes/' . $this->file;
    }

    public function getOrignal_name() {
        return md5(Yii::app()->params['salt'] . substr($this->file, 0, -4)) . substr($this->file, -4);
    }

    public function getThumb_name() {
        return substr($this->file, 0, -4) . '_thumb' . substr($this->file, -4);
    }

    public function getUrl_orignal() {
        return Yii::app()->baseUrl . '/memes/' . $this->getOrignal_name();
    }

    public function getThumb_url() {
        return Yii::app()->baseUrl . '/memes/' . $this->getThumb_name();
    }

    public function getAbsolute_path_thumb() {
        return Yii::getPathOfAlias('webroot.memes') . DIRECTORY_SEPARATOR . $this->getThumb_name();
    }

    public function getAbsolute_path_orignal() {
        return Yii::getPathOfAlias('webroot.memes') . DIRECTORY_SEPARATOR . $this->getOrignal_name();
    }

    public function getAbsolute_path() {
        return Yii::getPathOfAlias('webroot.memes') . DIRECTORY_SEPARATOR . $this->file;
    }

    public function putWatermark() {
        $watermark = Settings::value('watermark_text');
        if (Settings::value('watermark_enable')) {
            
            $e = new CEvent($this);
            Yii::app()->plugin->onMemeWatermark($e);
            if(!$e->handled) {
                // write watermark
                $watermark = Utility::utf8Text($watermark);
                Yii::app()->thumb->load($this->getAbsolute_path_orignal());
                Yii::app()->thumb->writeShadowText($watermark, Settings::value('watermark_size'), Utility::hex2dec(Settings::value('watermark_color')));
                Yii::app()->thumb->saveToFile($this->getAbsolute_path());
            }
            return true;
        }
        return false;
    }
    
    public function generateThumb() {
        Yii::app()->thumb->generate($this->getAbsolute_path(), $this->getAbsolute_path_thumb());
    }

    public function getWidth() {
        return imagesx($this->getImg());
    }

    public function getHeight() {
        return imagesy($this->getImg());
    }

    public function getImg() {
        if ($this->img == null) {
            $this->img = imagecreatefromstring(file_get_contents($this->getAbsolute_path()));
        }

        return $this->img;
    }

    public function afterDelete() {
        $memeLikes = MemeLike::model()->findAllByAttributes(array('meme_fk' => $this->meme_id));
        if ($memeLikes) {
            foreach ($memeLikes as $memeLike) {
                $memeLike->delete();
            }
        }
        
        $memeFlags = MemeFlag::model()->findAllByAttributes(array('meme_fk' => $this->meme_id));
        if ($memeFlags) {
            foreach ($memeFlags as $memeFlag) {
                $memeFlag->delete();
            }
        }
        
        Meme::model()->updateAll(array('remix_id' => 0), 'remix_id = :remix_id', array(':remix_id' => $this->meme_id));
        
        return parent::afterDelete();
    }

    public static function hasFlagged($meme_id) {
        return MemeFlag::model()->findByAttributes(array('meme_fk' => $meme_id, 'user_fk' => Yii::app()->user->id));
    }

    public function scopes() {
        return array(
            'visible' => array('condition' => 'meme.is_active = 1 and meme.is_published = 1'),
            'visible_remixes' => array('condition' => 'remixes.is_active = 1 and remixes.is_published = 1'),
            'current_user' => array('condition' => 'user_fk = ' . Yii::app()->user->id),
        );
    }

}