<div class="container-fluid hpadded">
<?php
/* @var $this WebSearchFavoriteController */
/* @var $model WebSearchFavorite */

$this->breadcrumbs=array(
	'Web Search Favorites'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebSearchFavorite', 'url'=>array('index')),
	array('label'=>'Create WebSearchFavorite', 'url'=>array('create')),
	array('label'=>'View WebSearchFavorite', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebSearchFavorite', 'url'=>array('admin')),
);
?>

<h1>更新</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>