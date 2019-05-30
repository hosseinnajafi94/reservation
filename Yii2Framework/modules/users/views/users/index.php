<?php
use yii\helpers\Html;
use app\config\widgets\GridView;
/* @var $this \yii\web\View */
/* @var $model \yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = Yii::t('users', 'Users');
?>
<div class="users-index box">
    <div class="box-header"><?= Yii::t('users', 'Users') ?></div>
    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $model,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'fname',
                'lname',
                'mobile',
                'email',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]) ?>
    </div>
</div>