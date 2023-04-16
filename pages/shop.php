<?php
include_once "common/functions.php";
if (isset($_SESSION["username"])){
    switch (true){
        case isset($_POST["men_t-shirt_black"]):
            changer("data/fan_data.json","add_to_cart","men_t-shirt_black;20",$_SESSION["username"]);
            break;
        case isset($_POST["men_t-shirt_white"]):
            changer("data/fan_data.json","add_to_cart","men_t-shirt_white;20",$_SESSION["username"]);
            break;
        case isset($_POST["woman_t-shirt_black"]):
            changer("data/fan_data.json","add_to_cart","woman_t-shirt_black;20",$_SESSION["username"]);
            break;
        case isset($_POST["woman_t-shirt_white"]):
            changer("data/fan_data.json","add_to_cart","woman_t-shirt_white;20",$_SESSION["username"]);
            break;
        case isset($_POST["hoodie_black"]):
            changer("data/fan_data.json","add_to_cart","hoodie_black;35",$_SESSION["username"]);
            break;
        case isset($_POST["hoodie_white"]):
            changer("data/fan_data.json","add_to_cart","hoodie_white;35",$_SESSION["username"]);
    }
}
?>

    <div class="h1-imitator">SHOP</div>
    <main>
        <p class="article-imitator">Dont forget to set the mood with our favorite shopping song:</p>
        <audio class="article-imitator" controls loop id="music">
            <source src="../sources/audio/Rockin'%20Robin.mp3" type="audio/mp3">
            This text appears when your browser does not support embedding audio files.
        </audio>
        <script>
            let audio = document.getElementById("music");
            audio.volume = 0.06;
        </script>

        </div>
        <form method="post" enctype="multipart/form-data">
        <div class="shop-item">
            <img src="../sources/shop/blackshirt.png" alt="blackshirt"><br>
            Black T-shirt (men) <br>
            $20 <br>
            <button type="submit" name="men_t-shirt_black" ><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/blackshirt_woman.png" alt="blackshirt_woman"><br>
            Black T-shirt (woman) <br>
            $20 <br>
            <button type="submit" name="woman_t-shirt_black"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/whiteshirt.png" alt="whiteshirt"><br>
            White T-shirt (men) <br>
            $20. <br>
            <button type="submit" name="men_t-shirt_white"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/whiteshirt_woman.png" alt="whiteshirt_woman"><br>
            White T-shirt (woman) <br>
            $20 <br>
            <button type="submit" name="woman_t-shirt_white"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item" id="hoodie_black">
            <img src="../sources/shop/blackhoodie.png" alt="blackhoodie"><br>
            Black Hoodie <br>
            $35 <br>
            <button type="submit" name="hoodie_black"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item" id="hoodie_white">
            <img src="../sources/shop/whitehoodie.png" alt="whitehoodie"><br>
            White Hoodie <br>
            $35 <br>
            <button type="submit" name="hoodie_white"><?php is_someone_logged(); ?></button>
        </div>
        </form>
           <script>
               let popup = document.getElementById("popup");
               let overlay = document.getElementById("overlay");
               let thanks = document.getElementById("thanks");

               function openPopup(){
                    popup.classList.add("open-popup");
                    overlay.classList.add("overlay-open");
               }
               function closePopup(){
                   popup.classList.remove("open-popup");
                   overlay.classList.remove("overlay-open");
               }
               function openThanks(){
                   thanks.classList.add("open-thanks");
                   overlay.classList.add("overlay-open");
               }
               function closeThanks(){
                   thanks.classList.remove("open-thanks");
                   overlay.classList.remove("overlay-open");
               }
           </script>

    </main>