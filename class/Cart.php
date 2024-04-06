<?php
require_once 'Form.php';

class Cart {
    private $data;
    private $cart;
    private $total;

    public function __construct() {
        $this->data = array();
        $this->cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $this->total = 0;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getCart() {
        return $this->cart ?? [];
    }

    public function getTotal() {
        return $this->total;
    }

    public function addToCart($id, $quantity) {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity'] += $quantity;
        } else {
            $this->cart[$id]['quantity'] = $quantity;
        }
        $_SESSION['cart'] = $this->cart;
    }

    public function removeFromCart($id, $quantity) {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity'] -= $quantity;
            if ($this->cart[$id]['quantity'] <= 0) {
                unset($this->cart[$id]);
            }
        }
        $_SESSION['cart'] = $this->cart;
    }

    public function emptyCart() {
        $this->cart = [];
        $this->total = 0;
        $_SESSION['cart'] = $this->cart;
    }

    public function displayCart() {
        $data = $this->data;
        $cart = $this->cart;
        $total = 0;
        $output = "<table>";
        $output .= "<tr><th>Produit</th><th>Prix</th><th>Quantité</th><th>Total</th><th>Actions</th></tr>";
        foreach ($cart as $id => $product) {
            foreach ($data as $item) {
                if ($item['id_produit'] == $id) {
                    $output .= "<tr>";
                    $output .= "<td>" . $item['nom'] . "</td>";
                    $output .= "<td>" . $item['prix'] . "</td>";
                    $output .= "<td>" . $product['quantity'] . "</td>";
                    $output .= "<td>" . $item['prix'] * $product['quantity'] . "</td>";

                    //$output .= "<td>";
                    //$output .= "<form method='post' action='controllers/cart/remove.php'>";
                    //$output .= "<input type='hidden' name='id' value='$item[id_produit]'>";
                    //$output .= "<button type='submit' name='button' value='delete'>Supprimer</button>";
                    //$output .= "</form>";
                    //$output .= "</td>";
                    //$output .= "<td>";
                    //$output .= "<form method='post' action='controllers/cart/add.php'>";
                    //$output .= "<input type='hidden' name='id' value='$item[id_produit]'>";
                    //$output .= "<button type='submit' name='button' value='add'>Ajouter</button>";
                    //$output .= "</form>";
                    //$output .= "</td>";


                    $output .= "</tr>";
                    $total += $item['prix'] * $product['quantity'];
                }
            }
        }
        $output .= "<tr>";
        $output .= "<tfoot><td colspan='3'>Total</td><td>$total</td></tfoot>";
        $output .= "</tr>";

        $output .= "</table>";
        return $output;
    }
}