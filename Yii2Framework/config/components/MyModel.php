<?php
namespace app\config\components;
use yii\base\DynamicModel;
use yii\validators\Validator;
class MyModel extends DynamicModel {
    public $models = [];
    public $dropdowns = [];
    public $booleans = [];
    public $labels = [];
    public $formAttributes;
    public function attributeLabels() {
        return $this->labels;
    }
    public function defineAttribute($name, $label = null, $value = null) {
        if ($label) {
            $this->labels[$name] = $label;
        }
        parent::defineAttribute($name, $value);
    }
    public function isDropdown($attribute) {
        return isset($this->dropdowns[$attribute]);
    }
    public function isBoolean($attribute) {
        return isset($this->booleans[$attribute]);
    }
    public function addRule($attributes, $validator, $options = []) {
        if ($validator == 'exist') {
            $this->dropdowns[$attributes] = [];
        }
        if ($validator == 'boolean') {
            $this->booleans[$attributes] = true;
        }
        $validators = $this->getValidators();
        $validators->append(Validator::createValidator($validator, $this, (array) $attributes, $options));
        return $this;
    }
}
//$model->defineAttribute('name1', 'نام', $data->name1);
//$model->addRule('name1', 'string', [
//    'min' => 5,
//    'tooShort' => 'نام حداقل باید شامل 5 کاراکتر باشد',
//    'max' => 255,
//    'tooLong' => 'نام حداکثر باید شامل 255 کاراکتر باشد',
//]);
//$model->addRule('name1', 'required', [
//    'message' => 'نام نمی تواند خالی باشد',
//    'when' => function ($model, $attribute) {
//
//    },
//    'whenClient' => 'function () { return true; }',
//]);
//$model->addRule('name1', 'file', ['maxSize' => 1024 * 5000, 'extensions' => 'png, jpg']);
//$model->addRule('name1', 'email', ['message' => $attribute->title . ' یک آدرس ایمیل معتبر نیست.']);
//$model->addRule('name1', 'integer');
//$model->addRule('name1', 'exist', ['targetClass' => GeoProvinces::className(), 'targetAttribute' => [$name => 'id']]);