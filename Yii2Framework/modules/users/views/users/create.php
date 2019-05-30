<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\users\models\VML\UsersVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="users-create box">
    <div class="box-header"><?= Yii::t('app', 'Create') ?></div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>