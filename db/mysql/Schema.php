<?php

namespace app\db\mysql;

use yii\db\mysql\Schema as BaseSchema;

class Schema extends BaseSchema
{
    protected function findSchemaNames(): array
    {
        $sql = 'SHOW DATABASES';
        return array_diff($this->db->createCommand($sql)->queryColumn(), ['mysql', 'information_schema', 'performance_schema']);
    }
}
