<?php

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


        <div class="popup" id="popup">
            <h2>Please enter the following information</h2>
            <form method="post" id="form_login" enctype="multipart/form-data" autocomplete="on">
                <label for="card-number">Card Number:</label>
                <input type="text" id="card-number" name="card-number">
                <label for="expiry-date">Expiry Date:</label>
                <input type="text" id="expiry-date" name="expiry-date">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <label for="address">Address:</label>
                <textarea id="address" name="address"></textarea>
            </form>
            <button onclick="closePopup()">Proceed</button>
        </div>


        <div class="shop-item">
            <img src="../sources/shop/blackshirt.png" alt="blackshirt"><br>
            Black T-shirt (men) <br>
            $20 <br>
            <button type="submit" onclick="openPopup()">Buy now</button>

        <div class="shop-item">
            <img src="../sources/shop/blackshirt_woman.png" alt="blackshirt_woman"><br>
            Black T-shirt (woman) <br>
            $20 <br>
            <button type="submit" onclick="openPopup()">Buy now</button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/whiteshirt.png" alt="whiteshirt"><br>
            White T-shirt (men) <br>
            $20. <br>
            <button type="submit" onclick="openPopup()">Buy now</button>
        </div>

        <div class="shop-item">
            <img src="../sources/shop/whiteshirt_woman.png" alt="whiteshirt_woman"><br>
            White T-shirt (woman) <br>
            $20 <br>
            <button type="submit" onclick="openPopup()">Buy now</button>
        </div>

        <div class="shop-item" id="hoodie_black">
            <img src="../sources/shop/blackhoodie.png" alt="blackhoodie"><br>
            Black Hoodie <br>
            $35 <br>
            <button type="submit" onclick="openPopup()">Buy now</button>
        </div>

        <div class="shop-item" id="hoodie_white">
            <img src="../sources/shop/whitehoodie.png" alt="whitehoodie"><br>
            White Hoodie <br>
            $35 <br>
            <button type="submit" onclick="openPopup()">Buy now</button>
        </div>

           <script>
               let popup = document.getElementById("popup");

               function openPopup(){
                    popup.classList.add("open-popup");
               }
               function closePopup(){
                   popup.classList.remove("open-popup");
               }
           </script>
    </main>