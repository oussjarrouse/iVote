<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <?php echo Yii::app()->name; ?></h1>

<!--  -->

<p>
<?php echo CHtml::link('Election Committees',array('ElectionCommittees/index')); ?>
</p>