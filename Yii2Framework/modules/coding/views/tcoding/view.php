<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\config\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model \app\modules\coding\models\DAL\Tcoding */
/* @var $columns array */
/* @var $title string */
/* @var $title2 string */
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index', 'idnoe' => $model->id_noe]];
$this->params['breadcrumbs'][] = $title2;
?>
<div class="tcoding-view box">
    <div class="box-header"><?= $title2 ?></div>
    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create', 'idnoe' => $model->id_noe], ['class' => 'btn btn-sm btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], ['class' => 'btn btn-sm btn-danger', 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method' => 'post']]) ?>
    </p>
    <div class="table-responsive">
        <?=
        DetailView::widget([
            'model'      => $model,
            'attributes' => $columns,
        ])
        ?>
    </div>
</div>
<?php
if ($model->id_noe === 2) {
    $this->registerCss("
        [data-image] {position: relative;display: inline-block;}
        [data-image] .close {position: absolute;top: 0;left: 0;background: black;z-index: 1;opacity: 1;padding: 5px;color: #FFF;}
        [data-image] .close:hover {background: royalblue;}
    ");
    $this->registerJs("
        $('[data-image]').click(function (e) {
            var that = $(this);
            var id = $(this).data('image');
            if ($(e.target).is('.close')) {
                e.preventDefault();
                showConfirm('" . Yii::t('app', 'Are you sure you want to delete this item?') . "', function () {
                    ajaxpost('" . Url::to(['/coding/tcoding/delete-image']) . "', {id}, function (result) {
                        var isValid = validResult(result);
                        if (!isValid) {
                            return false;
                        }
                        that.remove();
                    });
                });
            }
        });
    ");
}
?>