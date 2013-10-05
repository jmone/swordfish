<div class="container-fluid hpadded">
<?php
/* @var $this WebExtDictController */
/* @var $model WebExtDict */

$this->breadcrumbs=array(
	'Web Ext Dicts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebExtDict', 'url'=>array('index')),
	array('label'=>'Manage WebExtDict', 'url'=>array('admin')),
);
?>

<h1>添加扩展词</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>