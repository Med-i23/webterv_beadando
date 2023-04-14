<?php
include_once "common/functions.php";

$users = load_data("data/fan_data.json");
$admin = false;
foreach ($users["users"] as $user) {
    if ($user["username"] === $_SESSION["username"] && $user["privilege"] === "admin") {
        $admin = true;
    }
}
const DEFAULT_PROFILE_PIC = "sources/profiles/cot.png"


?>

<div class="h1-imitator">Account management</div>
<main>
    <h4>You are <?php echo $_SESSION["username"];
        if ($admin) {
            echo " (Administrator)";
        } ?><br></h4>
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

                </div>
                <div class="card_2">

                    <?php
                    $user_data = [];
                    $usernames = [];
                    $friends = [];
                    $messages = [];
                    $cart = [];
                    $username_errors = [];
                    if ($admin && isset($_POST["manage_users_b"])) {
                        foreach ($users["users"] as $user) {
                            if ($user !== null)
                                echo "<div><form method='post'><input type='text' name='the_managable' value='" . $user["username"] . "'  style='pointer-events: none;' >
                                <button class='error' name='bann'>Bann</button>
                                <button class='success' name='pardon'>Pardon</button>
                                </form></div>
                            ";

                            ?>


                            <?php
                        }
                    }
                    if (isset($_POST["bann"])) {
                        foreach ($users["users"] as $user) {
                            if ($_POST["the_managable"] === $user["username"]) {
                                changer("data/fan_data.json", "bann", $_POST["the_managable"], $_POST["the_managable"]);
                            }

                        }
                    }
                    if (isset($_POST["pardon"])) {
                        foreach ($users["users"] as $user) {
                            if ($_POST["the_managable"] === $user["username"]) {
                                changer("data/fan_data.json", "pardon", $_POST["the_managable"], $_POST["the_managable"]);
                            }

                        }
                    }
                    foreach ($users["users"] as $user) {
                        if ($_SESSION["username"] === $user["username"])
                            $friends = $user["friends"];
                    }
                    $found = false;
                    if (isset($_POST["change_username"])) {
                        if (username_longness($_POST["username_changed"]) === "" && empty_username_check($_POST["username_changed"]) === "" && duplicate_username_check($_POST["username_changed"]) === "") {
                            foreach ($users["users"] as $user) {
                                if ($user["username"] === $_SESSION["username"]) {
                                    changer("data/fan_data.json", "username", $_POST["username_changed"], $_SESSION["username"]);
                                    $_SESSION["username"] = $_POST["username_changed"];
                                    header("Refresh: 5");
                                    echo "<div class='success'>
                                    Username changed successfully!
                                    </div>";
                                    $found = true;
                                    break;
                                }
                            }

                        } else {
                            echo "<div class='error'>
                            Username might have been occupied, or has too many characters!
                            </div>";
                        }
                        if ($found){

                        }

                    } else if (isset($_POST["change_password"])) {
                        if (password_acceptance($_POST["password_changed"]) === "" && password_match($_POST["password_changed"], $_POST["password_changed_check"]) === "" && empty_password_check($_POST["password_changed"]) === "") {
                            foreach ($users["users"] as $user) {
                                if ($user["username"] === $_SESSION["username"]) {
                                    changer("data/fan_data.json", "password", $_POST["password_changed"], $_SESSION["username"]);
                                    echo "<div class='success'>Your password has been successfully changed!</div>";
                                    break;
                                } else {
                                    echo "<div class='error'>Your password does not meet the requirements!</div>";
                                }
                            }
                        }
                    } else if (isset($_POST["change_email"])) {
                        if (empty_email_check($_POST["email_changed"]) === "" && duplicate_email_check($_POST["email_changed"]) === "") {
                            foreach ($users["users"] as $user) {
                                if ($user["username"] === $_SESSION["username"]) {
                                    changer("data/fan_data.json", "email", $_POST["email_changed"], $_SESSION["username"]);
                                    echo "<div class='success'>Your email has been successfully changed!</div>";
                                    break;
                                }
                            }
                        } else {
                            echo "<div class='error'>Your email might have been occupied, or you did not fill this field!</div>";
                        }

                    } else if (isset($_POST["user_find"])) {
                        $exist = false;
                        foreach ($users["users"] as $user) {
                            if ($user["username"] === $_POST["find_user"]) {
                                echo "Name : " . $user["username"] . "<br>";
                                echo $user["status"] === "banned" ? "<div class='error'> Status: " . $user["status"] . "</div>" : "<div class='success'> Status: " . $user["status"] . "</div>";
                                $exist = true;
                            }
                        }
                        if (!$exist) {
                            echo "<div class='error'>This user does not exist!</div>";
                        }
                    }

                    switch (true) {
                        case isset($_POST["change_username_b"]):

                            ?>
                            <form method="post" onsubmit="return false;" enctype="multipart/form-data">
                                <label for="username_changed" class="label-required">
                                    The new username:
                                    <input type="text" maxlength="30" name="username_changed">
                                </label>
                                <button name="change_username">Change username</button>
                            </form>
                            <?php
                            break;
                        case isset($_POST["change_password_b"]):
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <label for="password_changed" class="label-required">
                                    The new password:
                                    <input type="password" maxlength="20" name="password_changed">
                                </label>
                                <br>
                                <label for="password_changed_check" class="label-required">
                                    The new password again:
                                    <input type="password" maxlength="20" name="password_changed_check">
                                </label>
                                <br>
                                <button name="change_password">Change password</button>
                            </form>
                            <?php
                            break;
                        case isset($_POST["change_email_b"]):
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <label for="email_changed" class="label-required">
                                    The new email:
                                    <input type="email" name="email_changed">
                                </label>
                                <button name="change_email">Change email</button>
                            </form>
                            <?php
                            break;
                        case isset($_POST["find_user_b"]):
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <label for="find_user" class="label-required">
                                    The username:
                                    <input type="search" maxlength="30" name="find_user">
                                </label>
                                <button name="user_find">Find user</button>
                            </form>

                            <?php
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
