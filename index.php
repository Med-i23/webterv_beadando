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
    <div class="h1-imitator">Welcome to Ergo!</div>
    <a id="anchor-arrow__link" href="#header"><img src="sources/websiteElement/arrow-down.png" alt="arrow"></a>
    <main>
            <section>
                   <h2 class="main-old">Upcoming matches</h2>
                   <table>
                       <thead>
                       <tr>
                           <th id="date-up">Date</th>
                           <th id="game-up">Game</th>
                           <th id="name-up">Name</th>
                           <th id="against-up">Against</th>
                           <th id="ending-up">Ending</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td headers="date-up" class="cancelled">Cancelled</td>
                           <td headers="game-up"><img src="sources/csgo/csgo_minilogo2.png" alt="csgologo" class="table-logo">CS:GO</td>
                           <td headers="name-up"><del>Katowice 2023</del></td>
                           <td headers="against-up"><del>Cerberus gaming</del></td>
                           <td headers="ending-up" class="cancelled">Cancelled</td>
                       </tr>
                       <tr>
                           <td headers="date-up">2023. 04. 15.</td>
                           <td headers="game-up"><img src="sources/RL/rl_minilogo.png" alt="rllogo" class="table-logo">Rocket League</td>
                           <td headers="name-up"> Bubby contest 2023</td>
                           <td headers="against-up">Sportsy-Boys</td>
                           <td headers="ending-up">?</td>
                       </tr>
                       <tr>
                           <td headers="date-up">2023. 04. 26.</td>
                           <td headers="game-up"><img src="sources/csgo/csgo_minilogo2.png" alt="csgologo" class="table-logo">CS:GO</td>
                           <td headers="name-up">Cherubaka Spring-Cup 2023</td>
                           <td headers="against-up">Cerberus gaming</td>
                           <td headers="ending-up">?</td>
                       </tr>
                       </tbody>
                   </table>
                   <a href="matches.php" class="new-page">more ></a>
               </section>

        <section>
            <h2 class="main-old">News</h2>

                <div class="picture">
                    <img src="sources/csgo/csgonews.jpg" alt="csgo" title="csgo">
                </div>
                <article>
                    <h2>Team Ergo wins semi-finals against Crozhair gaming</h2>

                        Our national csgo team was successfull in competing in the Cherubaka 2023 Spring-Cup semi-finals and winning against the competition.
            </article>
            <a href="news.php" class="new-page">more ></a>
        </section>

        <section>
            <h2 class="main-old">Shop</h2>
            <h4>Hot new items this spring!</h4>
            <div class="shop-item">
                <img src="sources/shop/blackhoodie.png" alt="blackhoodie"><br>
                Black Hoodie<br>
                $35 <br>
                <a href="shop.php" class="new-page">Check out</a>
            </div>

            <div class="shop-item">
                <img src="sources/shop/whitehoodie.png" alt="whitehoodie"><br>
                White Hoodie <br>
                $35 <br>
                <a href="shop.php" class="new-page">Check out</a>
            </div>
        </section>
        <section>
            <h2 class="main-old">About</h2>

            <div class="picture">
                <img src="sources/csgo/csgoteam.jpg" title="team" alt="team">
            </div>
            <article>
                <h2>Origins</h2>
                Ergo was founded by a few high school friends back in 2018 in Peacefull County.
                It started with a local school tournament, and it hasn't stopped since.
                We were playing at the time with one team and only played CSGO. In 2020 due to Covid outbreak we are forced to play house matches with small prizes.
                But it hasn't stopped our ability to grow. We have made two more teams in two different games. In November 2020 we have formed our
                Valorant and Rocket League divisions. They have been striving ever since. As of today, our teams have won 8 tournaments and 24 small cups
                divided between teams, AND we are opening a cat division too. We are looking forward for our future and hope you can tag along with us in this journey.
            </article>
        </section>

    </main>
   <footer>©2023 Ergo Inc. All rights reserved.</footer>
</body>
</html>