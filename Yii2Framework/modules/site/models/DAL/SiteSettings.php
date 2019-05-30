<?php
namespace app\modules\site\models\DAL;
use Yii;
/**
 * This is the model class for table "site_settings".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property string $title
 * @property string $version
 * @property string $toz_1
 * @property string $toz_2
 * @property string $phone
 * @property string $contact
 * @property string $correspondence
 * @property string $enamad
 * @property string $samandehi
 * @property string $org_name
 * @property string $logo
 * @property string $favicon
 * @property string $terms_and_conditions
 * @property string $copy_right
 * @property int $reserve_time
 * @property int $default_gateway
 * @property string $mellat_terminal
 * @property string $mellat_username
 * @property string $mellat_password
 * @property string $irankish_merchant_id
 * @property string $irankish_sha1Key
 * @property string $zarinpal_merchant_id
 * @property int $email_send_admin
 * @property int $email_send_user
 * @property string $email_message_admin
 * @property string $email_message_user
 * @property int $sms_send_admin
 * @property int $sms_send_user
 * @property string $sms_message_admin
 * @property string $sms_message_user
 */
class SiteSettings extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'site_settings';
    }
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
            'id' => Yii::t('site', 'ID'),
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
}