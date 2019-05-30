<?php
namespace app\modules\users\models\VML;
use Yii;
use yii\base\Model;
class UsersVML extends Model {
    public $id;
    public $email;
    public $mobile;
    public $fname;
    public $lname;
    public $old_password;
    public $new_password;
    public $new_password_repeat;
    public $roles = [];
    public $_roles = [];
    private $_model;
    public function rules() {
        return [
            [['old_password', 'new_password', 'new_password_repeat'], 'required', 'on' => ['change-password']],
            [['old_password', 'new_password', 'new_password_repeat'], 'string', 'max' => 255],

            [['mobile', 'fname', 'lname'], 'string', 'max' => 255],
            [['mobile', 'fname', 'lname'], 'required', 'on' => ['create', 'update', 'update-profile']],

            [['roles'], 'each', 'rule' => ['safe']],
            [['email'], 'email'],
        ];
    }
    public function attributeLabels() {
        return [
            'old_password'        => Yii::t('users', 'Old Password'),
            'new_password'        => Yii::t('users', 'New Password'),
            'new_password_repeat' => Yii::t('users', 'New Password Repeat'),
            'email'               => Yii::t('users', 'Email'),
            'mobile'              => Yii::t('users', 'Mobile'),
            'fname'               => Yii::t('users', 'Fname'),
            'lname'               => Yii::t('users', 'Lname'),
            'roles'               => Yii::t('users', 'Permissions'),
        ];
    }
    public function setModel($model) {
        $this->_model = $model;
    }
    public function getModel() {
        return $this->_model;
    }
}