<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
//Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.tooltipster.min.js', CClientScript::POS_HEAD);
$st = 'sexo';
$da = array();
$idSex = CHtml::resolveNameID($model,$st,$da);

$dia = 'dia';
$dia_name_id = array();
CHtml::resolveNameID($model,$dia,$dia_name_id);

$mes = 'mes';
$name_id = array();
CHtml::resolveNameID($model,$mes,$name_id);

$year = 'anio';
$year_name_id = array();
CHtml::resolveNameID($model,$year,$year_name_id);
//print_r($da);
Yii::app()->clientScript->registerScript('asuvericodes','
		$("button.btn-info").on("click",function(){
			if($(this).text() == "Mujer")
			{
				$("#'.$da['id'].'").val("M");
			}else if($(this).text() == "Hombre")
			{
				$("#'.$da['id'].'").val("H");		
			}
	});
						
	$("#'.$name_id['id'].'").change(function(){
		if($(this).val() >=0)
		{			
			if ($(this).val()==3 || $(this).val()==5 || $(this).val()==8 || $(this).val()==10)
			{
				var dia = $("#'.$dia_name_id['id'].'").val();
				if(dia>30)
				{
					$("#inner-alert").append("<span>El dia Maximo para el mes seleccionado es 30 - Click Para Cerrar</span>");
					$("#error-date").show(function(){
						$(this).click(function(){
							$(this).hide();
							$(".alert-title").next().remove();
						});
					});						
				}
			}

			if($(this).val()==1 )
			{
				var dia = $("#'.$dia_name_id['id'].'").val();
				if(dia>29)
				{
					$("#inner-alert").append("<span>El dia Maximo para el mes seleccionado es 29 - Click Para Cerrar</span>");
					$("#error-date").show(function(){
						$(this).click(function(){
							$(this).hide();
							$(".alert-title").next().remove();
						});
					});						
				}		
			}						
		}		
	});

	$("#'.$dia_name_id['id'].'").change(function(){
		if($(this).val() >=1)
		{
			var mes = $("#'.$name_id['id'].'").val();
			if (mes==3 || mes==5 || mes==8 || mes==10)	
			{
				if($(this).val()>30)
				{
					$("#inner-alert").append("<span>El Mes seleccionado solo permite 30 dias - Click Para Cerrar</span>");
					$("#error-date").show(function(){
						$(this).click(function(){
							$(this).hide();
							$(".alert-title").next().remove();
						});
					});		
				}
			}	

			if(mes==1)
			{
			   if($(this).val()>29)
			  {			
					$("#inner-alert").append("<span>El dia Maximo para el mes seleccionado es 29 - Click Para Cerrar</span>");
						$("#error-date").show(function(){
							$(this).click(function(){
								$(this).hide();
								$(".alert-title").next().remove();
							});
						});		
			  }		
			}				
		}
	});					

	$("#'.$year_name_id['id'].'").change(function(){
			
		//bisiesto 29 dias	
		var diasBisiesto = ($(this).val()%4==0 && ($(this).val()%100!=0 || $(this).val()%400==0)) ? true : false;
		var mes = $("#'.$name_id['id'].'").val();
		var dias = 	$("#'.$dia_name_id['id'].'").val();	
		if(mes == 1 && diasBisiesto)
		{
			if(dias>29)
			 {
				$("#inner-alert").append("<span>El dia Maximo para el mes seleccionado es 29 - Click Para Cerrar</span>");
					$("#error-date").show(function(){
						$(this).click(function(){
							$(this).hide();
							$(".alert-title").next().remove();
						});
					});		
			 }	
		}else if(mes == 1 && !diasBisiesto)
		{
			if(dias>28)
			 {
				$("#inner-alert").append("<span>El dia Maximo para el mes seleccionado es 28 - Click Para Cerrar</span>");
					$("#error-date").show(function(){
						$(this).click(function(){
							$(this).hide();
							$(".alert-title").next().remove();
						});
					});		
			 }	
		}	
	});	

	$("input").hover(function(e){				
			e.preventDefault();
			$(this).tooltip({"container":"p","placement":"right"});
				
	});	
			
				
');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	 'htmlOptions'=>array('class'=>'form-horizontal'),	
	 'enableAjaxValidation'=>false,
	 'enableClientValidation'=>true,
	 'clientOptions'=>array(
			'validateOnSubmit'=>true,
			
			'afterValidate' => 'js:function(form, data, hasError) {
                  if(hasError) {
                      for(var i in data) $("#"+i).parents(".control-group").addClass("error");
                      return false;
                  }
                  else {
                      form.children().parents(".control-group").removeClass("error");
                      return true;
                  }
              }',
	 		
			'afterValidateAttribute' => 'js:function(form, attribute, data, hasError) {
               if(hasError) 
	 			{
	 				$("#"+attribute.id).parents(".control-group").addClass("error");
	 				
				}	 		
               else $("#"+attribute.id).parents(".control-group").removeClass("error");
              }'
		 ),
)); ?>
<legend>Registro</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'username',array('class'=>"control-label")); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span>
			<?php echo $form->textField($model,'username',array('placeholder'=>'Nombre de Usuario','class'=>"input-xlarge",'rel'=>'tooltip','title'=>"Ingresa el nombre que quieras para poder Ingresar.",'size'=>35,'maxlength'=>35)); ?>
			
			</div>
			<?php echo $form->error($model,'username',array('class'=>'help-inline')); ?>
	</div>
		
	</div>
