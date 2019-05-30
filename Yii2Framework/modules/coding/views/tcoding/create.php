<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\coding\models\VML\TcodingVML */
/* @var $title string */
/* @var $idnoe int */
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index', 'idnoe' => $idnoe]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="tcoding-create box">
    <div class="box-header"><?= Yii::t('app', 'Create') ?></div>
    <?= $this->render('_form', [
        'model' => $model,
        'idnoe' => $idnoe,
    ]) ?>
</div>