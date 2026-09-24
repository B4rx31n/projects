<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = [
        ['name' => 'Laptop', 'price' => 15000000, 'quantity' => 10],
        ['name' => 'Mouse', 'price' => 150000, 'quantity' => 50],
        ['name' => 'Keyboard', 'price' => 300000, 'quantity' => 30],
        ['name' => 'Monitor', 'price' => 2500000, 'quantity' => 15],
        ['name' => 'Printer', 'price' => 1200000, 'quantity' => 8],
    ];

    $html = '<h2>Daftar Produk</h2>';
    $html .= '<table border="1" style="border-collapse: collapse; width: 100%;">';
    $html .= '<thead>';
    $html .= '<tr style="background-color: #f2f2f2;">';
    $html .= '<th style="padding: 8px; text-align: left;">Nama Produk</th>';
    $html .= '<th style="padding: 8px; text-align: left;">Harga</th>';
    $html .= '<th style="padding: 8px; text-align: left;">Jumlah</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($products as $product) {
        $html .= '<tr>';
        $html .= '<td style="padding: 8px;">' . $product['name'] . '</td>';
        $html .= '<td style="padding: 8px;">Rp ' . number_format($product['price'], 0, ',', '.') . '</td>';
        $html .= '<td style="padding: 8px;">' . $product['quantity'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    return $html;
});
