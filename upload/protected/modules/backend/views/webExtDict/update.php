<div class="container-fluid hpadded">
<?php
/* @var $this WebExtDictController */
/* @var $model WebExtDict */

$this->breadcrumbs=array(
	'Web Ext Dicts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebExtDict', 'url'=>array('index')),
	array('label'=>'Create WebExtDict', 'url'=>array('create')),
	array('label'=>'View WebExtDict', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebExtDict', 'url'=>array('admin')),
);
?>

<h1>更新扩展词</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>