<?php
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form \app\config\widgets\ActiveForm */
/* @var $model \app\modules\users\models\VML\LoginVML */
$fieldOptionsMobile = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<i class='glyphicon glyphicon-phone form-control-feedback'></i>",
];
$fieldOptionsPassword = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<i class='glyphicon glyphicon-lock form-control-feedback'></i>",
];
$this->title = Yii::t('users', 'Login');
?>
<div class="site-auth-login">
    <?php $form = ActiveForm::begin(['enableClientValidation' => false]) ?>
    <?= $form->field($model, 'mobile', $fieldOptionsMobile)->label(false)->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('mobile')]) ?>
    <?= $form->field($model, 'password', $fieldOptionsPassword)->label(false)->passwordInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('password')]) ?>
    <?= $form->field($model, 'captcha')->label(false)->captcha(['placeholder' => $model->getAttributeLabel('captcha')]) ?>
    <label><?= $form->field($model, 'rememberMe')->checkbox() ?></label>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('users', 'Login'), ['class' => 'btn btn-lg btn-default btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <p style="position: relative;top: 60px;"><?= Html::a(Yii::t('users', 'صفحه اصلی'), ['/']) ?></p>
</div>