<?php
include_once "common/functions.php";
why_are_you_here();
$canIdoIt = false;

?>

<div class="h1-imitator">Shopping Cart</div>
<main>
    <section>
        <div class="card"><a href="index.php?page=account">< Back</a></div>
        <div class="card_3">
            <ul>
                <?php
                global $sum;
                function extracted($users1): void
                {
                    global $sum;
                    $every_item = [];
                    $sum = 0;
                    foreach ($users1 as $user) {
                        if ($_SESSION["username"] === $user["username"]) {
                            foreach ($user["cart"] as $item) {
                                $every_item[] = explode(";", $item);
                            }
                        }
                    }
                    foreach ($every_item as $item) {
                        echo "<li><form method='post'>" . "<input type='text' name='removable_item' style='pointer-events: none' value='";
                        echo $item[0] . " $" . $item[1] . "' >" . "<button name='remove'>Remove</button></form></li>";
                        $sum += $item[1];

                    }
                    if (isset($_POST["remove"])) {
                        $temRay = explode(" $", $_POST["removable_item"]);
                        $madeUp = $temRay[0] . ";" . $temRay[1];
                        changer("data/fan_data.json", "remove_from_cart", $madeUp, $_SESSION["username"]);

                    }

                }

                $users = load_data("data/fan_data.json");
                extracted($users["users"]);

                ?>

            </ul>
            <?php echo "<div class='success'>Your total is: $" . $sum ?>
            <button name="cash_out" onclick="openPopup()">Cash out</button>
            <?php echo "</div>"; ?>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup" id="popup">
                <div class="exit_press" onclick="closePopup()">X</div>
                <h2>Please enter the following information</h2>
                <form method="post" id="form_popup" enctype="multipart/form-data" autocomplete="on">
                    <fieldset>
                        <label>Payment</label>
                        <label for="card_number">Card Number:</label>
                        <input type="text" id="card_number" name="card_number" minlength="10" maxlength="14"
                               placeholder="1111222233334444">
                        <label>Expiry Date:</label>
                        <div>
                            <label>
                                <input type="text" name="expiry-date_d" maxlength="2" size="2"
                                       placeholder="00">
                            </label>
                            <label>
                                <input type="text" name="expiry-date_m" maxlength="2" size="2"
                                       placeholder="00">
                            </label>
                        </div>
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="123">
                        <label for="name">Cardholder Name:</label>
                        <input type="text" id="name" name="name" placeholder="Your Name" minlength="1">
                        <label>Address</label>
                        <label for="zip">Zip code:</label>
                        <input type="text" id="zip" name="zip" placeholder="1234">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="City name">
                        <label for="street">Street and house number:</label>
                        <input type="text" id="street" name="street" placeholder="Example Street. 15.">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="youremail@mail.com">
                    </fieldset>
                </form>
                <button onclick="<?php echo !$canIdoIt ? "closePopup(); openThanks();" : "closePopup()" ?>"
                        name="proceed_purchase">
                    Proceed
                </button>





            </div>
            <div class="thanks" id="thanks">
                <img src="sources/websiteElement/checkmark.png" alt="checkmark" width="60">
                <h2>Thank you for your purchase!</h2>
                <div>We will send will you an email with the necessary information.</div>
                <div class="error"><a class="error" target="_blank" href="https://youtu.be/dQw4w9WgXcQ">Sadly cash out is currently unavailable, our team is working on the problem, while you wait try to click on this text</a></div>
                <button onclick="closeThanks()">Close</button>
            </div>
        </div>
        <script>
            let popup = document.getElementById("popup");
            let overlay = document.getElementById("overlay");
            let thanks = document.getElementById("thanks");

            function openPopup() {
                popup.classList.add("open-popup");
                overlay.classList.add("overlay-open");
            }

            function closePopup() {
                popup.classList.remove("open-popup");
                overlay.classList.remove("overlay-open");
            }

            function openThanks() {
                thanks.classList.add("open-thanks");
                overlay.classList.add("overlay-open");
            }

            function closeThanks() {
                thanks.classList.remove("open-thanks");
                overlay.classList.remove("overlay-open");
            }
        </script>
    </section>
</main>

