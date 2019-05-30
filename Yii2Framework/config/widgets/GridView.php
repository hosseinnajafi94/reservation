<?php
namespace app\config\widgets;
class GridView extends \yii\grid\GridView {
    public $dataColumnClass = 'app\config\widgets\DataColumn';
    public $filterPosition = self::FILTER_POS_HEADER;
    public function init() {
        $this->formatter = new Formatter();
        parent::init();
    }
}