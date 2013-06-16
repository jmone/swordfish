<?php
/* @var $this WebUserController */
/* @var $model WebUser */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'is_admin'); ?>
		<?php echo $form->textField($model,'is_admin'); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'dateline'); ?>
		<?php echo $form->textField($model,'dateline'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->