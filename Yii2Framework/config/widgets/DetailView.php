<?php
namespace app\config\widgets;
class DetailView extends \yii\widgets\DetailView {
    public function init() {
        $this->formatter = new Formatter();
        parent::init();
    }
}