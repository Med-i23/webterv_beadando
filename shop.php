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

    <header>
        <nav>
            <div id="logo-er" class="upper">
                <img class="logo" src="sources/websiteElement/logo_white.png" alt="ergo-logo" title="Ergo Inc." height="100">
                <label class="ergo-icon__text" >&nbsp;&nbsp;&nbsp;Ergo Inc.</label>
            </div>
            <div id="sign-os" class="upper">
                <a href="loginregister.php" id="login">Login/Signup</a>
                <a id="login-signup__pic-link" href="loginregister.php"><img src="sources/websiteElement/account.png" alt="account" id="login-signup__pic" width="40"></a>
            </div>
            <ul>
                <li><a href="index.php">Main</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="matches.php">Matches</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="teams.php">Teams</a></li>
            </ul>
        </nav>
    </header>
    <div id="header" class="h1-imitator">SHOP</div>
   <a id="anchor-arrow__link" href="#header"><img src="sources/websiteElement/arrow-down.png" alt="arrow"></a>
    <main>
        <p class="article-imitator">Dont forget to set the mood with our favorite shopping song:</p>
        <audio class="article-imitator" controls loop id="music">
            <source src="sources/audio/Rockin'%20Robin.mp3" type="audio/mp3">
            This text appears when your browser does not support embedding audio files.
        </audio>
        <script>
            let audio = document.getElementById("music");
            audio.volume = 0.06;
        </script>
        <div class="shop-item">
            <img src="sources/shop/blackshirt.png" alt="blackshirt"><br>
            Black T-shirt (men) <br>
            $20 <br>
            <input type="button" value="Add to cart">
        </div>

        <div class="shop-item">
            <img src="sources/shop/blackshirt_woman.png" alt="blackshirt_woman"><br>
            Black T-shirt (woman) <br>
            $20 <br>
            <input type="button" value="Add to cart">
        </div>

        <div class="shop-item">
            <img src="sources/shop/whiteshirt.png" alt="whiteshirt"><br>
            White T-shirt (men) <br>
            $20. <br>
            <input type="button" value="Add to cart">
        </div>

        <div class="shop-item">
            <img src="sources/shop/whiteshirt_woman.png" alt="whiteshirt_woman"><br>
            White T-shirt (woman) <br>
            $20 <br>
            <input type="button" value="Add to cart">
        </div>

        <div class="shop-item">
            <img src="sources/shop/blackhoodie.png" alt="blackhoodie"><br>
            Black Hoodie <br>
            $35 <br>
            <input type="button" value="Add to cart">
        </div>

        <div class="shop-item">
            <img src="sources/shop/whitehoodie.png" alt="whitehoodie"><br>
            White Hoodie <br>
            $35 <br>
            <input type="button" value="Add to cart">
        </div>
    </main>
    <footer id="footer">©2023 Ergo Inc. All rights reserved.</footer>
</body>
</html>