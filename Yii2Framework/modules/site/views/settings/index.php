<?php
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\site\models\DAL\SiteSettings */
$this->params['breadcrumbs'][] = Yii::t('site', 'Site Settings');
?>
<div class="site-settings-index box">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-header"><?= Yii::t('site', 'Site Settings') ?></div>
    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']) ?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab0" data-toggle="tab">تنظیمات سایت</a></li>
        <li><a href="#tab1" data-toggle="tab">پا برگه</a></li>
        <li><a href="#tab2" data-toggle="tab">توضیحات صفحه اصلی</a></li>
        <li><a href="#tab3" data-toggle="tab">قوانین و مقررات</a></li>
        <li><a href="#tab4" data-toggle="tab">درگاه پرداخت</a></li>
        <li><a href="#tab5" data-toggle="tab">پیامک / ایمیل</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab0" class="tab-pane active">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'logo')->fileInput() ?>
                    <?= $form->field($model, 'favicon')->fileInput()->hint('سایز تصویر 16 پیکسل در 16 پیکسل') ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'reserve_time')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                </div>
            </div>
        </div>
        <div id="tab1" class="tab-pane">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'contact')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'correspondence')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'copy_right')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'enamad')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'samandehi')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div id="tab2" class="tab-pane">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'toz_1')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'toz_2')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div id="tab3" class="tab-pane">
            <?= $form->field($model, 'terms_and_conditions')->textarea(['rows' => 20]) ?>
        </div>
        <div id="tab4" class="tab-pane">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'default_gateway')->dropDownList([1 => 'ملت', 2 => 'ایران کیش', 3 => 'زرین پال']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">ملت</div>
                        <div class="panel-body">
                            <?= $form->field($model, 'mellat_terminal')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                            <?= $form->field($model, 'mellat_username')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                            <?= $form->field($model, 'mellat_password')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">ایران کیش</div>
                        <div class="panel-body">
                            <?= $form->field($model, 'irankish_merchant_id')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                            <?= $form->field($model, 'irankish_sha1Key')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">زرین پال</div>
                        <div class="panel-body">
                            <?= $form->field($model, 'zarinpal_merchant_id')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab5" class="tab-pane">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'sms_send_admin')->checkbox() ?>
                    <?= $form->field($model, 'sms_send_user')->checkbox() ?>
                    <?= $form->field($model, 'sms_message_admin')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'sms_message_user')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'email_send_admin')->checkbox() ?>
                    <?= $form->field($model, 'email_send_user')->checkbox() ?>
                    <?= $form->field($model, 'email_message_admin')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'email_message_user')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="alert alert-info">
                <p><label>[fname]</label>: نام مسافر</p>
                <p><label>[lname]</label>: نام خانوادگی مسافر</p>
                <p><label>[mobile]</label>: شماره تلفن همراه مسافر</p>
                <p><label>[idcard]</label>: کد ملی مسافر</p>
                <p><label>[id]</label>: شماره پیگیری</p>
                <p><label>[date1]</label>: تاریخ ورود</p>
                <p><label>[date2]</label>: تاریخ خروج</p>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerCss('label > input[type="checkbox"] {visibility: visible;top: 3px;}');
$this->registerJs("
var lastFocus = null;
$('#sitesettings-email_message_admin, #sitesettings-email_message_user, #sitesettings-sms_message_admin, #sitesettings-sms_message_user').focus(function () {
    lastFocus = $(this);
});
$('.alert-info label').click(function () {
    var text = $(this).text();
    if (lastFocus) {
        var val = lastFocus.val();
        lastFocus.val(val + text);
    }
});
");
