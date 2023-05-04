<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2018 H u m H u b GmbH & Co. KG, PHP-AN602, The 86it Developers Network, and Yii
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\space\notifications;

use an602\modules\notification\components\BaseNotification;
use Yii;
use yii\bootstrap\Html;

/**
 * @property \an602\modules\space\models\Membership $source
 * @since 1.3
 */
class ChangedRolesMembership extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $moduleId = 'space';

    /**
     * @inheritdoc
     */
    public $viewName = 'membershipRolesChanged';

    /**
     * @inheritdoc
     */
    public function category()
    {
        return new SpaceMemberNotificationCategory;
    }

    /**
     * @inheritdoc
     */
    public function getMailSubject()
    {
        return $this->getInfoText(false);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->source->space->getUrl();
    }

    /**
     * @inheritdoc
     */
    public function html()
    {
        return $this->getInfoText();
    }

    private function getInfoText($html = true)
    {
        $groups = $this->source->space->getUserGroups();

        if (!isset($groups[$this->source->group_id])) {
            throw new \Exception('The role ' . $this->source->group_id . ' is wrong for Membership');
        }

        $displayName = $html ? Html::tag('strong', Html::encode($this->originator->displayName)) : $this->originator->displayName;
        $roleName = $html ? Html::tag('strong', $groups[$this->source->group_id]) : $groups[$this->source->group_id];
        $spaceName = $html ? Html::tag('strong', Html::encode($this->source->space->getDisplayName())) : $this->source->space->getDisplayName();

        return Yii::t(
            'SpaceModule.notification',
            '{displayName} changed your role to {roleName} in the space {spaceName}.',
            [
                '{displayName}' => $displayName,
                '{roleName}' => $roleName,
                '{spaceName}' => $spaceName,
            ]);
    }
}
