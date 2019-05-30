<?php
use app\config\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model \app\modules\coding\models\DAL\Reservations */
/* @var $columns array */
/* @var $title string */
/* @var $title2 string */
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index', 'idp1' => $model->id_p1]];
$this->params['breadcrumbs'][] = $title2;
?>
<div class="reservations-view box">
    <div class="box-header"><?= $title2 ?></div>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model'      => $model,
            'attributes' => $columns,
        ]) ?>
    </div>
</div>