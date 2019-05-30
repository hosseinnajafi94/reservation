<?php
namespace app\modules\users\components;
class TcodingRule extends \yii\rbac\Rule {
    public $name = 'TcodingRule';
    /**
     * @param string|int $user the user ID.
     * @param \yii\rbac\Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params) {
        return isset($params['idnoe']) && (
            ($params['idnoe'] == 1 && $item->name == 'RoomTypes') ||
            ($params['idnoe'] == 2 && $item->name == 'Rooms')     ||
            ($params['idnoe'] == 4 && $item->name == 'Discounts') ||
            ($params['idnoe'] == 6 && $item->name == 'Locks')
        );
    }
}