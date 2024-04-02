<?php
require_once 'components/form/form.php';


function generateTable($data) {
    $columns = $data['columns'];
    $actions = $data['actions'];
    $link = $data['link'] ?? null;
    $header = $data['header'] ?? null;
    $footer = $data['footer'] ?? null;

    echo "<table class='table'>";
        echo "<thead>";
            echo "<tr>";
                if($header) {
                    echo "<th colspan='" . (count($columns) + 1) . "'>";
                        echo "<h3>" . $header[0] . "</h3>";
                        echo "<span>";
                            $header[1]();
                        echo "</span>";
                    echo "</th>"; 
                    
                }
            echo "</tr>";
            echo "<tr>";
                foreach($columns as $key => $value) {
                    echo "<th>" . $key . "</th>";
                }
                echo "<th>Actions</th>";
            echo "</tr>";
        echo "</thead>";
        
        echo "<tbody>";
            foreach ($data['data'] as $row) {
                echo "<tr>";
                    foreach($columns as $key => $value) {
                        echo "<td>" . $row[$value] . "</td>";
                    }
                
                    echo "<td>";
                        echo "<div>";
                        foreach($actions as $action) {
                            generateForm([
                                'class' => $action['class'],
                                'submit' => $action['submit'],
                                'action' => $action['action'] ?? null,
                                'fields' => $action['fields'],
                                'row' => $row,
                            ]);
                        }

                        if($link) {
                            $value = $link['value'];
                            $name = $link['name'];
                            $class = $link['class'];
                            echo '<form method="post">';
                            echo '<input type="hidden" name="id" value="'.$row[0].'">';
                            echo '<button type="submit" name="button" value="'.$value.'" class="'.$class.'">'.$name.'</button>';
                            echo '</form>';
                        }
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            }
        echo "</tbody>";
        if($footer) {
            echo "<tfoot>";
                echo "<tr>";
                echo "<td colspan='" . (count($columns) + 1) . "'>";
                    $footer();
                echo "</td>";
                echo "</tr>";
            echo "</tfoot>";
        }
    echo "</table>";
}
