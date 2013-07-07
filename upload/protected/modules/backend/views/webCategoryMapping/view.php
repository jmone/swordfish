<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */

$this->breadcrumbs=array(
	'Category Mappings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CategoryMapping', 'url'=>array('index')),
	array('label'=>'Create CategoryMapping', 'url'=>array('create')),
	array('label'=>'Update CategoryMapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryMapping', 'url'=>array('admin')),
);
?>

<h1>View CategoryMapping #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category_id',
		'site_id',
		'site_category_id',
	),
)); ?>
