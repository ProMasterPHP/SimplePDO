<?php
require "config.php";

function dd($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

Order::down(); //Agar orders table`i mavjud bo'lsa uni o'chiradi
Order::up(); //orders table`ni yaratadi
Order::seed(); //test uchun 10 ta order qo'shadi

//SELECT statement
$order = Order::select('*', ['status' => 'Processing']); dd($order->fetchAll());

//UPDATE statement
$order->update([
    'status' => 'Shipped' //statusni o'zgartiradi
]);

//DELETE statement
Order::delete(['status' => 'Delivered']); //Delivered statusidagi orderlarni o'chiradi

//INSERT statement
Order::insert([
    'user_id' => rand(10000, 99999),
    'product_id' => rand(10, 100),
    'status' => 'Delivered'
]); //orders tablesiga 1 ta order qo'shadi
?>