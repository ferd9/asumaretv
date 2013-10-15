<?php

class MemeForm extends CFormModel
{
	public $title;
	public $publish;
	public $image;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('title, image', 'required'),
			array('publish', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=> Yii::t('yii', 'Title'),
			'image'=> Yii::t('yii', 'Image'),
			'publish'=> Yii::t('yii', 'Publish'),
		);
	}
}