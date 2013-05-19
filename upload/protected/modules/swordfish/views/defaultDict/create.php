<?php
/* @var $this DefaultDictController */
/* @var $model DefaultDict */

$this->breadcrumbs=array(
	'Default Dicts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DefaultDict', 'url'=>array('index')),
	array('label'=>'Manage DefaultDict', 'url'=>array('admin')),
);
?>

<h1>Create DefaultDict</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>