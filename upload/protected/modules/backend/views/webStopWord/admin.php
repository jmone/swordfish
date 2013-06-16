<div class="container-fluid hpadded">
<?php
/* @var $this WebStopWordController */
/* @var $model WebStopWord */

$this->breadcrumbs=array(
	'Web Stop Words'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List WebStopWord', 'url'=>array('index')),
	array('label'=>'Create WebStopWord', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#web-stop-word-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>停止词管理</h1>

<p>停止词，即：几乎每篇文章都有，却又无意义的词，如：的、是、没有...</p>
<p>支持 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) 等符号搜索。</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'web-stop-word-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'word',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>