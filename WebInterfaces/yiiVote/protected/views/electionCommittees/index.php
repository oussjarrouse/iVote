<?php
/* @var $this ElectionCommitteesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Election Committees',
);

$this->menu=array(
	array('label'=>'Create ElectionCommittees', 'url'=>array('create')),
	array('label'=>'Manage ElectionCommittees', 'url'=>array('admin')),
);
?>

<h1>Election Committees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
