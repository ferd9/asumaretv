<?php

/**
 * Description of PostBehavior
 *
 * @author Elaprendiz - asumaretv http://www.youtube.com/user/JleoD7
 */
class PostBehavior extends CActiveRecordBehavior{
   
    public function beforeValidate($event) {
        if($this->owner->isNewRecord)
        {   
            if(strlen($this->owner->post_body)>30)
            {
                $this->owner->post_descripcion = Util::generarResumen($this->owner->post_body);
            }else
            {
                 $this->owner->post_descripcion = $this->owner->post_body;
            }
            
            $this->owner->post_thumb = Util::getImageFromText($this->owner->post_body);
            if(is_null($this->owner->post_thumb))
            {
                $this->owner->post_thumb = Yii::app()->request->baseUrl."/images/noimage.png";
            }           
            $this->owner->post_user = Yii::app()->user->getState("pk");
            $this->owner->post_date = time();
            $this->owner->post_comments = 0;
            $this->owner->post_shared = 0;
            $this->owner->post_favoritos = 0;
            $this->owner->post_cache = 0;
            $this->owner->post_status = 1;
            $this->owner->post_ip = Yii::app()->request->userHostAddress;
            $this->owner->post_visitantes = 0;
        }
        $this->owner->normalizeTags();
    }
    
    public function afterFind($event) {
        parent::afterFind($event);
        $this->owner->_oldTags=$this->owner->post_tags;
    }
    
    public function afterSave($event) {
        parent::afterSave($event);
        $ch = new ComentarioHilo();
        $ch->w_idthreads = $this->owner->primaryKey();
        $ch->nombre_thread = md5(uniqid(Yii::app()->user->id, true));
        $ch->f_creacion = time();
        $ch->save();        
        Etiquetas::model()->updateFrequency($this->owner->_oldTags, $this->owner->post_tags);
    }
    
    public function afterDelete($event) {
        parent::afterDelete($event);        
        //Comment::model()->deleteAll('post_id='.$this->id);
        Etiquetas::model()->updateFrequency($this->owner->post_tags, '');
    }

}

?>
