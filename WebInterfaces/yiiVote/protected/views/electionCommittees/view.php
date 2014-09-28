<?php
/* @var $this ElectionCommitteesController */
/* @var $model ElectionCommittees */

$this->breadcrumbs=array(
	'Election Committees'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ElectionCommittees', 'url'=>array('index')),
	array('label'=>'Create ElectionCommittees', 'url'=>array('create')),
	array('label'=>'Update ElectionCommittees', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ElectionCommittees', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ElectionCommittees', 'url'=>array('admin')),
);
?>

<h1>View ElectionCommittees #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'status',
		'users_id',
	),
)); ?>
