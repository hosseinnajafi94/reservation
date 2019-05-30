<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\users\models\VML\UsersVML */
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fname . ' ' . $model->lname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="users-update box">
    <div class="box-header"><?= Yii::t('app', 'Update') ?></div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>