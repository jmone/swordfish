<?php
/* @var $this WebCategoryMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Mappings',
);

$this->menu=array(
	array('label'=>'Create CategoryMapping', 'url'=>array('create')),
	array('label'=>'Manage CategoryMapping', 'url'=>array('admin')),
);
?>

<h1>Category Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
