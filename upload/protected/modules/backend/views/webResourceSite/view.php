<?php
/* @var $this WebResourceSiteController */
/* @var $model ResourceSite */

$this->breadcrumbs=array(
	'Resource Sites'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ResourceSite', 'url'=>array('index')),
	array('label'=>'Create ResourceSite', 'url'=>array('create')),
	array('label'=>'Update ResourceSite', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ResourceSite', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResourceSite', 'url'=>array('admin')),
);
?>

<h1>View ResourceSite #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'url',
		'icon',
	),
)); ?>
