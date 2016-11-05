<?php
namespace ContentManager\View\Helper;

use Cake\Utility\Inflector;
use Cake\View\Helper;
use Cake\View\View;

/**
 * Page helper
 */
class PageHelper extends Helper
{

    public $helpers = ['Html', 'Form', 'Url']; // load Html and Form helper

    public $data;
    public $editMode = false;
    public $form = "";
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * ee method
     * alias to editableElement
     */
    public function ee($key = null, $val = null, $options = [])
    {
        return $this->editableElement($key, $val, $options);
    }
    /**
     * editableElement method
     * Creates an editable content input
     * @param $key String Unique
     * @param $val String
     * @param $options Array
     * @return String HTML
     */
    public function editableElement($key = null, $val = null, $options = [])
    {

        $value = '';

        if (!is_null($val)) {
            $value = $val;
        }

        if (isset($this->data[$key])) {
            $value = $this->data[$key];
            if (PageHelper::isSerialized($value)) {
                $value = unserialize($value);
            }
        }
        //get the value befor add PageContents prefix to keys
        $key = "PageContents." . $key;

        if ($this->editMode) {
            if (isset($options['class'])) {
                $options['class'] = 'save-able ' . $options['class'];
            } else {
                $options['class'] = 'save-able ';
            }

            switch ($options['type']) {
                case 'FileManager':
                    $options['value'] = $value;
                    $fileButton = $this->Html->link(
                        '<i class="fa fa-files-o" aria-hidden="true"></i> Choose File', '#filemanager',
                        [
                            'class' => 'btn btn-primary filemanager pull-right',
                            'iframe' => $this->Url->build('/file-manager/admin/files?iframe=1'),
                            'data-id' => Inflector::slug(strtolower($key)),
                            'data-base-path' => $this->Url->build('/'),
                            'escape' => false,
                        ]
                    );
                    if (isset($options['templates']['inputContainer']) && substr_count($options['templates']['inputContainer'], '{{button}}') > 0) {
                        $options['templates']['inputContainer'] = str_replace('{{button}}', $fileButton, $options['templates']['inputContainer']);
                    } else {
                        $this->form .= $fileButton;
                    }
                    $this->form .= $this->Form->input($key, $options);
                    break;
                case 'richeditor':
                    $options['value'] = $value;
                    $options['escape'] = false;
                    $options['class'] = 'richeditor ' . $options['class'];
                    $options['type'] = 'textarea';
                    $options['data-filemanager'] = $this->Url->build('/admin/file-manager/files?iframe=1');
                    $this->form .= $this->Form->input($key, $options);
                    break;
                case 'radio':
                    $options['value'] = $value;
                    $radioOptions = $options['options'];
                    unset($options['type']);
                    unset($options['options']);
                    $this->form .= '<div class="input radio">' . $this->Form->radio($key, $radioOptions, $options) . '</div>';
                    break;
                case 'code':
                    $options['value'] = $value;
                    $options['type'] = 'textarea';
                    $options['class'] = 'hide ' . $options['class'];
                    $mode = $options['mode'];
                    unset($options['mode']);
                    $theme = $options['theme'];
                    unset($options['theme']);
                    $this->form .= $this->Form->input($key, $options);
                    $this->form .= '<div class="ace-editor" id="code-' . Inflector::slug(strtolower($key)) . '" data-mode="' . $mode . '" data-theme="' . $theme . '"></div>';
                    break;
                default:
                    $options['value'] = $value;
                    $this->form .= $this->Form->input($key, $options);
                    break;
            }
        }

        return $value;
    }
    /**
     * Check if a string is serialized
     * @param string $string
     * @link http://stackoverflow.com/questions/1369936/check-to-see-if-a-string-is-serialized
     */
    public static function isSerialized($string)
    {
        return (@unserialize($string) !== false);
    }
}
