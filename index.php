<?php
require 'bd-conect.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Англо-русский словарь</title>
<link rel="icon" type="image/png" href="./images\иконка.png">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
/*
<form class="decor">
<div class="form-left-decoration"></div>
<div class="form-right-decoration"></div>
<div class="circle"></div>
<div class="form-inner">
<h3>Написать нам</h3>
<input type="text" placeholder="Username">
<input type="email" placeholder="Email">
<textarea placeholder="Сообщение..." rows="3"></textarea>
<input type="submit" value="Отправить">
</div>
</form>
HTML
*/

?>

<div class="container">


<form class="decor" action="" method="POST">
<div class="form-left-decoration"></div>
<div class="form-right-decoration"></div>
<div class="circle"></div>
<div class="form-inner">
<!--<label class="" for="eng">Английское слово</label>-->
<h3>Английское слово</h3>
<input class="" type="text" name="eng"><br>

<input class="" type="submit" name="search" value="Найти">
</div>
</form>

<div class="box-link">
<a class="link hover" href="add.php">Добавить новое слово в словарь</a>
</div>

<div class="box-link">
<a class="link hover" href="howords.php">Какие сейчас есть слова в словаре?</a>
</div>



<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){ // если форма отправлена
$eng = htmlspecialchars(trim($_POST['eng'])); // banana

if(!empty($eng)){ // проверяем на то, чтобы не было пусто

// подготавливаем и выполняем запрос к бд на выбор информации по введенному англ слову
$query = "SELECT english, transcription, russian, image
FROM vocabulary
WHERE english=?"; // текст запроса к БД
$query2 = "SELECT COUNT(*) FROM vocabulary";
$result = $pdo->prepare($query); // подготавливаем запрос
$res = $pdo->prepare($query2);
$result->execute([$eng]); // выполняем запрос
$res->execute();

$row = $result->fetch(PDO::FETCH_ASSOC); // забираем строку и кладем в переменную
$riw = $res->fetch(PDO::FETCH_ASSOC);

// вывод данных на страницу
if(!empty($row)){ // если перевод есть
// выводим на сраницу
echo "<h2 class='h2'>Слово: $row[english] - Транскрипция: $row[transcription] - Перевод: $row[russian]</h2>";
echo "<img class='img' src='$row[image]' width='300px' heigth='300px'>";
echo "<h2 class='h2'>Слов сейчас в словаре-".implode("','",$riw)."</h2>";
//echo "a3 is: '".implode("','",$a3)."'<br>";
}else{ // если перевода в таблице нет
echo "<h2 class='h2'>Указанное слово в словаре отсутствует</h2>";
}

}else{
echo "<h2 class='h2'>Введите слово для перевода</h2>";
}
}


?>


</div>
</body>
</html>