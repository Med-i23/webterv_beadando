<?php
include_once "common/functions.php";
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

        <div class="overlay" id="overlay">
        <div class="popup" id="popup">
            <div class="X" onclick="closePopup()">X</div>
            <h2>Please enter the following information</h2>
            <form method="post" id="form_login" enctype="multipart/form-data" autocomplete="on">
                <fieldset>
                <label for="payment">Payment</label>
                <label for="card-number">Card Number:</label>
                <input type="text" id="card-number" name="card-number" minlength="16" maxlength="16" placeholder="1111222233334444">
                <label for="expiry-date">Expiry Date:</label>
                    <div>
                <input type="text" id="expiry-date" name="expiry-date" maxlength="2" size="2" placeholder="00"> /
                    <input type="text" id="expiry-date" name="expiry-date" maxlength="2" size="2" placeholder="00">
                    </div>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123">
                <label for="name">Cardholder Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" minlength="1">
                <label for="address">Address</label>
                    <label for="address">Zip code:</label>
                    <input type="text" id="zip" name="zip" placeholder="1234">
                    <label for="address">City:</label>
                    <input type="text" id="city" name="city" placeholder="City name">
                    <label for="address">Street and house number:</label>
                    <input type="text" id="street" name="street" placeholder="Example Street. 15.">
                    <label for="address">Email:</label>
                    <input type="text" id="email" name="email" placeholder="youremail@mail.com">
                </fieldset>
            </form>
            <button onclick="closePopup(); openThanks()" name="proceed_purchase">Proceed</button>


        </div>
            <div class="thanks" id="thanks">
                <img src="sources/websiteElement/checkmark.png" alt="checkmark" width="60">
                <h2>Thank you for your purchase!</h2>
                <div>We will send will you an email with the necessary information.</div>
                <button onclick="closeThanks()">Close</button>
            </div>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/blackshirt.png" alt="blackshirt"><br>
            Black T-shirt (men) <br>
            $20 <br>
            <button type="submit" name="men_t-shirt_black" onclick="openPopup()"><?php is_someone_logged(); ?></button>

        <div class="shop-item">
            <img src="../sources/shop/blackshirt_woman.png" alt="blackshirt_woman"><br>
            Black T-shirt (woman) <br>
            $20 <br>
            <button type="submit" name="woman_t-shirt_black" onclick="openPopup()"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/whiteshirt.png" alt="whiteshirt"><br>
            White T-shirt (men) <br>
            $20. <br>
            <button type="submit" name="men_t-shirt_white" onclick="openPopup()"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/whiteshirt_woman.png" alt="whiteshirt_woman"><br>
            White T-shirt (woman) <br>
            $20 <br>
            <button type="submit" name="woman_t-shirt_white" onclick="openPopup()"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item" id="hoodie_black">
            <img src="../sources/shop/blackhoodie.png" alt="blackhoodie"><br>
            Black Hoodie <br>
            $35 <br>
            <button type="submit" name="hoodie_black" onclick="openPopup()"><?php is_someone_logged(); ?></button>
        </div>

        <div class="shop-item" id="hoodie_white">
            <img src="../sources/shop/whitehoodie.png" alt="whitehoodie"><br>
            White Hoodie <br>
            $35 <br>
            <button type="submit" name="hoodie_white" onclick="openPopup()"><?php is_someone_logged(); ?></button>
        </div>
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