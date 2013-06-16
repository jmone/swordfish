<div class="container-fluid hpadded">
<?php
/* @var $this WebStopWordController */
/* @var $model WebStopWord */

$this->breadcrumbs=array(
	'Web Stop Words'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebStopWord', 'url'=>array('index')),
	array('label'=>'Create WebStopWord', 'url'=>array('create')),
	array('label'=>'View WebStopWord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebStopWord', 'url'=>array('admin')),
);
?>

<h1>更新停止词</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>