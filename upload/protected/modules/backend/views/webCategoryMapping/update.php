<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */

$this->breadcrumbs=array(
	'Category Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryMapping', 'url'=>array('index')),
	array('label'=>'Create CategoryMapping', 'url'=>array('create')),
	array('label'=>'View CategoryMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryMapping', 'url'=>array('admin')),
);
?>

<h1>Update CategoryMapping <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>