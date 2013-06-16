<div class="container-fluid hpadded">
<?php
/* @var $this WebUserController */
/* @var $model WebUser */

$this->breadcrumbs=array(
	'Web Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebUser', 'url'=>array('index')),
	array('label'=>'Create WebUser', 'url'=>array('create')),
	array('label'=>'View WebUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebUser', 'url'=>array('admin')),
);
?>

<h1>更新账户信息</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>