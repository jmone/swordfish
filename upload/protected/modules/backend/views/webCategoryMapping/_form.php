<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-mapping-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id'); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'site_id'); ?>
		<?php echo $form->textField($model,'site_id'); ?>
		<?php echo $form->error($model,'site_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'site_category_id'); ?>
		<?php echo $form->textField($model,'site_category_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'site_category_id'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'site_url'); ?>
		<?php echo $form->textField($model,'site_url',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'site_url'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
