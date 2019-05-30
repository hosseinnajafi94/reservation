<?php
namespace app\modules\users\models\VML;
use Yii;
use yii\base\Model;
class LoginVML extends Model {
    public $mobile;
    /**
     * @var string Password
     */
    public $password;
    /**
     * @var captcha Captcha
     */
    public $captcha;
    /**
     * @var bool Remember Me
     */
    public $rememberMe = true;
    public function rules() {
        return [
                [['mobile', 'password'], 'required'],
                [['password', 'mobile'], 'string', 'max' => 255],
                [['captcha'], 'captcha', 'captchaAction' => '/users/auth/captcha'],
                [['rememberMe'], 'boolean'],
        ];
    }
    public function attributeLabels() {
        return [
            'mobile' => Yii::t('users', 'Mobile'),
            'password' => Yii::t('users', 'Password'),
            'captcha' => Yii::t('users', 'Captcha'),
            'rememberMe' => Yii::t('users', 'Remember Me'),
        ];
    }
}