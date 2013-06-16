<div class="container-fluid hpadded">
<?php
/* @var $this WebUserController */
/* @var $model WebUser */

$this->breadcrumbs=array(
	'Web Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebUser', 'url'=>array('index')),
	array('label'=>'Create WebUser', 'url'=>array('create')),
	array('label'=>'Update WebUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebUser', 'url'=>array('admin')),
);
?>

<h1>浏览账户</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'is_admin',
		'email',
		//'password',
		'dateline',
	),
)); ?>
</div>