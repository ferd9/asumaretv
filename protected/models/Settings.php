<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property string $variable
 * @property string $value
 * @property string $title
 *
 */
class Settings extends CFormModel {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Settings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function init() {
        parent::init();
        foreach (array_keys($this->attributes) as $attribute) {
            $this->$attribute  = self::value($attribute);
        }
    }

    public function save($runValidation = true, $attributes = null) {
        $valid = $runValidation ? $this->validate() : true;
        if ($valid) {
            $connection = Yii::app()->db;

            foreach (array_keys($this->attributes) as $attribute) {
                if (self::value($attribute) === false) {
                    $sql = "INSERT INTO settings (variable, value, title) VALUES(:variable, :value, '')";
                } else {
                    $sql = "UPDATE settings set value = :value WHERE variable = :variable";
                }
                $command = $connection->createCommand($sql);
                $command->bindValue(':variable', $attribute);
                $command->bindValue(':value', $this->$attribute);
                $command->execute();
            }
            return true;
        }

        return false;
    }

    public static function value($variable) {
        $connection = Yii::app()->db;
        $sql = 'SELECT * FROM settings WHERE variable = :variable';
        $command = $connection->createCommand($sql);
        $command->bindParam(":variable", $variable, PDO::PARAM_STR);
        $row = $command->queryRow();
        if ($row) {
            return $row['value'];
        }

        return false;
    }

}