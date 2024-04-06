<?php
require_once 'class/Form.php';

class Table{
    private $data;
    private $items;
    private $columns;
    private $actions;
    private $header;
    private $footer;
    private $class;

    public function __construct(){
        $this->data = array();
    }

    public function setData($data){
        $this->data = $data;
        $this->items = $data['items'];
        $this->columns = $data['columns'];
        $this->actions = $data['actions'] ?? null;
        $this->header = $data['header'] ?? null;
        $this->footer = $data['footer'] ?? null;
        $this->class = $data['class'] ?? null;
    }

    private function generateHeader() {
        $head = null;
        if($this->header) {
            $head .= "<tr>";
                    $head .= "<th colspan='" . (count($this->columns) + 1) . "'>";
                    foreach($this->header as $line) {
                        $type = $line['type'];
                        $content = $line['content'];
                        if($type == 'form') {
                            $value = $line['value'];
                            $head .= "<form method='post' class='action_btn'>";
                                $head .= "<button type='submit' name='button' value='$value'>$content</button>";
                            $head .= "</form>";
                        } else {
                            $head .= "<$type>$content</$type>";
                        }
                    }
                    $head .= "</th>";    
            $head .= "</tr>";
            }
            return $head;
    }
    private function generateTableHead() {
            $thead = "<tr>";
                foreach($this->columns as $col) {
                    $thead .= "<th>" . $col['label'] . "</th>";
                }
                if($this->actions) {
                    $thead .= "<th>Actions</th>";
                }

            $thead .= "</tr>";
        return $thead;

    }
    private function generateFooter() {
        $foot = "<tr>";
            $foot .= "<td colspan='" . (count($this->columns) + 1) . "'>";
                foreach($this->footer as $line) {
                    $type = $line['type'];
                    $content = $line['content'];
                    $foot .= "<$type>$content</$type>";
                }
            $foot .= "</td>";
        $foot .= "</tr>";
        return $foot;
    }

    private function action_item($id, $value, $label, $type, $action) {
       switch($type) {
           case 'form':
               $action_btn = "<form method='post' class='action_btn' action='$action'>";
                   $action_btn .= "<input type='hidden' name='id' value='$id'>";
                   $action_btn .= "<button type='submit' name='button' value='$value'>$label</button>";
               $action_btn .= "</form>";
               break;
           case 'link':
               $action_btn = "<button class='action_btn'><a href='$action'>$label</a></button>";
               break;
       }
       return $action_btn;
    }

    private function generateColumn() {
        $column = "";
        foreach($this->items as $item) {
            $column .= "<tr>";
            foreach($this->columns as $col) {
                $column .= "<td>" . $item[$col['name']] . "</td>";
            }
            
            if($this->actions) {
                $column .= "<td>";
                foreach($this->actions as $action) {
                        $value = $action['value'] ?? null;
                        $act = $action['action'] ?? null;
                        $label = $action['label'];
                        $type = $action['type'];

                    $id = $item[0] ?? null;
                    $column .= $this->action_item($id, $value, $label, $type, $act);
                }
                $column .= "</td>";
            }
            $column .= "</tr>";
        }
        return $column;
     
    }


    public function generateTable(){
        $table = "<table class=$this->class>";
            $table .= "<thead>";
                $table .= $this->generateHeader();
                $table .= $this->generateTableHead();
            $table .= "</thead>";
            $table .= "<tbody>";
                $table .= $this->generateColumn();
            $table .= "</tbody>";
            $table .= "<tfoot>";
                $table .= $this->generateFooter();
            $table .= "</tfoot>";
        $table .= "</table>";
        return $table;
    }
}
