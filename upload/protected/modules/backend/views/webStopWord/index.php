<?php
/* @var $this WebStopWordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Web Stop Words',
);

$this->menu=array(
	array('label'=>'Create WebStopWord', 'url'=>array('create')),
	array('label'=>'Manage WebStopWord', 'url'=>array('admin')),
);
?>

<h1>Web Stop Words</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
