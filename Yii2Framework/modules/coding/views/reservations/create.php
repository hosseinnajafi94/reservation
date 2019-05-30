<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form \app\config\widgets\ActiveForm */
/* @var $model \app\modules\coding\models\VML\ReservationsVML */
/* @var $title string */
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['index', 'idp1' => 2]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>
<div class="reservations-create box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-header"><?= $title . ' / ' . Yii::t('app', 'Create') ?></div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'date1')->textInput(['maxlength' => true, 'dir' => 'ltr', 'class' => 'form-control datePicker text-center']) ?>
            <?= $form->field($model, 'date2')->textInput(['maxlength' => true, 'dir' => 'ltr', 'class' => 'form-control datePicker text-center']) ?>
            <?= $form->field($model, 'id_p2')->dropDownList($model->p2s) ?>
            <?= $form->field($model, 'id_p3')->dropDownList($model->p3s) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'name2')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name3')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name4')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
            <?= $form->field($model, 'name5')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'name1')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
            <?= $form->field($model, 'valint1')->textInput(['dir' => 'ltr', 'class' => 'form-control number']) ?>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::a(Yii::t('app', 'Return'), ['index', 'idp1' => 2], ['class' => 'btn btn-sm btn-warning']) ?>
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs("
$('#reservationsvml-id_p2').on('change', function () {
    var id = $('#reservationsvml-id_p2').val();
    var date1 = $('#reservationsvml-date1').val();
    $('#reservationsvml-id_p3').html('<option value=\"\">لطفا انتخاب کنید</option>');
    if (id && date1) {
        ajaxpost('" . Url::to(['discounts']) . "', {id, date1}, function (result) {
            var isValid = validResult(result);
            if (!isValid) {
                return false;
            }
            var options = '<option value=\"\">لطفا انتخاب کنید</option>';
            $.each(result.list, function (id, name1) {
                options += '<option value=\"' + id + '\">' + name1 + '</option>';
            });
            $('#reservationsvml-id_p3').html(options);
        });
    }
});
$('#reservationsvml-date1, #reservationsvml-date2').on('textchange', function () {
    var date1 = $('#reservationsvml-date1').val();
    var date2 = $('#reservationsvml-date2').val();
    $('#reservationsvml-id_p2').html('<option value=\"\">لطفا انتخاب کنید</option>');
    $('#reservationsvml-id_p3').html('<option value=\"\">لطفا انتخاب کنید</option>');
    if (date1 && date2) {
        ajaxpost('" . Url::to(['rooms']) . "', {date1, date2}, function (result) {
            var isValid = validResult(result);
            if (!isValid) {
                return false;
            }
            var options = '<option value=\"\">لطفا انتخاب کنید</option>';
            $.each(result.list, function (id, name1) {
                options += '<option value=\"' + id + '\">' + name1 + '</option>';
            });
            $('#reservationsvml-id_p2').html(options);
        });
    }
})" . ($model->id_p2 ? "" : ".trigger('textchange')") . ";
");
?>