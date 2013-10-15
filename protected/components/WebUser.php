<?php


/**
 * Description of WebUser
 *
 * @author Elaprendiz - asumaretv http://www.youtube.com/user/JleoD7
 */
class WebUser extends CWebUser {
    
    private $_model;
    
    public function getNombre()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        return is_null($user->nombre)?"Invitado":$user->nombre;
    }
    
    public function isAdmin()
    {
        
    }
    
    public function getIs_admin() {
        return (bool)$this->getState('is_admin');
    }
    
    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Usuario::model()->findByPk($id);
        }
        return !is_null($this->_model)?$this->_model:null;
    }
    
    public function getAvatar($id = 0) {
        $id = $id ? $id : $this->getId();
        return md5(Yii::app()->params['salt'] . $id) . '.png';
    }
    
    public function getAvatar_url($id = 0) {
        $avatar = $this->getAvatar($id);
        if(file_exists(Yii::getPathOfAlias('webroot.' . Yii::app()->params['avatar_dir']) . DIRECTORY_SEPARATOR . $avatar)) {
            return Yii::app()->baseUrl . '/' . Yii::app()->params['avatar_dir'] . '/' . $avatar;
        }
        return Yii::app()->baseUrl . '/' . Yii::app()->params['avatar_dir'] . '/' . 'default.png';
    }
}

?>
