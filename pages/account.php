<?php
include_once "common/functions.php";
$users = load_data("data/fan_data.json");
$admin = false;
foreach ($users["users"] as $user){
    if ($user["username"] === $_SESSION["username"] && $user["privilege"] === "admin"){
        $admin=true;
    }
}


?>

<div class="h1-imitator">Account management</div>
<main>
    <section class="article-imitator">
        <form method="post">
        <div class="flex-box">
            <div class="card_1">
            <?php
            if (isset($_SESSION["username"]) && $admin){
                ?>
                    <button name="manage_users">Manage users</button>

                <?php
            }
                ?>

                <button name="change_username">Change username</button>

                <button name="change_password">Change password</button>

                <button name="change_email">Change email</button>

                <button name="find_user">Find user</button>

                <button name="add_friend">Add friend</button>

                <button name="remove_friend">Remove friend</button>

                <button name="received_messages">Messages</button>

                <button name="send_messages">Send message</button>

                <button name="shopping_cart">Shopping cart</button>

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
                foreach ($users["users"] as $user){
                    array_push($usernames, $user["username"]);
                }
                foreach ($users["users"] as $user){
                    if ($_SESSION["username"] === $user["username"])
                    $friends = $user["friends"];
                }
                switch (true){
                    case isset($_POST["manage_users_b"]):
                        foreach ($usernames as $username){
                            echo $username;
                        }
                        break;
                    case isset($_POST["change_username_b"]):
                        ?>
                    <form method="post">
                        <label for="username_change" class="label-required">
                            The new username:
                        <input type="text" maxlength="30" name="username_change" required>
                        </label>
                        <button name="change_username">Change username</button>
                    </form>

                <?php
                    if (isset($_POST["change_username"])){

                    }
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
