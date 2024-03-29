<?php


function generateForm($form) {
    $class = $form['class'];
    $header = $form['header'] ?? null;
    $submit = $form['submit'];
    $action = $form['action'];
    $method = $form['method'] ?? 'post';
    $enctype = $form['enctype'] ?? 'application/x-www-form-urlencoded';
    $fields = $form['fields'];
    $footer = $form['footer'] ?? null;
    $row = $form['row'] ?? null;

    echo "<form action='$action' class='$class' method='$method' enctype='$enctype'>";
        if($header) {
            echo "<div>";
                echo "<h2>$header[0]</h2>";
                echo "<p>$header[1]</p>";
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
                    echo "<input type='$type' name='$name' id='$name' required='$required'>";
                    break;
                case "link":
                    echo "<a href='$value'>$label</a>";
                    break;
            }
        }
        echo "<button type='submit'>$submit</button>";

        if($footer) {
            echo "<div>";
            foreach($footer as $line) {
                    echo "<span>$line</span>";
            }
            echo "</div>";

        }
    echo "</form>";
}