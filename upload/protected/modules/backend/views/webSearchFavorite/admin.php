<div class="container-fluid hpadded">
<?php
/* @var $this WebSearchFavoriteController */
/* @var $model WebSearchFavorite */

$this->breadcrumbs=array(
	'Web Search Favorites'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List WebSearchFavorite', 'url'=>array('index')),
	array('label'=>'Create WebSearchFavorite', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#web-search-favorite-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>搜索记录收藏</h1>

<p>支持 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) 等符号搜索。</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'web-search-favorite-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'text',
		'dateline',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>