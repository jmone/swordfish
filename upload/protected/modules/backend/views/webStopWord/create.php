<div class="container-fluid hpadded">
<?php
/* @var $this WebStopWordController */
/* @var $model WebStopWord */

$this->breadcrumbs=array(
	'Web Stop Words'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebStopWord', 'url'=>array('index')),
	array('label'=>'Manage WebStopWord', 'url'=>array('admin')),
);
?>

<h1>添加停止词</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>