<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Html;
$this->title = $name;
?>
<div class="container" style="margin-top: 30px;">
    <div class="site-error">
        <div class="alert alert-danger">
            <?= nl2br(Html::encode(Yii::t('app', $message))) ?>
        </div>
    </div>
</div>