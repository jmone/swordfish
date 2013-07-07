<?php
/* @var $this WebResourceSiteController */
/* @var $model ResourceSite */

$this->breadcrumbs=array(
	'Resource Sites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResourceSite', 'url'=>array('index')),
	array('label'=>'Create ResourceSite', 'url'=>array('create')),
	array('label'=>'View ResourceSite', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ResourceSite', 'url'=>array('admin')),
);
?>

<h1>Update ResourceSite <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>