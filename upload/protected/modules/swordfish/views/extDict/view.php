<?php
/* @var $this ExtDictController */
/* @var $model ExtDict */

$this->breadcrumbs=array(
	'Ext Dicts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExtDict', 'url'=>array('index')),
	array('label'=>'Create ExtDict', 'url'=>array('create')),
	array('label'=>'Update ExtDict', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExtDict', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExtDict', 'url'=>array('admin')),
);
?>

<h1>View ExtDict #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'word',
	),
)); ?>
