<div class="container-fluid hpadded">
<?php
/* @var $this WebStopWordController */
/* @var $model WebStopWord */

$this->breadcrumbs=array(
	'Web Stop Words'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebStopWord', 'url'=>array('index')),
	array('label'=>'Create WebStopWord', 'url'=>array('create')),
	array('label'=>'Update WebStopWord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebStopWord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebStopWord', 'url'=>array('admin')),
);
?>

<h1>查看</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'word',
	),
)); ?>
</div>