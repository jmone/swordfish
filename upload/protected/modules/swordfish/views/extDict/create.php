<?php
/* @var $this ExtDictController */
/* @var $model ExtDict */

$this->breadcrumbs=array(
	'Ext Dicts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExtDict', 'url'=>array('index')),
	array('label'=>'Manage ExtDict', 'url'=>array('admin')),
);
?>

<h1>Create ExtDict</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>