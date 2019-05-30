<?php
namespace app\modules\coding\models\VML;
use Yii;
use yii\base\Model;
use app\config\components\functions;
use app\modules\coding\models\SRL\ReservationsSRL;
/**
 * @property-read int $days Days
 * @property-read int $discountVal Discount
 */
class ReservationsVML extends Model {
    public $id;
    public $id_p1;
    public $id_p2;
    public $id_p3;
    public $date1;
    public $date2;
    public $datetime1;
    public $ip;
    public $agent;
    public $name1;
    public $name2;
    public $name3;
    public $name4;
    public $name5;
    public $valint1  = 0;
    public $valint2  = 0;
    public $valint3  = 0;
    public $valint4  = 0;
    public $valint5  = 0;
    public $valint6  = 0;
    public $valint7  = 0;
    public $valint8  = 0;
    public $valint9  = 0;
    public $p1s      = [];
    public $p2s      = [];
    public $p3s      = [];
    public $room     = null;
    public $discount = null;
    private $_model;
    private $_rules;
    private $_labels;
    public function rules() {
        return $this->_rules;
    }
    public function attributeLabels() {
        return $this->_labels;
    }
    public function setRules($rules = []) {
        $this->_rules = $rules;
    }
    public function setLabels($labels = []) {
        $this->_labels = $labels;
    }
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
    public function validateIdCard() {
        for ($i = 0; $i < 10; $i++) {
            if (preg_match('/^' . $i . '{10}$/', $this->name1)) {
                $this->addError('name1', Yii::t('coding', 'National Code is not valid.'));
                return false;
            }
        }
        for ($i = 0, $sum = 0; $i < 9; $i++) {
            $sum += ((10 - $i) * intval(substr($this->name1, $i, 1)));
        }
        $ret    = $sum % 11;
        $parity = intval(substr($this->name1, 9, 1));
        if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity)) {
            return true;
        }
        $this->addError('name1', Yii::t('coding', 'National Code is not valid.'));
        return false;
    }
    public function validateRoom() {
        if ($this->hasErrors('date1') || $this->hasErrors('date2') || $this->hasErrors('valint1')) {
            return false;
        }
        $model = ReservationsSRL::getRooms($this->date1, $this->date2, $this->id_p2);
        if ($model === null) {
            $this->addError('id_p2', Yii::t('coding', 'No room was found.'));
            return false;
        }
        if ($model->valint4 < $model->valint3 + $this->valint1) {
            $this->addError('valint1', Yii::t('coding', 'Capacity is exceeded'));
            return false;
        }
        $this->room = $model;
        return true;
    }
    public function validateDiscount() {
        if ($this->id_p3) {
            if ($this->room === null || $this->hasErrors('id_p2') || $this->hasErrors('date1')) {
                return false;
            }
            $model = ReservationsSRL::getDiscounts($this->date1, $this->id_p2, $this->id_p3);
            if ($model === null) {
                $this->addError('id_p3', Yii::t('coding', 'No discount was found.'));
                return false;
            }
            $this->discount = $model;
        }
        return true;
    }
    public function getDiscountVal() {
        $discount = 0;
        if ($this->discount) {
            if ($this->discount->valint1 == 1) {
                $discount = $this->discount->valint2;
            }
            else if ($this->discount->valint1 == 2) {
                $discount = $this->valint4 / 100 * $this->discount->valint2;
            }
        }
        return $discount;
    }
    public function getDays() {
        return functions::datediffPlusOne($this->date1, $this->date2);
    }
}