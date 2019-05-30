<?php
namespace app\modules\coding\models\VML;
use Yii;
use yii\base\Model;
class ReservationsSearchVML extends Model {
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
    public $valint1;
    public $valint2;
    public $valint3;
    public $valint4;
    public $valint5;
    public $valint6;
    public $valint7;
    public $valint8;
    public $valint9;
    public function rules() {
        return [
                [['id', 'id_p1', 'id_p2', 'id_p3', 'valint1', 'valint2', 'valint3', 'valint4', 'valint5', 'valint6', 'valint7', 'valint8', 'valint9'], 'integer'],
                [['date1', 'date2', 'datetime1'], 'safe'],
                [['ip', 'agent', 'name1', 'name2', 'name3', 'name4', 'name5'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
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
        ];
    }
}