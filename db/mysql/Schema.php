<?php

namespace app\db\mysql;

use yii\db\mysql\Schema as BaseSchema;

class Schema extends BaseSchema
{
    protected function findSchemaNames(): array
    {
        $sql = 'SHOW DATABASES';
        return $this->db->createCommand($sql)->queryColumn();
    }
}
