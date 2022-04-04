s<?php

require "connection.php";


?>
<h1>Посмотреть все заказы</h1>
<?php

// Создаём SQL запрос
$sql = "SELECT * FROM `orders`";

$result = $mysql->query($sql);

while ($row = $result -> fetch_assoc()){

    echo "Заказ: " . $row['id_order'] . "<br>
                  Название: " . $row['id_product'] . " х " . $row['quantity'] . " <br>
                  
                  Цена: " . $row['price'] . " руб<br> ";

} ?>
