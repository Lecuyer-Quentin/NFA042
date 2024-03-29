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
                    echo "<p>" . $header[1] . "</p>";
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
                                'action' => $action['action'],
                                'fields' => $action['fields'],
                                'row' => $row,
                            ]);
                        }
                        if($link) {
                            $url = $link['url'] . $row[0];
                            $class = $link['class'];
                            $name = $link['name'];
                            echo "<button><a href='$url'>$name</a></button>";
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
