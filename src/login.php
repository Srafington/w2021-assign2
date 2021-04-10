<?php


if (isset($_SESSION['user'])) {
    header("Location: /");
    exit;
}

//now check if page has been submitted with a user/password, then verify that combo

?>

<style>
    <?php include "index.css"; ?>
</style>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Sign In</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>

    <form action="login/php">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <label for="password">Password: </label>
        <input type="passowrd" id="passowrd" name="passowrd">
        <input type="submit"   value="Sign In">

    </form>

</body>