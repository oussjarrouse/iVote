<?php
/* @var $this ElectionCommitteesController */
/* @var $model ElectionCommittees */

$this->breadcrumbs=array(
	'Election Committees'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ElectionCommittees', 'url'=>array('index')),
	array('label'=>'Create ElectionCommittees', 'url'=>array('create')),
	array('label'=>'View ElectionCommittees', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ElectionCommittees', 'url'=>array('admin')),
);
?>

<h1>Update ElectionCommittees <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>