<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Passion Jewelry</title>

    <style>
        html,
        body {
            font-family: Arial;
            font-size: 14px;
        }

        .box-table {
            overflow-x: auto;
        }

        .table {
            border-collapse: collapse;
        }

        .table th {
            padding: 8px 10px;
            background-color: #e5e5e5;
            border: 1px solid #ccc;
        }

        .table td {
            padding: 8px 10px;
            border: 1px solid #ccc;
        }

        .table tbody tr:last-child {
            font-weight: 600;
        }

        label {
            width: 80px;
            display: inline-block;
        }

        input {
            padding: 5px 8px;
            margin-bottom: 8px;
        }

        button {
            padding: 5px 8px;
            width: 80px;
        }
    </style>
</head>

<body>
    <h1>Report</h1>
    <div class="box-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>YM</th>
                    <th colspan='6'>Stock Awal</th>
                    <th colspan='6'>Stock In Beli</th>
                    <th colspan='6'>Stock In Buyback</th>
                    <th colspan='6'>Stock Out Penjualan</th>
                    <th colspan='6'>Stock Akhir</th>
                </tr>
                <tr>
                    <th>Jenis</th>
                    <th>YM</th>
                    <th>PCS</th>
                    <th>CARAT</th>
                    <th>GRAM</th>
                    <th>COGM</th>
                    <th>NET</th>
                    <th>USERNET</th>
                    <th>PCS</th>
                    <th>CARAT</th>
                    <th>GRAM</th>
                    <th>COGM</th>
                    <th>NET</th>
                    <th>USERNET</th>
                    <th>PCS</th>
                    <th>CARAT</th>
                    <th>GRAM</th>
                    <th>COGM</th>
                    <th>NET</th>
                    <th>USERNET</th>
                    <th>PCS</th>
                    <th>CARAT</th>
                    <th>GRAM</th>
                    <th>COGM</th>
                    <th>NET</th>
                    <th>USERNET</th>
                    <th>PCS</th>
                    <th>CARAT</th>
                    <th>GRAM</th>
                    <th>COGM</th>
                    <th>NET</th>
                    <th>USERNET</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $item) : ?>
                    <tr>
                        <td><span style="white-space: nowrap"><?= $key ?></span></td>
                        <td><span style="white-space: nowrap">2023-07</span></td>
                        <?php foreach ($item['stock_awal'] as $value) : ?>
                            <td align="right">
                                <?= floatval($value) == intval($value) ?  number_format($value, 0, '.', ',') : number_format($value, 3, '.', ',') ?>
                            </td>
                        <?php endforeach; ?>
                        <?php foreach ($item['stock_in_beli'] as $value) : ?>
                            <td align="right">
                                <?= floatval($value) == intval($value) ?  number_format($value, 0, '.', ',') : number_format($value, 3, '.', ',') ?>
                            </td>
                        <?php endforeach; ?>
                        <?php foreach ($item['stock_in_buyback'] as $value) : ?>
                            <td align="right">
                                <?= floatval($value) == intval($value) ?  number_format($value, 0, '.', ',') : number_format($value, 3, '.', ',') ?>
                            </td>
                        <?php endforeach; ?>
                        <?php foreach ($item['stock_out_penjualan'] as $value) : ?>
                            <td align="right">
                                <?= floatval($value) == intval($value) ?  number_format($value, 0, '.', ',') : number_format($value, 3, '.', ',') ?>
                            </td>
                        <?php endforeach; ?>
                        <?php foreach ($item['stock_akhir'] as $value) : ?>
                            <td align="right">
                                <?= floatval($value) == intval($value) ?  number_format($value, 0, '.', ',') : number_format($value, 3, '.', ',') ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>