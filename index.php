<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Привет! Это страница нового проекта</title>
        <link rel="stylesheet" type="text/css" href="lib/scripts/style.css">
        <link rel="icon" type="image/x-icon" href="lib/images/icon.jpg">
    </head>
    <body>
        <header class="menu">
            <li><a href="#"></a></li>
        </header>
        <form action="engine.php" method="post">
            <input name="pass" type="text" placeholder="Код доступа">
            <input name="info" type="text" placeholder="JSON игрока">
            <input name="id" type="text" placeholder="ID игрока">
            <input name="submit" type="submit" value="Получить данные">
        </form> <br> <br>
        <a href="lib/players/">Посмотреть библиотеку игроков</a>
        <script src="lib/scripts/main.js"></script>
    </body>
</html>