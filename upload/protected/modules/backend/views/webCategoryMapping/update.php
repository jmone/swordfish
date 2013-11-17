<div class="container-fluid hpadded">
<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */

$this->breadcrumbs=array(
	'Category Mappings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryMapping', 'url'=>array('index')),
	array('label'=>'Create CategoryMapping', 'url'=>array('create')),
	array('label'=>'View CategoryMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryMapping', 'url'=>array('admin')),
);
?>

<h3>更新信息</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
