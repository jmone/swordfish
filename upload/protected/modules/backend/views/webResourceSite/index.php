<?php
/* @var $this WebResourceSiteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Resource Sites',
);

$this->menu=array(
	array('label'=>'Create ResourceSite', 'url'=>array('create')),
	array('label'=>'Manage ResourceSite', 'url'=>array('admin')),
);
?>

<h1>Resource Sites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
