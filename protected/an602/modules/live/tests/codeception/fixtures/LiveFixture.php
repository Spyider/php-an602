<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2015 H u m H u b GmbH & Co. KG, PHP-AN602, The 86it Developers Network, and Yii
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\live\tests\codeception\fixtures;

use an602\modules\live\models\Live;
use yii\test\ActiveFixture;

class LiveFixture extends ActiveFixture
{

    public $modelClass = Live::class;
    public $dataFile = '@live/tests/codeception/fixtures/data/live.php';

}
