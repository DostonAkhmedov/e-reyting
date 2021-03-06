<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Student', 'url'=>array('index')),
	array('label'=>'Create Student', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#student-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Students</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>[
	      'name'=>'id',
		'htmlOptions'=>['width'=>30],
         ],
		'name',
		'group_id'=>[
			'name'=>'group_id',
			'value'=>'$data->group->name',
			'filter'=>Group::getGroup(),
		],
		'subject_id'=>[
			'name'=>'subject_id',
			'value'=>'$data->subject->name',
			'filter'=>Subject::getSubjects(),
		],
		'type_of_control_id'=>[
			'name'=>'type_of_control_id',
			'value'=>'$data->typeOfControl->name',
			'filter'=>TypeOfControl::getTypeOfControl(),

		],
		'ball',
		/*
		'total_ball',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
