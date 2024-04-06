<?php

class Form {
    private $data;
    private $class;
    private $id;
    private $name;
    private $content;
    private $action;
    private $fields;
    private $header;
    private $footer;
    private $row;
    private $btn_value;
    private $method;
    private $enctype;

    public function __construct(){
        $this->data = array();
    }

    public function setData($data){
        $this->data = $data;
        $this->class = $this->data['class'] ?? null;
        $this->id = $this->data['id'] ?? null;
        $this->name = $this->data['name'] ?? null;
        $this->content = $this->data['content'] ?? null;
        $this->action = $this->data['action'] ?? null;
        $this->fields = $this->data['fields'] ?? null;
        $this->header = $this->data['header'] ?? null;
        $this->footer = $this->data['footer'] ?? null;
        $this->row = $this->data['row'] ?? null;
        $this->btn_value = $this->data['btn_value'] ?? null;
        $this->method = $this->data['method'] ?? 'post';
        $this->enctype = $this->data['enctype'] ?? 'application/x-www-form-urlencoded';
    }

    public function getData(){
        return $this->data;
    }

    private function generateHeader() {
        $head = null;
        if($this->header) {
            $head = "<div>";
                foreach($this->header as $line) {
                    $type = $line['type'];
                    $content = $line['content'];
                    $head .= "<$type>$content</$type>";
                }
                $head .= "<div id='error-message' style='color: red; margin-top: 10px; text-align: center; font-size: .9em; font-weight: bold; border: 1px solid red; padding: 5px;'></div>";
                $head .= "<div id='success-message' style='color: green; margin-top: 10px; text-align: center; font-size: .9em; font-weight: bold; border: 1px solid green; padding: 5px;'></div>";
            $head .= "</div>";
        }
        return $head;
    }

    private function generateFooter() {
        $foot = null;
        if($this->footer) {
            $foot = "<div>";
            foreach($this->footer as $line) {
                $type = $line['type'];
                $content = $line['content'];
                $foot .= "<$type>$content</$type>";
            }
            $foot .= "</div>";
        }
        return $foot;
    }
    private function generateField() {
        $input = null;
        foreach($this->fields as $field) {
            $type = $field['type'] ?? null;
            $name = $field['name'] ?? null;
            $label = $field['label'] ?? null;
            $value = $field['value'] ?? null;
            $required = $field['required'] ?? null;

            if(is_callable($value)) {//? If value is a function, call it
                $value = $value();
            }
            switch($type){
                case 'input':
                case 'number':
                    $input .= "<label for='$name'>$label</label>";
                    $input .= "<input type='$type' name='$name' id='$name' value='$value' required='$required'>";
                    break;
                case 'textarea':
                    $input .= "<label for='$name'>$label</label>";
                    $input .= "<textarea name='$name' id='$name' required='$required'>$value</textarea>";
                    break;
                case 'hidden':
                    $input .= "<input type='hidden' name='$name' value='$value'>";
                    break;
                case "password":
                    $input .= "<label for='$name'>$label</label>";
                    $input .= "<input type='$type' name='$name' id='$name' required='$required'>";
                    break;
                case 'date':
                    $input .= "<label for='$name'>$label</label>";
                    $input .= "<input type='$type' name='$name' id='$name' required='$required'>";
                    break;
                case 'select':
                    $options = $field['options'];
                    $input .= "<label for='$name'>$label</label>";
                    $input .= "<select name='$name' id='$name' required='$required'>";
                    foreach($options as $option) {
                        $name = $option[1];
                        $value = $option[0];
                        $input .= "<option value='$value'>$name</option>";
                    }
                    $input .= "</select>";
                    break;
                case 'file':
                    $input .= "<label for='$name'>$label</label>";
                    $input .= "<input type='$type' name='$name' id='$name' required='$required' accept='image/*'>";
                    break;
                case "link":
                    $input .= "<a href='$value'>$label</a>";
                    break;
            }
    }
        return $input;
    }
    private function generateBtn() {
        $btn = "<button value='$this->btn_value' type='submit'>$this->content</button>";
        return $btn;
    }

    public function generateForm() {
        $form = "<form id='$this->id' action='$this->action' class='$this->class' method='$this->method' enctype='$this->enctype'>";
            $form .= $this->generateHeader();
            $form .= $this->generateField();
            $form .= $this->generateBtn();
            $form .= $this->generateFooter();
        $form .= "</form>";
        return $form;
    }
}