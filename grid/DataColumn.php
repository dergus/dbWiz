<?php
namespace app\grid;

use yii\grid\DataColumn as BaseDataColumn;
use yii\helpers\Html;

class DataColumn extends BaseDataColumn
{
    protected function getHeaderCellLabel()
    {
        return $this->attribute;
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content === null) {
            return $this->getDataCellValue($model, $key, $index);
        } else {
            return parent::renderDataCellContent($model, $key, $index);
        }
    }
}
