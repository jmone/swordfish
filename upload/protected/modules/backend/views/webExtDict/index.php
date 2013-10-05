<?php
/* @var $this WebExtDictController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Web Ext Dicts',
);

$this->menu=array(
	array('label'=>'Create WebExtDict', 'url'=>array('create')),
	array('label'=>'Manage WebExtDict', 'url'=>array('admin')),
);
?>

<h1>Web Ext Dicts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
