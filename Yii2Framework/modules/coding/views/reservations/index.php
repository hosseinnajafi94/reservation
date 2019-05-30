<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\config\widgets\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $columns array */
/* @var $title string */
/* @var $idp1 int */
$this->params['breadcrumbs'][] = $title;
?>
<div class="reservations-index box">
    <div class="box-header"><?= $title ?></div>
    <?php
    if ($idp1 == 2) {
        ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
        </p>
        <?php
    }
    ?>
    <div class="table-responsive">
        <?php Pjax::begin() ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns'      => $columns,
        ]) ?>
        <?php Pjax::end() ?>
    </div>
</div>