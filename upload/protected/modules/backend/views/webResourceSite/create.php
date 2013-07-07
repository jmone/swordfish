<div class="container-fluid hpadded">
<?php
/* @var $this WebResourceSiteController */
/* @var $model ResourceSite */

$this->breadcrumbs=array(
	'Resource Sites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResourceSite', 'url'=>array('index')),
	array('label'=>'Manage ResourceSite', 'url'=>array('admin')),
);
?>

<h1>Create ResourceSite</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>