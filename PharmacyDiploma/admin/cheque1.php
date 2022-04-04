<?php

require_once "../php/connection.php";

$id_order = $_POST['id_order'];

?>
<script type="text/javascript">
    function rus_date() {
        var d = new Date();
        var month = 'января февраля марта апреля мая июня июля августа сентября октября ноября декабря'.split(' ')[d.getMonth()];
        document.write(d.getDate() + ' ' + month + ' ' + d.getFullYear() + ' г.');
    };
</script>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/style.css" />

    <title>Товарная накладная</title>

    <style>
        .text_center {
            text-align:  center;
        }
        .text_right {
            text-align: right;
        }
        .text_left {
            text-align: left;
        }
        #table1 {width: 100%; border-collapse: collapse;}
        #table1 table thead tr {font-weight: bold; border-top: 1px solid #e8e9eb;}
        #table1 table td {padding: 12px 16px;}
        #table1 table thead tr {font-weight: bold; border-top: 1px solid #e8e9eb;}
        #table1 table tr {border-bottom: 1px solid #e8e9eb;}
        #table1 table tbody tr:hover {background: #e8f6ff;}
    </style>
</head>
<body>
<div class="text_center">
    <h1>Товарная накладная № <?php echo $id_order; ?></h1>
</div>

<div class="text_right">
    <p>Дата: <script type="text/javascript"> rus_date(); </script> </p>
</div>

<div class="text_left">
    <h2>Продавец: ООО "PLAGUE DOCTOR"</h2>
    <h2>Адрес: г.Москва, ул. Берсеневская 13-7</h2>
    <h2>ИНН\КПП: 7704407589\770401001 </h2>
    <h2>ОГРН: 1177746415857 от 24 апреля 2017 г. </h2>
</div>


<div id="table1">
    <table>
        <tr>
            <th>Название</th>
            <th>Артикул</th>
            <th>Цена</th>
            <th>Количество</th>
        </tr>

        <?php

        $sql = "SELECT * FROM `orders` LEFT JOIN `products` USING(`id_product`) WHERE `id_order`='$id_order'";
        $result = $mysql->query($sql);

        while ($row = $result->fetch_assoc()) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['id_product']?></td>
                <td><?php echo $row['price']?> руб</td>
                <td><?php echo $row['quantity']?></td>
            </tr>

            <?php


        }

        ?>
    </table>

    <h3>Общая стоимость: <?php echo $total; ?> руб.</h3>
</div>
</body>
</html>
