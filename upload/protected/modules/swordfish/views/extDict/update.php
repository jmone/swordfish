<?php
/* @var $this ExtDictController */
/* @var $model ExtDict */

$this->breadcrumbs=array(
	'Ext Dicts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExtDict', 'url'=>array('index')),
	array('label'=>'Create ExtDict', 'url'=>array('create')),
	array('label'=>'View ExtDict', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ExtDict', 'url'=>array('admin')),
);
?>

<h1>Update ExtDict <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>