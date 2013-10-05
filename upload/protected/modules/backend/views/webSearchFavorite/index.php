<div class="container-fluid hpadded">
<?php
/* @var $this WebSearchFavoriteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Web Search Favorites',
);

$this->menu=array(
	array('label'=>'Create WebSearchFavorite', 'url'=>array('create')),
	array('label'=>'Manage WebSearchFavorite', 'url'=>array('admin')),
);
?>

<h1>搜索记录收藏</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

</div>