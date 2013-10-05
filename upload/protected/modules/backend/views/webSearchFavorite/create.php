<div class="container-fluid hpadded">
<?php
/* @var $this WebSearchFavoriteController */
/* @var $model WebSearchFavorite */

$this->breadcrumbs=array(
	'Web Search Favorites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebSearchFavorite', 'url'=>array('index')),
	array('label'=>'Manage WebSearchFavorite', 'url'=>array('admin')),
);
?>

<h1>Create WebSearchFavorite</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>