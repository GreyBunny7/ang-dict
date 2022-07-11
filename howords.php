<?php
require 'bd-conect.php';
/*
    $query_users = "SELECT * FROM users"; // получаем всех пользователей
    $result = $pdo->query($query_users); // выполняем выборку из БД


 // выводим всех пользователей из бд на страницу
 echo '<div class="container">';
 while( $user = $result->fetch(PDO::FETCH_ASSOC) ){
     echo '<div class="box">';
         echo '<p>Имя: '. $user['name'] . '</p>';
         echo '<p>Фамилия: '. $user['last_name'] . '</p>';
         echo '<p>Дата-рождения: '. $user['data_age'] . '</p>';
         echo '<form action="" method="POST">';
             echo '<input type="hidden" name="id" value="'.$user['id'].'">';
             echo '<input type="submit" name="action" value="Удалить">';
         echo '</form>';
     echo '</div>';
 }
 echo '</div>';
 /**
* Если нажата кнопка удалить (тоже отправка формы)
*
if( isset($_POST['action']) && $_POST['action'] === 'Удалить' ){ // если нажата кнопка удалить
    $id = $_POST['id']; // кладем в переменную id удаляемого пользователя
    $query = "DELETE FROM users WHERE id=?"; // строка запроса на удаление
    $result = $pdo->prepare($query); // подготовка запроса
    $result->execute([$id]); // выполнение запроса на удаление пользователя
    }
*/
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Англо-русский словарь</title>
<link rel="icon" type="image/png" href="./images\иконка.png">
<link rel="stylesheet" href="style.css">
<style>
.containers{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}
.box{
    border: 3px solid #ccc;
    width: 360px;
    padding: 10px;
    height: auto;
    margin: 15px;
    border-radius: 7px;
    background-color: whitesmoke;
}
</style>
</head>
<body>
<div class="container">


<form class="decor" action="" method="POST">
<div class="form-left-decoration"></div>
<div class="form-right-decoration"></div>
<div class="circle"></div>
<div class="form-inner">
<!--<label class="" for="eng">Английское слово</label>-->
<h3>Список слов</h3>

</div>
</form>
<?php
    $query_words = "SELECT * FROM vocabulary"; // получаем всех пользователей
    $result = $pdo->query($query_words); // выполняем выборку из БД


    // выводим всех пользователей из бд на страницу
 echo '<div class="containers">';
 while( $words = $result->fetch(PDO::FETCH_ASSOC) ){
     echo '<div class="box">';
         echo '<h2>Слово: '. $words['english'] . '</h2>';
         echo '<h2>Транскрипция: '. $words['transcription'] . '</h2>';
         echo '<h2>Перевод: '. $words['russian'] . '</h2>';
         //echo '<p>Картинка: '. $words['image'] . '</p>';
         echo "<img src='$words[image]' width='300px' heigth='300px'>";
         echo '<form action="" method="POST">';
             echo '<input type="hidden" name="id" value="'.$words['id'].'">';
         echo '</form>';
     echo '</div>';
 }
 echo '</div>';

?>

<?php
/*
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
echo "<h2>Слово: $row[english] - Транскрипция: $row[transcription] - Перевод: $row[russian]</h2>";
echo "<img src='$row[image]' width='300px' heigth='300px'>";
echo "<h2>Слов сейчас в словаре-".implode("','",$riw)."</h2>";
//echo "a3 is: '".implode("','",$a3)."'<br>";
}else{ // если перевода в таблице нет
echo '<h2>Указанное слово в словаре отсутствует</h2>';
}

}else{
echo '<h2>Введите слово для перевода</h2>';
}
}

*/
?>
<div class="box-link">
    <a class="link hover" href="index.php">Перейти к поиску слов</a>
    </div>

</body>
</html>