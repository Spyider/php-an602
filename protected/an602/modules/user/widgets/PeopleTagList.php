<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2021 H u m H u b GmbH & Co. KG, PHP-AN602, The 86it Developers Network, and Yii
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\user\widgets;

use an602\libs\Html;
use yii\helpers\Url;
use an602\components\Widget;

/**
 * PeopleTagList displays the user tags on the directory people page
 *
 * @since 1.2
 * @author Luke
 */
class PeopleTagList extends Widget
{

    /**
     * @var \an602\modules\user\models\User
     */
    public $user;

    /**
     * @var int number of max. displayed tags
     */
    public $maxTags = 5;

    /**
     * @var string Template for tags
     */
    public $template = '{tags}';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $html = '';

        $tags = $this->user->getTags();

        $count = count($tags);

        if ($count === 0) {
            return $html;
        }

        if ($count > $this->maxTags) {
            $tags = array_slice($tags, 0, $this->maxTags);
        }

        if (empty($tags)) {
            return $html;
        }

        foreach ($tags as $tag) {
            if (trim($tag) !== '') {
                $html .= Html::a(Html::encode($tag), Url::to(['/user/people', 'keyword' => trim($tag)]), ['class' => 'label label-default']) . '&nbsp';
            }
        }

        if ($html === '') {
            return $html;
        }

        return str_replace('{tags}', $html, $this->template);
    }

}
