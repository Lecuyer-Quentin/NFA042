<?php

function generateForm($form) {

    $class = $form['class'];
    $id_form = $form['id'] ?? null;
    $header = $form['header'] ?? null;
    $submit = $form['submit'];
    $action = $form['action'];
    $method = $form['method'] ?? 'post';
    $enctype = $form['enctype'] ?? 'application/x-www-form-urlencoded';
    $fields = $form['fields'];
    $footer = $form['footer'] ?? null;
    $row = $form['row'] ?? null;
    $btn_value = $form['btn_value'] ?? null;

    echo "<form id='$id_form' action='$action' class='$class' method='$method' enctype='$enctype'>";
        if($header) {
            echo "<div>";
                echo "<h2>$header[0]</h2>";
                echo "<p>$header[1]</p>";
                echo "<div id='error-message' style='color: red; margin-top: 10px; text-align: center; font-size: .9em; font-weight: bold; border: 1px solid red; padding: 5px;'></div>";
                echo "<div id='success-message' style='color: green; margin-top: 10px; text-align: center; font-size: .9em; font-weight: bold; border: 1px solid green; padding: 5px;'></div>";
            echo "</div>";
        }
        

        foreach($fields as $field) {
            $type = $field['type'];
            $name = $field['name'];
            $label = $field['label'] ?? null;
            $value = $field['value'] ?? null;
            $required = $field['required'] ?? null;

            // If value is a function, call it
            if(is_callable($value)) {
                $value = $value($row);
            }

            switch($type) {
                case 'input':
                case 'number':
                    echo "<label for='$name'>$label</label>";
                    echo "<input type='$type' name='$name' id='$name' value='$value' required='$required'>";
                    break;
                case 'textarea':
                    echo "<label for='$name'>$label</label>";
                    echo "<textarea name='$name' id='$name' required='$required'>$value</textarea>";
                    break;
                case 'hidden':
                    echo "<input type='hidden' name='$name' value='$value'>";
                    break;
                case "password":
                    echo "<label for='$name'>$label</label>";
                    echo "<input type='$type' name='$name' id='$name' required='$required'>";
                    break;
                case 'date':
                    echo "<label for='$name'>$label</label>";
                    echo "<input type='$type' name='$name' id='$name' required='$required'>";
                    break;
                case 'select':
                    $options = $field['options'];
                    echo "<label for='$name'>$label</label>";
                    echo "<select name='$name' id='$name' required='$required'>";
                    foreach($options as $option) {
                        $name = $option[1];
                        $value = $option[0];
                        echo "<option value='$value'>$name</option>";
                    }
                    echo "</select>";
                    break;
                case 'file':
                    echo "<label for='$name'>$label</label>";
                    echo "<input type='$type' name='$name' id='$name' required='$required' accept='image/*'>";
                    break;
                case "link":
                    echo "<a href='$value'>$label</a>";
                    break;
            }
        }
        echo "<button value='$btn_value' type='submit'>$submit</button>";
    
        if($footer) {
            echo "<div>";
            foreach($footer as $line) {
                    echo "<span>$line</span>";
            }
            echo "</div>";

        }
    echo "</form>";
}