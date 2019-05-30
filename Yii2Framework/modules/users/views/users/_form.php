<?php
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form \app\config\widgets\ActiveForm */
/* @var $model \app\modules\users\models\VML\UsersVML */
$this->registerCss('
    .checkbox label {padding: 0;}
    .checkbox input[type="checkbox"] {visibility: visible;position: relative;top: 4px;margin: 0;}
');

?>
<div class="users-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'roles')->checkboxList($model->_roles) ?>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Return'), ['index'], ['class' => 'btn btn-sm btn-warning']) ?>
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>