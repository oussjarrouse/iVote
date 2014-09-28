<?php
/* @var $this ElectionCommitteesController */
/* @var $model ElectionCommittees */

$this->breadcrumbs=array(
	'Election Committees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ElectionCommittees', 'url'=>array('index')),
	array('label'=>'Manage ElectionCommittees', 'url'=>array('admin')),
);
?>

<h1>Create ElectionCommittees</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>