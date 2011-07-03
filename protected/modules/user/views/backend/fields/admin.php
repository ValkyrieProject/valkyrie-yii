<?php
$this->breadcrumbs=array(
    Yii::t("UserModule.user", 'Profile fields')=>array('admin'),
    Yii::t("UserModule.user", 'Manage'));

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'position',
        'varname',
        array(
            'name'=>'title',
            'value'=>'Yii::t("UserModule.user", $data->title)',
        ),
        'field_type',
        'field_size',
        //'field_size_min',
        array(
            'name'=>'required',
            'value'=>'ProfileField::itemAlias("required",$data->required)',
        ),
        //'match',
        //'range',
        //'error_message',
        'other_validator',
        //'default',
        array(
            'name'=>'visible',
            'value'=>'ProfileField::itemAlias("visible",$data->visible)',
        ),
        //*/
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>