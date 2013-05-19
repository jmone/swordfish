<?php
/* @var $this StopWordController */
/* @var $model StopWord */

$this->breadcrumbs=array(
	'Stop Words'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StopWord', 'url'=>array('index')),
	array('label'=>'Create StopWord', 'url'=>array('create')),
	array('label'=>'View StopWord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StopWord', 'url'=>array('admin')),
);
?>

<h1>Update StopWord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>