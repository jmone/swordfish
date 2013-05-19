<?php
/* @var $this DefaultDictController */
/* @var $model DefaultDict */

$this->breadcrumbs=array(
	'Default Dicts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DefaultDict', 'url'=>array('index')),
	array('label'=>'Create DefaultDict', 'url'=>array('create')),
	array('label'=>'Update DefaultDict', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DefaultDict', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DefaultDict', 'url'=>array('admin')),
);
?>

<h1>View DefaultDict #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'word',
	),
)); ?>
