<?php session_start() ?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب کاربری</title>
    <link rel="stylesheet" href="asset/style.css">
</head>

<body>
<?php if (isset($_SESSION['login'])) : ?>
        <?= "You are login" ?>
    <?php else : ?>
        <div class='main'>
            <h1>login men</h1>
            <form action="process.php" method="post">
                <input type="text" name="username" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    <?php endif; ?>
</body>

</html>