<div id="hi" style="width: 100px; height: 100px; margin: 0 0 0 500px; background: #f00;" class="tooltip" title="This is a longer ketchup muffins long so freaking long let's talk about really yummy waffles please tooltip title yo asdf asdf asdf <a href='http://google.com'>link</a>"></div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>"control-label")); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span>
			<?php echo $form->textField($model,'nombre',array('placeholder'=>'Ingresa tu nombre','rel'=>'tooltip','title'=>"Ingresa tu verdadero nombre.",'class'=>"input-xlarge",'size'=>35,'maxlength'=>35)); ?>
			</div>
			<?php echo $form->error($model,'nombre',array('class'=>'help-inline')); ?>
		</div>
	</div>
	
	<div class="control-group">
	<?php echo $form->labelEx($model,'email',array('class'=>"control-label")); ?>
	<div class="controls">
		<div class="input-prepend">	
			<span class="add-on"><i class="icon-envelope"></i></span>		
			<?php echo $form->textField($model,'email',array('placeholder'=>'Email','class'=>"input-xlarge",'rel'=>'tooltip','title'=>"Ingresa tu correo. te enviaremos un mensaje.",'size'=>45,'maxlength'=>45)); ?>
		</div>
		<?php echo $form->error($model,'email',array('class'=>'help-inline')); ?>	
	</div>	
	</div>

	<div class="control-group">
	<?php echo $form->labelEx($model,'verficarEmail',array('class'=>"control-label")); ?>
	<div class="controls">
		<div class="input-prepend">	
			<span class="add-on"><i class="icon-envelope"></i></span>		
			<?php echo $form->textField($model,'verficarEmail',array('placeholder'=>'Repite tu Email','class'=>"input-xlarge",'rel'=>'tooltip','title'=>"Vuelve a escribir tu Correo",'size'=>45,'maxlength'=>45)); ?>
		</div>
		<?php echo $form->error($model,'verficarEmail',array('class'=>'help-inline')); ?>	
	</div>	
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'passwd',array('class'=>"control-label")); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on"><i class="icon-lock"></i></span>
			<?php echo $form->passwordField($model,'passwd',array('placeholder'=>'Contrasena','class'=>"input-xlarge",'rel'=>'tooltip','title'=>"Ingresa una clave que sea de recordar para ti, pero dificil de adivinar para otros.",'size'=>45,'maxlength'=>45)); ?>
		   </div>
		   <?php echo $form->error($model,'passwd',array('class'=>'help-inline')); ?>
		</div>
	</div>

	<div class="control-group">
	        <?php echo $form->labelEx($model,'sexo',array('class'=>"control-label")); ?>
			<div class="controls">
					<?php echo $form->hiddenField($model,'sexo',array('size'=>1,'maxlength'=>1)); ?>
					<p><div id="gender" class="btn-group" data-toggle="buttons-radio">
                    <button type="button" class="btn btn-info <?php echo $model->sexo == "H"?"active":"";?>" name="sexo">Hombre</button>
                    <button type="button" class="btn btn-info <?php echo $model->sexo == "M"?"active":"";?>" name="sexo">Mujer</button>
                  </div></p>
				<?php echo $form->error($model,'sexo',array('class'=>'help-inline')); ?>
			</div>
		</div>
		
	<div class="control-group">
		<?php echo $form->labelEx($model,'mes',array('class'=>"control-label")); ?>
		<div class="controls">
			<div class="input-prepend">
			<span class="add-on"><i class="icon-time"></i></span>
			<?php echo $form->dropDownList($model, 'dia',Util::getDias(),array('class'=>'span1','empty'=>'Dia')); ?>
			<?php echo $form->dropDownList($model, 'mes', Util::getMeses(),array('class'=>"span2",'empty'=>'Mes')); ?>
			<?php echo $form->dropDownList($model, 'anio',Util::getAnios(),array('style'=>'width:90px;','empty'=>'Año')); ?>
			</div>
			<?php echo $form->error($model,'mes',array('class'=>'help-inline')); ?>
		</div>
	</div>	
	<div class="alert alert-error" style="display:none;" id="error-date">
      <div class="inner-alert" id="inner-alert">
      <span class="alert-title">ERROR:</span> 
       </div>
    </div>
	<div class="control-group">
	    <label class="control-label"></label>
          <div class="controls">
			 <button type="submit" class="btn btn-success"><?php echo $model->isNewRecord ? 'Crear Nueva Cuenta' : 'Save';?></button>
		  </div>	
		</div>	
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

	