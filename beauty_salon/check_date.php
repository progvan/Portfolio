<?php
$conn = mysqli_connect('', '', '', 'beauty salon');
$result = mysqli_query($conn, "SELECT `Дата_час`, DATE_ADD(`Дата_час`, INTERVAL `Послуги`.`Час_послуги` MINUTE) AS `sum_date` FROM `Запис` INNER JOIN `Послуги` ON `Послуги`.`Код_послуги` = `Запис`.`Код_послуги` WHERE '".$_POST['dtID']."' BETWEEN `Дата_час` AND DATE_ADD(`Дата_час`, INTERVAL `Послуги`.`Час_послуги` MINUTE)");
if(mysqli_num_rows($result) == 1){
    $output = '<input type="datetime-local" name ="id_date_time" class="form-control is-invalid" style="font-size: 18px;" id="date_time" value="'.$_POST['dtID'].'"><label for="date_time">Введена дата зайнята</label><br><button type="submit" name="submit" class="btn btn-success btn-lg disabled">Додати запис</button>';
}
else
    if ($_POST['dtID'] <= date('Y-m-d H:i')) {
        $output = '<input type="datetime-local" name ="id_date_time" class="form-control is-invalid" style="font-size: 18px;" id="date_time" value="'.$_POST['dtID'].'"><label for="date_time">Введена дата застаріла</label><br><button type="submit" name="submit" class="btn btn-success btn-lg disabled">Додати запис</button>';
    }
    else {
        $output = '<input type="datetime-local" name ="id_date_time" class="form-control" style="font-size: 18px;" id="date_time" value="'.$_POST['dtID'].'"><label for="date_time">Дата коректна</label><br><button type="submit" name="submit" class="btn btn-success btn-lg">Додати запис</button>';
    }
echo $output;
?>
