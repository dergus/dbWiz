<?php

namespace app\data;

use yii\data\Sort as BaseSort;
use yii\helpers\Html;

class Sort extends BaseSort
{
    /**
     * @inheritdoc
     */
    public function link($attribute, $options = [])
    {
        if (($direction = $this->getAttributeOrder($attribute)) !== null) {
            $class = $direction === SORT_DESC ? 'desc' : 'asc';
            if (isset($options['class'])) {
                $options['class'] .= ' ' . $class;
            } else {
                $options['class'] = $class;
            }
        }

        $url = $this->createUrl($attribute);
        $options['data-sort'] = $this->createSortParam($attribute);

        return Html::a($attribute, $url, $options);
    }
}
