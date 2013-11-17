<div class="container-fluid hpadded">
<?php
/* @var $this WebCategoryMappingController */
/* @var $model CategoryMapping */

$this->breadcrumbs=array(
	'Category Mappings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CategoryMapping', 'url'=>array('index')),
	array('label'=>'Create CategoryMapping', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-mapping-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>分类映射管理</h3>

<?php echo CHtml::link('高级搜索','#',array('class'=>'btn search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-mapping-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'category_id',
		'site_id',
		'site_category_id',
		'site_url',
		'name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
