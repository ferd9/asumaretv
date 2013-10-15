<?php

class Utility {

    public static function seoName($string) {
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]+/", "-", $string);
        return $string;
    }

    public static function uniqueUsername($string) {
        $string = strtolower($string);

        $emailValidator = new CEmailValidator();
        if ($emailValidator->validateValue($string)) {
            $string = substr($string, 0, strpos($string, '@'));
        }

        $string = preg_replace("/[^a-z0-9._]/", "", $string);
        $i = 1;
        $username = $string;
        while (Usuario::model()->exists('username = :username', array(':username' => $username))) {
            $username = $string . $i;
        }
        return $username;
    }

    public static function hasFlash($type = 'error') {
        return Yii::app()->user->hasFlash($type);
    }

    public static function setFlash($message, $type = 'error') {
        $messages = (array) Yii::app()->user->getFlash($type);
        $messages[] = $message;
        Yii::app()->user->setFlash($type, $messages);
    }

    public static function getFlash($type = 'error') {
        $messages = Yii::app()->user->getFlash($type);
        return $messages;
    }

    public static function tableHead($link, $header, $options = array()) {
        $out = '';

        $page = (int) Yii::app()->request->getQuery('page');
        $page = $page > 0 ? $page : 1;
        $sort = Yii::app()->request->getQuery('sort');
        $sort = empty($sort) ? 'asc' : $sort;
        $order = Yii::app()->request->getQuery('order');

        foreach ($header as $field => $title) {
            $th_attrs = array();
            if (is_array($title)) {
                $th_attrs = isset($title[1]) ? $title[1] : array();
                $title = $title[0];
            }

            $params = array(
                'order' => $field,
                'sort' => ($sort == 'asc' ? 'desc' : 'asc')
            );

            if (isset($options['page']) && $options['page']) {
                $params['page'] = $page;
            }

            if (isset($options['query']) && is_array($options['query'])) {
                $params = array_merge($params, $options['query']);
            }
            $out .= '<th' . CHtml::renderAttributes($th_attrs) . '>';
            if (is_string($field)) {
                $out .= '<a href="' . Yii::app()->createUrl($link, $params) . '">';
            }
            $out .= $title;

            if (is_string($field)) {
                if ($order == $field) {
                    $out .= $sort == 'asc' ? ' <i class="icon-chevron-up"></i>' : ' <i class="icon-chevron-down"></i>';
                }
                $out .= '</a>';
            }
            $out .= '</th>';
        }

        return $out;
    }

    public static function beginsWith($str, $search) {
        if (substr($str, 0, strlen($search)) == $search) {
            return true;
        }

        return false;
    }

    public static function getTagFromID($integer, $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $length = strlen($base);
        $out = '';
        while ($integer > $length - 1) {
            $out = $base[fmod($integer, $length)] . $out;
            $integer = floor($integer / $length);
        }
        return $base[$integer] . $out;
    }

    public static function getIDFromTag($string, $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $length = strlen($base);
        $size = strlen($string) - 1;
        $string = str_split($string);
        $out = strpos($base, array_pop($string));
        foreach ($string as $i => $char) {
            $out += strpos($base, $char) * pow($length, $size - $i);
        }
        return $out;
    }

    /**
     * @param string $color
     * @return array
     */
    public static function hex2dec($color) {
        $color = str_replace('#', '', $color);
        return array(hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
    }

    public static function utf8Text($text) {
        $text = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");
// Convert HTML entities into ISO-8859-1
        $text = html_entity_decode($text, ENT_NOQUOTES, "ISO-8859-1");
// Convert characters > 127 into their hexidecimal equivalents
        $out = "";
        for ($i = 0; $i < strlen($text); $i++) {
            $letter = $text[$i];
            $num = ord($letter);
            if ($num > 127) {
                $out .= "&#$num;";
            } else {
                $out .= $letter;
            }
        }
        
        return $out;
    }

}