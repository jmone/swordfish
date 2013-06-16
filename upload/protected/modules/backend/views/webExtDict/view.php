<div class="container-fluid hpadded">
<?php
/* @var $this WebExtDictController */
/* @var $model WebExtDict */

$this->breadcrumbs=array(
	'Web Ext Dicts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebExtDict', 'url'=>array('index')),
	array('label'=>'Create WebExtDict', 'url'=>array('create')),
	array('label'=>'Update WebExtDict', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebExtDict', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebExtDict', 'url'=>array('admin')),
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