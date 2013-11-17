<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */
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
		<?php echo $form->label($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'site_id'); ?>
		<?php echo $form->textField($model,'site_id'); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'site_category_id'); ?>
		<?php echo $form->textField($model,'site_category_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'site_url'); ?>
		<?php echo $form->textField($model,'site_url',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
