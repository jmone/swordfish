<?php
/* @var $this ExtDictController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ext Dicts',
);

$this->menu=array(
	array('label'=>'Create ExtDict', 'url'=>array('create')),
	array('label'=>'Manage ExtDict', 'url'=>array('admin')),
);
?>

<h1>扩展字典</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
