<?php
namespace app\grid;

use yii\grid\DataColumn as BaseDataColumn;
use yii\helpers\Html;

class DataColumn extends BaseDataColumn
{
    /**
     * @property GridView $grid
     */
    public function init()
    {
        parent::init();

        $this->contentOptions = function() {
            return [
                'contenteditable' => $this->grid->editable ? 'true': 'false',
                'column-name'     => $this->attribute
            ];
        };

    }

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


    /**
     * @inheritdoc
     */
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || $this->label === null && $this->attribute === null) {
            return parent::renderHeaderCellContent();
        }

        if ($this->attribute
            && $this->enableSorting
            && ($sort = $this->grid->dataProvider->getSort())) {
            return $sort->link($this->attribute, $this->sortLinkOptions);
        } else {
            $label = $this->getHeaderCellLabel();
            if ($this->encodeLabel) {
                $label = Html::encode($label);
            }
            return Html::encode($label);
        }
    }
}
