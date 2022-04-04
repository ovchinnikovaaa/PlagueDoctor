<?php

require_once "../php/connection.php";

?>

<?php

if(isset($_GET['action']) && $_GET['action'] == "add") {

    $id = intval($_GET['id']);
    if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $query_s = $mysql->query("SELECT * FROM `products` WHERE id_product={$id}");
        if (mysqli_num_rows($query_s) != 0) {
            $row_s = $query_s->fetch_array();

            $_SESSION['cart'][$row_s['id_product']] = array(
                "quantity" => 1,
                "price" => $row_s['price']
            );
        } else {
            $message = "This product id is invalid!";

        }
    }
}


?>

<h1>Наш ассортимент:</h1>
<?php
if(isset($message)) {
    echo "<h2>$message</h2>";
}
//echo print_r($_SESSION['cart']) //проверка на вывод количества товара (?)
?>
<table>
    <tr>
        <th>Название</th>
        <th>Производитель</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Изображение</th>
        <th>Корзина</th>
    </tr>

    <!-- тут происходит выборка данных из бд -->

    <?php

    $zero_amount = 0;
    $sql = $mysql->query("SELECT * FROM `products`, `dealers` WHERE `products`.`id_dealer` = `dealers`.`id_dealer` AND `amount` != '$zero_amount' ORDER BY name");

    while ($row = $sql->fetch_array()) {

        ?>
        <tr>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['dealer_name']?></td>
            <td><?php echo $row['description']?></td>
            <td><?php echo $row['price']?> руб</td>
            <td><img src ='<?php echo $row['pic']?>' width="100" alt=""></td>
            <td><a href="horrible.php?page=products&action=add&id=<?php echo $row['id_product']?>"> Добавить в корзину</a> </td>

        </tr>

        <?php

    }
    ?>
</table>