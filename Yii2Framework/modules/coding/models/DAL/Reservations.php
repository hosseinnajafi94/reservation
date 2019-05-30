<?php
namespace app\modules\coding\models\DAL;
use Yii;
use app\config\components\functions;
/**
 * This is the model class for table "reservations".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id شناسه رزرو
 * @property int $id_p1 نوع رزرو
 * @property int $id_p2 اتاق
 * @property int $id_p3 تخفیف
 * @property string $date1 تاریخ ورود
 * @property string $date2 تاریخ خروج
 * @property string $datetime1 زمان غیرفعال شدن رزرو
 * @property string $ip آی پی کاربر
 * @property string $agent مرورگر کاربر
 * @property string $name1 کدملی
 * @property string $name2 نام
 * @property string $name3 نام خانوادگی
 * @property string $name4 شماره تلفن همراه
 * @property string $name5 پست الکترونیک
 * @property int $valint1 تعداد همراهان
 * @property int $valint2 هزینه اتاق
 * @property int $valint3 هزینه همراهان
 * @property int $valint4 جمع کل
 * @property int $valint5 مبلغ تخفیف
 * @property int $valint6 جمع کل با احتساب تخفیف
 * @property int $valint7 مالیات
 * @property int $valint8 عوارض
 * @property int $valint9 مبلغ قابل پرداخت
 * @property int $gateway
 * @property string $mellat_ref_id
 * @property string $mellat_res_code
 * @property string $mellat_sale_order_id
 * @property string $mellat_reference_id
 * @property string $irankish_token
 * @property string $irankish_result_code
 * @property string $irankish_reference_id
 * @property string $zarinpal_authority
 * @property string $zarinpal_ref_id
 *
 * @property Tcoding $p1
 * @property Tcoding $p2
 * @property Tcoding $p3
 */
class Reservations extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'reservations';
    }
    public function rules() {
        return [
                [['id_p1', 'id_p2', 'date1', 'date2', 'ip', 'agent'], 'required'],
                [['id_p1', 'id_p2', 'id_p3', 'valint1', 'valint2', 'valint3', 'valint4', 'valint5', 'valint6', 'valint7', 'valint8', 'valint9', 'gateway'], 'integer'],
                [['date1', 'date2', 'datetime1'], 'safe'],
                [['ip', 'agent', 'name1', 'name2', 'name3', 'name4', 'name5', 'mellat_ref_id', 'mellat_res_code', 'mellat_sale_order_id', 'mellat_reference_id', 'irankish_token', 'irankish_result_code', 'irankish_reference_id', 'zarinpal_authority', 'zarinpal_ref_id'], 'string', 'max' => 255],
                [['id_p1'], 'exist', 'skipOnError' => true, 'targetClass' => Tcoding::className(), 'targetAttribute' => ['id_p1' => 'id']],
                [['id_p2'], 'exist', 'skipOnError' => true, 'targetClass' => Tcoding::className(), 'targetAttribute' => ['id_p2' => 'id']],
                [['id_p3'], 'exist', 'skipOnError' => true, 'targetClass' => Tcoding::className(), 'targetAttribute' => ['id_p3' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('coding', 'ID'),
            'id_p1' => Yii::t('coding', 'Id P1'),
            'id_p2' => Yii::t('coding', 'Id P2'),
            'id_p3' => Yii::t('coding', 'Id P3'),
            'date1' => Yii::t('coding', 'Date1'),
            'date2' => Yii::t('coding', 'Date2'),
            'datetime1' => Yii::t('coding', 'Datetime1'),
            'ip' => Yii::t('coding', 'Ip'),
            'agent' => Yii::t('coding', 'Agent'),
            'name1' => Yii::t('coding', 'Name1'),
            'name2' => Yii::t('coding', 'Name2'),
            'name3' => Yii::t('coding', 'Name3'),
            'name4' => Yii::t('coding', 'Name4'),
            'name5' => Yii::t('coding', 'Name5'),
            'valint1' => Yii::t('coding', 'Valint1'),
            'valint2' => Yii::t('coding', 'Valint2'),
            'valint3' => Yii::t('coding', 'Valint3'),
            'valint4' => Yii::t('coding', 'Valint4'),
            'valint5' => Yii::t('coding', 'Valint5'),
            'valint6' => Yii::t('coding', 'Valint6'),
            'valint7' => Yii::t('coding', 'Valint7'),
            'valint8' => Yii::t('coding', 'Valint8'),
            'valint9' => Yii::t('coding', 'Valint9'),
            'gateway' => Yii::t('coding', 'Gateway'),
            'mellat_ref_id' => Yii::t('coding', 'Mellat Ref ID'),
            'mellat_res_code' => Yii::t('coding', 'Mellat Res Code'),
            'mellat_sale_order_id' => Yii::t('coding', 'Mellat Sale Order ID'),
            'mellat_reference_id' => Yii::t('coding', 'Mellat Reference ID'),
            'irankish_token' => Yii::t('coding', 'Irankish Token'),
            'irankish_result_code' => Yii::t('coding', 'Irankish Result Code'),
            'irankish_reference_id' => Yii::t('coding', 'Irankish Reference ID'),
            'zarinpal_authority' => Yii::t('coding', 'Zarinpal Authority'),
            'zarinpal_ref_id' => Yii::t('coding', 'Zarinpal Ref ID'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP1() {
        return $this->hasOne(Tcoding::className(), ['id' => 'id_p1']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP2() {
        return $this->hasOne(Tcoding::className(), ['id' => 'id_p2']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP3() {
        return $this->hasOne(Tcoding::className(), ['id' => 'id_p3']);
    }
    public function getDays() {
        return functions::datediffPlusOne($this->date1, $this->date2);
    }
}