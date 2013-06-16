<div class="container-fluid hpadded">
<?php
/* @var $this WebSearchFavoriteController */
/* @var $model WebSearchFavorite */

$this->breadcrumbs=array(
	'Web Search Favorites'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebSearchFavorite', 'url'=>array('index')),
	array('label'=>'Create WebSearchFavorite', 'url'=>array('create')),
	array('label'=>'Update WebSearchFavorite', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebSearchFavorite', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebSearchFavorite', 'url'=>array('admin')),
);
?>

<h1>浏览</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'text',
		'dateline',
	),
)); ?>

</div>