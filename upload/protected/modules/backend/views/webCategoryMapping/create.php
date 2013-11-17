<div class="container-fluid hpadded">
<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */

$this->breadcrumbs=array(
	'Category Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryMapping', 'url'=>array('index')),
	array('label'=>'Manage CategoryMapping', 'url'=>array('admin')),
);
?>

<h3>添加映射关系</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
