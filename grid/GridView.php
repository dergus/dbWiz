<?php


namespace app\grid;

use yii\grid\GridView as BaseGridView;

class GridView extends BaseGridView
{
    /**
     * @var array
     * table primary key
     */
    public $primaryKey = [];

    /**
     * @var bool
     * are table data cells editable
     */
    public $editable = false;

    /**
     * @var string css class for editable table
     */
    public $editableCssClass = 'table-editable';

    public $dataColumnClass = DataColumn::class;

    public function init()
    {
        parent::init();

        if ($this->editable) {
            $this->tableOptions['class'] .= ' ' .$this->editableCssClass;
            $this->rowOptions = function ($model) {
                $condition = [];
                foreach ($this->primaryKey as $key) {
                    $condition[$key] = $model[$key];
                }

                return [
                    'update-condition' => $condition
                ];
            };
        }
    }
}
