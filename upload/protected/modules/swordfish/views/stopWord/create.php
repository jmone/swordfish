<?php
/* @var $this StopWordController */
/* @var $model StopWord */

$this->breadcrumbs=array(
	'Stop Words'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StopWord', 'url'=>array('index')),
	array('label'=>'Manage StopWord', 'url'=>array('admin')),
);
?>

<h1>Create StopWord</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>