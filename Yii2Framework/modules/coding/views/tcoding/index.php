<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $columns array */
/* @var $title string */
/* @var $idnoe int */
$this->params['breadcrumbs'][] = $title;
?>
<div class="tcoding-index box">
    <div class="box-header"><?= $title ?></div>
    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create', 'idnoe' => $idnoe], ['class' => 'btn btn-sm btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => array_merge([
                ['class' => 'yii\grid\SerialColumn'],
            ], $columns, [
                ['class' => 'yii\grid\ActionColumn'],
            ])
        ]) ?>
    </div>
</div>