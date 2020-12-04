<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\widgets\incores;


use kartik\builder\Form;
use kartik\builder\FormGrid;

class ZFormGrid extends FormGrid
{
    protected function getGridOutput()
    {
        $output = '';
        foreach ($this->rows as $row) {
            $defaults = [
                'model' => $this->model,
                'form' => $this->form,
                'formName' => $this->formName,
                'columns' => $this->columns,
                'attributeDefaults' => $this->attributeDefaults,
                'autoGenerateColumns' => $this->autoGenerateColumns,
                'columnSize' => $this->columnSize,
                'columnOptions' => $this->columnOptions,
                'rowOptions' => $this->rowOptions,
                'options' => $this->fieldSetOptions,
            ];
            $config = array_replace_recursive($defaults, $row);
            $output .= ZForm::widget($config) . "\n";
        }
        return $output;
    }


}
