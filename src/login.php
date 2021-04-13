<?php

require_once 'index-db-classes.inc.php';
require_once 'config.inc.php';
require_once 'styles.php';

if (isset($_SESSION['user'])) {
    header("Location: /");
    exit;
}
$error = '';
//now check if page has been submitted with a user/password, then verify that combo
if (isset($_POST['username'], $_POST['password'])) {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
    $newSession = new SessionManager($conn);
    if ($newSession->login($_POST['username'], $_POST['password'])) {
        header("Location: /");
        die();
    } else {
        $error = "Failed to log in, please try again";
    }
}

function generateDisplay($error)
{ ?>
    <main class="csBox with-backgound">
        <div id="csBlock">
            <h2> Log In</h2>
            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                <div class="login-block"><label for="username">Username: </label>
                <input class="login-input" type="text" id="username" name="username"></div>

                <div class="login-block"><label for="password">Password: </label>
                <input class="login-input" type="password" id="password" name="password"></div>
                <input type="submit" value="Sign In">
                <input type="submit" value="Cancel">
                <div class="error"><?= $error ?></div>
            </form>
        </div>
    </main>
<?php

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
    <?php randBackground(); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php generateDisplay($error) ?>
</body>

</html>