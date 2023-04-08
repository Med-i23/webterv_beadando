<?php
include_once "common/functions.php";

$users = load_data("data/fan_data.json");
$admin = false;
foreach ($users["users"] as $user) {
    if ($user["username"] === $_SESSION["username"] && $user["privilege"] === "admin") {
        $admin = true;
    }
}


?>

<div class="h1-imitator">Account management</div>
<main>
    <h4>You are <?php echo $_SESSION["username"];
        if ($admin){
            echo " (Administrator)";
        }?><br></h4>
    <section class="article-imitator">
        <form method="post">
            <div class="flex-box">
                <div class="card_1">
                    <?php
                    if ($admin) {
                        ?>
                        <button name="manage_users_b">Manage users</button>

                        <?php
                    }
                    ?>

                    <button name="change_username_b">Change username</button>

                    <button name="change_password_b">Change password</button>

                    <button name="change_email_b">Change email</button>

                    <button name="find_user_b">Find user</button>

                    <button name="add_friend_b">Add friend</button>

                    <button name="remove_friend_b">Remove friend</button>

                    <button name="received_messages_b">Messages</button>

                    <button name="send_messages_b">Send message</button>

                    <button name="shopping_cart_b">Shopping cart</button>

                    <button name="idk">Beer</button>

                    <button name="idk">Fire Water</button>

                    <button name="idk">Saxof</button>

                    <button name="idk">Construction</button>

                    <button name="idk">Klomel</button>

                    <button name="idk">Felis</button>
                </div>
                <div class="card_2">
                    <?php

                    $user_data = [];
                    $usernames = [];
                    $friends = [];
                    $messages = [];
                    $cart = [];
                    $username_errors = [];

                    foreach ($users["users"] as $user) {
                        array_push($usernames, $user["username"]);
                    }
                    foreach ($users["users"] as $user) {
                        if ($_SESSION["username"] === $user["username"])
                            $friends = $user["friends"];
                    }
                    if (isset($_POST["change_username"])) {
                        if (username_longness($_POST["username_changed"]) === "" && empty_username_check($_POST["username_changed"]) === "" && duplicate_username_check($_POST["username_changed"]) === "") {
                            foreach ($users["users"] as $user) {
                                if ($user["username"] === $_SESSION["username"]) {
                                    $user["username"] = $_POST["username_changed"];
                                    $_SESSION["username"] = $_POST["username_changed"];
                                    changer("data/fan_data.json", $user);
                                }
                            }
                        }else{
                                ?>
                                <div class="error">
                                    Username might be duplicate or has too many characters
                                </div>
                                    <?php
                        }

                    }
                    switch (true) {
                        case isset($_POST["manage_users_b"]):
                            foreach ($usernames as $username) {
                                echo $username;
                            }
                            break;
                        case isset($_POST["change_username_b"]):

                            ?>
                            <form method="post">
                                <label for="username_change" class="label-required">
                                    The new username:
                                    <input type="text" maxlength="30" name="username_changed" required>
                                </label>
                                <button name="change_username">Change username</button>
                            </form>
                            <?php
                            break;
                        case isset($_POST["change_password_b"]):

                            break;
                        case isset($_POST["change_email_b"]):

                            break;
                        case isset($_POST["find_user_b"]):

                            break;
                        case isset($_POST["add_friend_b"]):

                            break;
                        case isset($_POST["remove_friend_b"]):

                            break;
                        case isset($_POST["received_messages_b"]):

                            break;
                        case isset($_POST["send_messages_b"]):

                            break;
                        case isset($_POST["shopping_cart_b"]):

                            break;


                    }

                    ?>
                </div>
            </div>
        </form>
    </section>
</main>
