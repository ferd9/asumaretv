<?php

class OldPasswordValidator extends CValidator {
    
    protected function validateAttribute($object, $attribute) {
        $value = $object->$attribute;
        $user = User::model()->findByPk(Yii::app()->user->id);
        if ($user && (!empty($user->password) && $user->password != md5($value))) {
            $message = $this->message !== null ? $this->message : Yii::t('yii', 'Old password does not match.');
            $this->addError($object, $attribute, $message);
        }
    }

}
