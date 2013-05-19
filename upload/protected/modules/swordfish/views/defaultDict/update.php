<?php
/* @var $this DefaultDictController */
/* @var $model DefaultDict */

$this->breadcrumbs=array(
	'Default Dicts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DefaultDict', 'url'=>array('index')),
	array('label'=>'Create DefaultDict', 'url'=>array('create')),
	array('label'=>'View DefaultDict', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DefaultDict', 'url'=>array('admin')),
);
?>

<h1>Update DefaultDict <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>