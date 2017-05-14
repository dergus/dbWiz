<?php

namespace app\components;

use yii\db\Connection as BaseConnection;

class Connection extends BaseConnection
{
    /**
     * list of supported driver names
     * @return array
     */
    public function getSupportedDriverNames(): array
    {
        return array_keys($this->schemaMap);
    }
}
