<?php
session_start();
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php?page=loginregister");
}

$page = $_GET["page"] ?? "main";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="sources/websiteElement/favicon.ico">
    <title>Ergo Inc.</title>
</head>
<body>
<header id="header">
    <nav>
        <div id="logo-er" class="upper">
            <img class="logo" src="sources/websiteElement/logo_white.png" alt="ergo-logo" title="Ergo Inc."
                 height="100">
            <label class="ergo-icon__text">&nbsp;&nbsp;&nbsp;Ergo Inc.</label>
        </div>
        <div id="sign-os" class="upper">
            <?php
            if (!isset($_SESSION["username"])) {
                ?>
                <a href="index.php?page=loginregister"
                   class="login" <?php echo $page === "loginregister" ? "class=active" : ""; ?>>Login/Signup</a>
                <?php
            } else {
                ?>
                <a href="index.php?logout" class="login">Log out</a>
                <?php

            }
            ?>

            <a id="login-signup__pic-link" href="index.php?page=loginregister"><img
                        src="sources/websiteElement/account.png" alt="account" id="login-signup__pic" width="40"></a>
        </div>
        <ul>
            <li><a href="index.php?page=main" <?php echo $page === "main" ? "class=active" : ""; ?>>Main</a></li>
            <li><a href="index.php?page=news" <?php echo $page === "news" ? "class=active" : ""; ?>>News</a></li>
            <li><a href="index.php?page=matches" <?php echo $page === "matches" ? "class=active" : ""; ?>>Matches</a>
            </li>
            <li><a href="index.php?page=shop" <?php echo $page === "shop" ? "class=active" : ""; ?>>Shop</a></li>
            <li><a href="index.php?page=teams" <?php echo $page === "teams" ? "class=active" : ""; ?>>Teams</a></li>
        </ul>
    </nav>
</header>

<a id="anchor-arrow__link" href="#header"><img src="sources/websiteElement/arrow-down.png" alt="arrow"></a>
<?php
include_once "pages/$page.php";
?>

<footer>©2023 Ergo Inc. All rights reserved.</footer>
</body>
</html>