<?php
/* @var $this WebStopWordController */
/* @var $model WebStopWord */
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
		<?php echo $form->label($model,'word'); ?>
		<?php echo $form->textField($model,'word',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class=" buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->