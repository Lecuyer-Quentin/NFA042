<?php

$orders =[
    [
        'order_id' => 1,
        'product_id' => 1,
        'product_name' => 'Product 1',
        'quantity' => 1,
        'price' => 100,
        'order_date' => '2021-01-01'
    ],
    [
        'order_id' => 2,
        'product_id' => 2,
        'product_name' => 'Product 2',
        'quantity' => 2,
        'price' => 200,
        'order_date' => '2021-01-02'
    ],
    [
        'order_id' => 3,
        'product_id' => 3,
        'product_name' => 'Product 3',
        'quantity' => 3,
        'price' => 300,
        'order_date' => '2021-01-03'
    ],
    [
        'order_id' => 4,
        'product_id' => 4,
        'product_name' => 'Product 4',
        'quantity' => 4,
        'price' => 400,
        'order_date' => '2021-01-04'
    ],
    [
        'order_id' => 5,
        'product_id' => 5,
        'product_name' => 'Product 5',
        'quantity' => 5,
        'price' => 500,
        'order_date' => '2021-01-05'
    ]
];

function display_orders($orders){
    echo "<h1>Orders</h1>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Order ID</th>";
    echo "<th>Product ID</th>";
    echo "<th>Product Name</th>";
    echo "<th>Quantity</th>";
    echo "<th>Price</th>";
    echo "<th>Order Date</th>";
    echo "</tr>";
    foreach($orders as $order) {
        echo "<tr>";
        echo "<td>".$order['order_id']."</td>";
        echo "<td>".$order['product_id']."</td>";
        echo "<td>".$order['product_name']."</td>";
        echo "<td>".$order['quantity']."</td>";
        echo "<td>".$order['price']."</td>";
        echo "<td>".$order['order_date']."</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        </style>
        ";
}

display_orders($orders);