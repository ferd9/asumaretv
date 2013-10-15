<?php

class MyLinkPager extends CLinkPager {
    
    
	/**
	 * Initializes the pager by setting some default property values.
	 */
	public function init()
	{
		if($this->nextPageLabel===null)
			$this->nextPageLabel=Yii::t('yii','Next');
		if($this->prevPageLabel===null)
			$this->prevPageLabel=Yii::t('yii','Previous');
		if($this->firstPageLabel===null)
			$this->firstPageLabel=Yii::t('yii','&lt;&lt; First');
		if($this->lastPageLabel===null)
			$this->lastPageLabel=Yii::t('yii','Last &gt;&gt;');
		if($this->header===null)
			$this->header=Yii::t('yii','Go to page: ');

		if(!isset($this->htmlOptions['id']))
			$this->htmlOptions['id']=$this->getId();
		if(!isset($this->htmlOptions['class']))
			$this->htmlOptions['class']='row-fluid pagination clearfix';
	}
    
        /**
	 * Executes the widget.
	 * This overrides the parent implementation by displaying the generated page buttons.
	 */
	public function run()
	{
		$this->registerClientScript();
		$buttons=$this->createPageButtons();
		if(empty($buttons))
			return;
		echo $this->header;
		echo CHtml::tag('div',array_merge($this->htmlOptions),implode("\n",$buttons));
		echo $this->footer;
                $pageCount=$this->getPageCount();
                $pageUrl=Yii::app()->getBaseUrl(true) . '/page/';
                Yii::app()->clientScript->registerScript('pager-change-script', <<<JS
                        $('.outof').click(function(){
                            $(this).find('input').show();
                            $(this).find('input').select();
                        });
                        
                        
                        $('.outof input').keydown(function(e){
                            if( e.which == 13 )
                            {
                                var value = parseInt( $( this ).val() )
                                , max     = $pageCount;

                                if( !isNaN( value ) && value > 0 && value <= max )
                                {
                                    $(this).hide();
                                    $(this).parent().find('.loading').show();
                                    location.href =  '$pageUrl' + value;
                                }
                            }
                            else
                            {
                                return ( e.which != 8 && e.which != 0 && ( e.which < 48 || e.which > 57 ) )  ? false : true;
                            }
                        });
                        
                        
JS
                        );
	}
        
        /**
	 * Creates the page buttons.
	 * @return array a list of page buttons (in HTML code).
	 */
	protected function createPageButtons()
	{
		$pageCount=$this->getPageCount();
		list($beginPage,$endPage)=$this->getPageRange();
		$currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
		$buttons=array();

		// prev page
		if(($page=$currentPage-1)<0)
			$page=0;

//                $currentPage<=0
		$buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass . ($currentPage<=0 ? ' disabled' : ''),false,false);

                $buttons[] = $this->createPageButton('<span class="outof ttip" title="' . Yii::t('yii', 'enter the page number and press enter') . '"><div class="loading"></div><input type="text" class="page-changer" style="display:none;" value="' . ($currentPage+1) . '" /> ' . ($currentPage+1) . ' ' . Yii::t('yii', 'of') . ' ' . $pageCount . ' </span>', $page, '',false,false, false);


		// next page
		if(($page=$currentPage+1)>=$pageCount-1)
			$page=$pageCount-1;
                
//                $currentPage>=$pageCount-1
		$buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass . ($currentPage>=$pageCount-1 ? ' disabled' : ''),false,false);


		return $buttons;
	}
        
        protected function createPageButton($label,$page,$class,$hidden,$selected, $link = true)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
                
                if(strstr($class, 'disabled') !== false) {

                    return '<div class="span4">'.
                                '<label class="' . $class . '">' . $label . '</label>'
                            .'</div>';
                }
                else {
                    $params=$this->getPages()->params===null ? $_GET : $this->getPages()->params;
                    $params['page'] = $page+1;
                    return '<div class="span4">'.
                            ($link ? CHtml::link($label,Yii::app()->createUrl('site/index', $params), array('class' => $class))
                            : $label)
                            .'</div>';
                }
	}
}