<?php
    $conn = mysqli_connect('', '', '', 'beauty salon');
    $result = mysqli_query($conn, "SELECT `ПІБ`, `Код_майстра` FROM `Майстри` JOIN `Види послуг` ON `Майстри`.`Код_виду` = `Види послуг`.`Код_виду` JOIN `Послуги` ON `Майстри`.`Код_виду` = `Послуги`.`Код_виду` WHERE `Послуги`.`Код_послуги` = '".$_POST['serviceID']."'");
    $output = '<option value="" disabled selected>-Оберіть майстра-</option>';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<option value="' . $row['Код_майстра'] . '">' . $row['ПІБ'] . '</option>';
    }
    echo $output;
?>
