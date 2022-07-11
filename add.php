<?php
require 'bd-conect.php';

//d($_POST); // тестовый вывод массива $_POST
//d($_FILES); // тестовый вывод массива $_FILES

if($_SERVER['REQUEST_METHOD'] === 'POST'){ // если отпр форма

    if( !empty($_POST['eng']) && !empty($_POST['rus']) ){ // проверяем, что поля не пустые

        // обезвреживаем
        $eng = htmlspecialchars(trim($_POST['eng']));
        $trans = htmlspecialchars(trim($_POST['trans']));
        $rus = htmlspecialchars(trim($_POST['rus']));

        $image = $_FILES['image']; // получаем массив с картинкой

        // проверяем наличие файла и если есть кладем в папку images
        if( !empty($image['name']) ){ // если картинка прикреплена
            $image['name'] = 'images/' .$eng.'_'.$image['name']; // собираем реальный путь файла
            move_uploaded_file($image['tmp_name'], $image['name']); // перемещаем файл из временного хранилища
        } else {
            $image['name'] = null;
        }

        // если транскрипция не задана
        if(empty($trans)){
            $trans = null;
        }

        // добавляем данные в БД
        $query = "INSERT INTO vocabulary VALUES(?, ?, ?, ?, ?)";
        $result = $pdo->prepare($query);
        $result->execute([null, $eng, $trans, $rus, $image['name']]);
        header('Location: add.php');

    } else{ // если поля не заполнены
        echo '<h3>Введите английское слово и перевод</h3>';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавление нового слова в словарь</title>
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


    <h2 class="mrl h2">Добавление слова в словарь</h2>
    <form class="decor" action="" method="POST" enctype="multipart/form-data">
    <div class="form-left-decoration"></div>
    <div class="form-right-decoration"></div>
    <div class="circle"></div>
    <div class="form-inner">

        <h3>Английское слово:</h3>

        <input type="text" name="eng">

        <h3>Транскрипция:</h3>

        <input type="text" name="trans">

        <h3>Русское слово:</h3>
        
        <input type="text" name="rus">

        <h3>Изображение:</h3>

        <input type="file" name="image">

        <input type="submit" name="add" value="Добавить слово в словарь">

    </div>

    </form>

    <div class="box-link">
    <a class="link hover" href="index.php">Перейти к поиску слов</a>
    </div>


</body>
</html>