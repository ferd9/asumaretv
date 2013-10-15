<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $page_id
 * @property string $page_position_fk
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $weight
 * @property string $parent_id
 * @property string $updated_at
 * @property string $created_at
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property PagePosition $pagePositionFk
 */
class Page extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_position_fk, title, slug, content', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('page_position_fk, parent_id', 'length', 'max'=>10),
			array('title, slug', 'length', 'max'=>255),
                        array('updated_at, created_at, weight, is_active', 'safe'),
                        array('slug', 'unique', 'className' => 'Page', 'attributeName' => 'slug'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('page_id, page_position_fk, title, slug, content, weight, parent_id, updated_at, created_at, is_active', 'safe', 'on'=>'search'),
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
			'position' => array(self::BELONGS_TO, 'PagePosition', 'page_position_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'page_id' => 'Page Id',
			'page_position_fk' => 'Page Position',
			'title' => 'Title',
			'slug' => 'Slug',
			'content' => 'Content',
			'weight' => 'Weight',
			'parent_id' => 'Parent',
			'updated_at' => 'Updated At',
			'created_at' => 'Created At',
			'is_active' => 'Is Active',
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

		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('page_position_fk',$this->page_position_fk,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('weight',$this->weight,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave() {
            if($this->isNewRecord) {
                $this->created_at = new CDbExpression('NOW()');
                $this->updated_at = new CDbExpression('NOW()');
            }
            else {
                $this->updated_at = new CDbExpression('NOW()');
            }
            return parent::beforeSave();
        }
        
        
        public function scopes() {
            return array(
                'active' => array(
                    'condition' => 't.is_active = 1',
                    'order' => 't.weight desc',
                ),
            );
        }
        
        public function position($position) {
            $this->getDbCriteria()->mergeWith(array(
                'condition' => 'position.position = :position',
                'params' => array(':position' => $position),
                'with' => 'position',
            ));
            return $this;
        }
}