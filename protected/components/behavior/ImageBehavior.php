<?php

/**
 * Description of PostBehavior
 *
 * @author Elaprendiz - asumaretv http://www.youtube.com/user/JleoD7
 */
class ImageBehavior extends CActiveRecordBehavior{
   
    public function beforeValidate($event) {
        if($this->owner->isNewRecord)
        {
            $this->owner->fecha = time();
             $this->owner->idusuario = Yii::app()->user->getState("pk");
            if(strlen($this->owner->descripcion)==0 || is_null($this->owner->descripcion))
            {
                $this->owner->descripcion = "Imagen sin descripcion";               
            }
        }
        
        $this->owner->normalizeTags();
    }
    
    public function afterFind($event) {
        parent::afterFind($event);
        $this->owner->_oldTags=$this->owner->etiquetas;
    }
    
    public function afterSave($event) {
        parent::afterSave($event);
               
        Etiquetas::model()->updateFrequency($this->owner->_oldTags, $this->owner->etiquetas);
    }
    
    public function afterDelete($event) {
        parent::afterDelete($event);        
        //Comment::model()->deleteAll('post_id='.$this->id);
        Etiquetas::model()->updateFrequency($this->owner->etiquetas, '');
    }

}

?>
