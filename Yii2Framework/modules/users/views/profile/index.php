<?php
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this \yii\web\View */
/* @var $model \app\modules\users\models\DAL\Users */
$this->params['breadcrumbs'][] = Yii::t('users', 'Profile');
?>
<div class="profile-index box">
    <div class="box-header"><?= Yii::t('users', 'Profile') ?></div>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update'], ['class' => 'btn btn-sm btn-default']) ?>
        <?= Html::a(Yii::t('users', 'Change Password'), ['password'], ['class' => 'btn btn-sm btn-default']) ?>
    </p>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model'      => $model,
            'attributes' => [
                'fname',
                'lname',
                'email',
                'mobile',
            ],
        ]) ?>
    </div>
</div>