<?php
namespace app\modules\site\models\VML;
use Yii;
use yii\base\Model;
class SiteSettingsVML extends Model {
    public $id;
    public $title;
    public $version;
    public $toz_1;
    public $toz_2;
    public $phone;
    public $contact;
    public $correspondence;
    public $enamad;
    public $samandehi;
    public $org_name;
    public $logo;
    public $favicon;
    public $terms_and_conditions;
    public $copy_right;
    public $reserve_time;
    public $default_gateway;
    public $mellat_terminal;
    public $mellat_username;
    public $mellat_password;
    public $irankish_merchant_id;
    public $irankish_sha1Key;
    public $zarinpal_merchant_id;
    public $email_send_admin;
    public $email_send_user;
    public $email_message_admin;
    public $email_message_user;
    public $sms_send_admin;
    public $sms_send_user;
    public $sms_message_admin;
    public $sms_message_user;
    public $irankish_merchants = [];
    public $zarinpal_merchants = [];
    private $_model;
    public function rules() {
        return [
                [['title', 'version', 'toz_1', 'toz_2', 'phone', 'contact', 'correspondence', 'enamad', 'samandehi', 'org_name', 'terms_and_conditions', 'copy_right', 'reserve_time', 'default_gateway', 'email_send_admin', 'email_send_user', 'sms_send_admin', 'sms_send_user'], 'required'],
                [['toz_1', 'toz_2', 'contact', 'correspondence', 'enamad', 'samandehi', 'terms_and_conditions', 'email_message_admin', 'email_message_user', 'sms_message_admin', 'sms_message_user'], 'string'],
                [['reserve_time', 'default_gateway', 'email_send_admin', 'email_send_user', 'sms_send_admin', 'sms_send_user'], 'integer'],
                [['title', 'version', 'phone', 'org_name', 'logo', 'favicon', 'copy_right', 'mellat_terminal', 'mellat_username', 'mellat_password', 'irankish_merchant_id', 'irankish_sha1Key', 'zarinpal_merchant_id'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'title' => Yii::t('site', 'Title'),
            'version' => Yii::t('site', 'Version'),
            'toz_1' => Yii::t('site', 'Toz 1'),
            'toz_2' => Yii::t('site', 'Toz 2'),
            'phone' => Yii::t('site', 'Phone'),
            'contact' => Yii::t('site', 'Contact'),
            'correspondence' => Yii::t('site', 'Correspondence'),
            'enamad' => Yii::t('site', 'Enamad'),
            'samandehi' => Yii::t('site', 'Samandehi'),
            'org_name' => Yii::t('site', 'Org Name'),
            'logo' => Yii::t('site', 'Logo'),
            'favicon' => Yii::t('site', 'Favicon'),
            'terms_and_conditions' => Yii::t('site', 'Terms And Conditions'),
            'copy_right' => Yii::t('site', 'Copy Right'),
            'reserve_time' => Yii::t('site', 'Reserve Time'),
            'default_gateway' => Yii::t('site', 'Default Gateway'),
            'mellat_terminal' => Yii::t('site', 'Mellat Terminal'),
            'mellat_username' => Yii::t('site', 'Mellat Username'),
            'mellat_password' => Yii::t('site', 'Mellat Password'),
            'irankish_merchant_id' => Yii::t('site', 'Irankish Merchant ID'),
            'irankish_sha1Key' => Yii::t('site', 'Irankish Sha1 Key'),
            'zarinpal_merchant_id' => Yii::t('site', 'Zarinpal Merchant ID'),
            'email_send_admin' => Yii::t('site', 'Email Send Admin'),
            'email_send_user' => Yii::t('site', 'Email Send User'),
            'email_message_admin' => Yii::t('site', 'Email Message Admin'),
            'email_message_user' => Yii::t('site', 'Email Message User'),
            'sms_send_admin' => Yii::t('site', 'Sms Send Admin'),
            'sms_send_user' => Yii::t('site', 'Sms Send User'),
            'sms_message_admin' => Yii::t('site', 'Sms Message Admin'),
            'sms_message_user' => Yii::t('site', 'Sms Message User'),
        ];
    }
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}