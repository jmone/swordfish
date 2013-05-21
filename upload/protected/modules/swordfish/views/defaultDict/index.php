<?php
/* @var $this DefaultDictController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Default Dicts',
);

$this->menu=array(
	array('label'=>'Create DefaultDict', 'url'=>array('create')),
	array('label'=>'Manage DefaultDict', 'url'=>array('admin')),
);
?>

<h1>Default Dicts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
