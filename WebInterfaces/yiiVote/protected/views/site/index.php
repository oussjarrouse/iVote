<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<!-- 
<h1>Welcome to <?php //echo Yii::app()->name; ?></h1>
 -->
<!--  -->
<div id="Notifications">
	<h1>Notifications</h1>
</div>
<div id="Organize">
	<h1>Organize</h1>
	<p>
		<?php echo CHtml::link('Election Committees',array('ElectionCommittees/index')); ?>
	</p>
</div>
<div id="Participate">
	<h1>Participate</h1>
</div>