<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\coding\models\VML\TcodingVML */
/* @var $idnoe int */
/* @var $title string */
/* @var $title2 string */
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index', 'idnoe' => $idnoe]];
$this->params['breadcrumbs'][] = ['label' => $title2, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tcoding-update box">
    <div class="box-header"><?= Yii::t('app', 'Update') ?></div>
    <?= $this->render('_form', [
        'model' => $model,
        'idnoe' => $idnoe,
    ]) ?>
</div>