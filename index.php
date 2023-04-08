<?php
session_start();

if (isset($_POST["accept_cookies"])){
    setcookie("use_cookies", "accepted", time() + (60*60*24*10));
    header("Refresh: 0");
}
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php?page=loginregister");
}

$page = $_GET["page"] ?? "main";
?>
<!DOCTYPE html>
<html lang="en">
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
        <div>
            <a id="login-signup__pic-link" href="index.php?page=cart"><img src="sources/websiteElement/cart.jpg" alt="account" id="cart_pic" width="90"></a>
        </div>
        <div id="sign-os" class="upper">
            <?php
                if (!isset($_SESSION["username"])){
                    ?>
                    <a id="login-signup__pic-link" href="index.php?page=loginregister"><img src="sources/websiteElement/account.png" alt="account" id="login-signup__pic" width="40"></a>
            <a href="index.php?page=loginregister" id="login"
               class=" <?php echo $page === "loginregister" ? "active" : ""; ?>">
                Login/Signup</a>

            <?php
             }else{
            ?>
            <a id="login-signup__pic-link" href="index.php?page=account"><img src="sources/websiteElement/account.png" alt="account" id="login-signup__pic" width="40"></a>
            <a href="index.php?logout" id="login">Log out</a>
            <?php
            }
            ?>

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
<?php
if (!isset($_COOKIE["use_cookies"])){
?>

    <div id="cookies">
        <form method="post">
            This website uses cookies you must accept them for your own benefits. <button  name="accept_cookies">Accept</button>
        </form>
    </div>
<?php }?>

<a id="anchor-arrow__link" href="#header"><img src="sources/websiteElement/arrow-down.png" alt="arrow"></a>
<?php
include_once "pages/$page.php";
?>

<footer>©2023 Ergo Inc. All rights reserved.</footer>
</body>
</html>