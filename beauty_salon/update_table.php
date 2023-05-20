<?php
$conn = mysqli_connect('', '', '', 'beauty salon');
$update_query = mysqli_query($conn, "SELECT `Клієнти`.`ПІБ` AS `Клієнти_ПІБ`, `Послуги`.`Назва_послуги`, `Майстри`.`ПІБ` AS `Майстри_ПІБ`, `Запис`.`Дата_час` FROM `Запис` INNER JOIN `Клієнти` ON `Клієнти`.`Код_клієнта` = `Запис`.`Код_клієнта` LEFT JOIN `Послуги` ON `Послуги`.`Код_послуги` = `Запис`.`Код_послуги` LEFT JOIN `Майстри` ON `Майстри`.`Код_майстра` = `Запис`.`Код_майстра` WHERE `Запис`.`Дата_час` >= '".$_POST['start_date']."' AND `Запис`.`Дата_час` <= '".$_POST['end_date']."'");
$sum_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`Послуги`.`Ціна`) FROM `Запис`, `Послуги` WHERE `Запис`.`Код_послуги` = `Послуги`.`Код_послуги` AND `Запис`.`Дата_час` >= '".$_POST['start_date']."' AND `Запис`.`Дата_час` <= '".$_POST['end_date']."'"));
echo "<caption style='font-size: 18px'>Всього зароблено: ";
if (is_null($sum_price['SUM(`Послуги`.`Ціна`)'])){
echo 0;}
else{
    echo $sum_price['SUM(`Послуги`.`Ціна`)'];
}
echo"</caption>";
echo "<thead><tr><th scope='col' style='border: 0.5px solid darkslategray;'>Клієнт</th><th scope='col' style='border: 0.5px solid darkslategray;'>Назва послуги</th><th scope='col' style='border: 0.5px solid darkslategray;'>Майстер</th><th scope='col' style='border: 0.5px solid darkslategray;'>Дата Час</th></tr></thead>";
echo "<tbody>";
            while ($art_n=mysqli_fetch_array($update_query)) {
                echo "<tr><td style='border: 0.5px solid darkslategray;'>{$art_n['Клієнти_ПІБ']}</td>";
                echo "<td style='border: 0.5px solid darkslategray;'>";
                if (is_null($art_n['Назва_послуги'])){
                    echo 'Видалено (ціна = 0)';}
                else{
                    echo $art_n['Назва_послуги'];
                }
                echo "</td>";
                echo "<td style='border: 0.5px solid darkslategray;'>";
                if (is_null($art_n['Майстри_ПІБ'])){
                    echo 'Видалено';}
                else{
                    echo $art_n['Майстри_ПІБ'];
                }
                echo "</td>";
                echo "<td style='border: 0.5px solid darkslategray;'>{$art_n['Дата_час']}</td>";
                echo"</tr>";
             }
            echo "</tbody>";
?>
