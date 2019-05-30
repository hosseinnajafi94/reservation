<?php
namespace app\modules\users\components;
class ReservationRule extends \yii\rbac\Rule {
    public $name = 'ReservationRule';
    /**
     * @param string|int $user the user ID.
     * @param \yii\rbac\Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params) {
        return isset($params['idp1']) && (
            ($params['idp1'] == 1 && $item->name == 'OngoingReservations')    ||
            ($params['idp1'] == 2 && $item->name == 'DefinitiveReservations') ||
            ($params['idp1'] == 3 && $item->name == 'CanceledReservations')
        );
    }
}