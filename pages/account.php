<?php
include_once "common/functions.php";
why_are_you_here();

$users = load_data("data/fan_data.json");
$admin = false;
foreach ($users["users"] as $user) {
    if ($user["username"] === $_SESSION["username"] && $user["privilege"] === "admin") {
        $admin = true;
    }
}
//const DEFAULT_PROFILE_PIC = "sources/profiles/cot.png"

if (isset($_POST["shopping_cart_b"])) {
    header("Location: index.php?page=cart");
}

?>

<div class="h1-imitator">Account management</div>
<main>

    <section class="article-imitator">
        <h4>You are <?php echo $_SESSION["username"];
            if ($admin) {
                echo " (Administrator)";
            } ?><br></h4>
        <div class="flex-box">
            <div class="card_1">
                <form method="post">
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

                    <button name="friends_b">Friends</button>

                    <button name="received_messages_b">Messages</button>

                    <button name="shopping_cart_b">Shopping cart</button>

                </form>
                <button name="account_delete_b" onclick="openPopup()">Delete account</button>
            </div>
            <div class="overlay" id="overlay">
                <div class="popup" id="popup">
                    <div class="exit_press" onclick="closePopup()">X</div>
                    <h2>Are you sure about that?</h2>
                    <form method="post" id="form_popup" enctype="multipart/form-data" autocomplete="on">
                        <button name="yes">YES</button>
                        <button onclick="closePopup()" name="no">NO</button>
                    </form>
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
                                echo "<div><form method='post'><input type='text' name='the_manageable' value='" . $user["username"] . "'  style='pointer-events: none;' >
                                <button class='error' name='bann'>Bann</button>
                                <button class='success' name='pardon'>Pardon</button>
                                </form></div>
                            ";
                        }
                    }
                    if (isset($_POST["bann"])) {
                        foreach ($users["users"] as $user) {
                            if ($_POST["the_manageable"] === $user["username"]) {
                                changer("data/fan_data.json", "bann", $_POST["the_manageable"], $_POST["the_manageable"]);
                            }

                        }
                    }
                    if (isset($_POST["pardon"])) {
                        foreach ($users["users"] as $user) {
                            if ($_POST["the_manageable"] === $user["username"]) {
                                changer("data/fan_data.json", "pardon", $_POST["the_manageable"], $_POST["the_manageable"]);
                            }

                        }
                    }
                    foreach ($users["users"] as $user) {
                        if ($_SESSION["username"] === $user["username"])
                            $friends = $user["friends"];
                    }
                    if (isset($_POST["change_username"])) {
                        if (username_longness($_POST["username_changed"]) === "" && empty_username_check($_POST["username_changed"]) === "" && duplicate_username_check($_POST["username_changed"]) === "") {
                            foreach ($users["users"] as $user) {
                                if ($user["username"] === $_SESSION["username"]) {
                                    changer("data/fan_data.json", "username", $_POST["username_changed"], $_SESSION["username"]);
                                    $_SESSION["username"] = $_POST["username_changed"];
                                    header_remove("Location: index.php?page=cart");
                                    header("Refresh: 0");
                                    echo "<div class='success'>
                                    Username changed successfully!
                                    </div>";

                                }
                            }

                        } else {
                            echo "<div class='error'>
                            Username might have been occupied, or has too many characters!
                            </div>";
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

                                $_SESSION["savedUser"] = $user;
                                echo "Name : " . $user["username"] . " |";
                                echo $user["status"] === "banned" ? "<div class='error'>&nbsp; Status: " . $user["status"] . "</div><br>" : "<div class='success'> Status: " . $user["status"] . "</div>";
                                echo "<form method='post'><button name='friend_add'>Add friend</button></form>";
                                $exist = true;
                            }
                        }

                        if (!$exist) {
                            echo "<div class='error'>The user you are looking for does not exist!</div>";
                        }

                    }

                    if (isset($_POST["friend_add"])) {
                        $savedUser = $_SESSION["savedUser"];
                        changer("data/fan_data.json", "add_friend", $savedUser["username"], $_SESSION["username"]);
                        echo "<div class='success'>You added " . $savedUser["username"] . " to your friends, be aware if this friend changes username you have to add eachother again!</div>";
                    }

                    switch (true) {
                        case isset($_POST["change_username_b"]):

                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <label for="username_changed" class="label-required">
                                    The new username:
                                    <input type="text" maxlength="30" name="username_changed" id="username_changed">
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
                                    <input type="password" maxlength="20" name="password_changed" id="password_changed">
                                </label>
                                <br>
                                <label for="password_changed_check" class="label-required">
                                    The new password again:
                                    <input type="password" maxlength="20" name="password_changed_check"
                                           id="password_changed_check">
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
                                    <input type="email" name="email_changed" id="email_changed">
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
                                    <input type="search" maxlength="30" name="find_user" id="find_user">
                                </label>
                                <button name="user_find">Find user</button>
                            </form>

                            <?php
                            break;
                        case isset($_POST["friends_b"]):
                            foreach ($users["users"] as $user) {
                                if ($user["username"] === $_SESSION["username"]) {
                                    if (empty($user["friends"])){
                                        echo "<div class='error'>You do not have friends (sadge)</div>";
                                    }else {
                                        foreach ($user["friends"] as $friend) {
                                            $_SESSION["friend"] = $friend;
                                            echo "<form method='post'><input name='the_removable_friend' style='pointer-events: none' value='$friend'>";
                                            echo "<button name='remove_friend'>Remove Friend</button>
                                              <button name='send_message_b'>Send message</button></form>";
                                        }
                                    }

                                }
                            }

                            break;
                        case isset($_POST["yes"]):
                            changer("data/fan_data.json", "account_delete", "", $_SESSION["username"]);
                            session_unset();
                            session_destroy();
                            setcookie("use_cookies","",time()-3600);
                            setcookie("login_password","",time()-3600);
                            setcookie("login_email","",time()-3600);
                            header("Refresh: 0");
                            break;
                        case isset($_POST["remove_friend"]):
                            changer("data/fan_data.json","remove_friend", $_POST["the_removable_friend"],$_SESSION["username"]);
                        break;
                        case isset($_POST["received_messages_b"]):
                            foreach ($users["users"] as $user){
                                if ($user["username"] === $_SESSION["username"]) {
                                    if (empty($user["messages"])){
                                        echo "<div class='error'>You do not have messages</div>";
                                    }else {

                                        foreach ($user["messages"] as $message) {
                                            echo $message;
                                        }

                                    }

                                }
                            }
                            break;
                        case isset($_POST["send_message_b"]):
                            echo "<form method='post'><div><label>The message for ".$_SESSION["friend"] ." :</label></div><div><textarea name='wanna_send' id='wanna_send'></textarea></div><button name='send'>Send</button></form>";
                        break;
                        case isset($_POST["send"]):
                            if (trim($_POST["wanna_send"]) !== "") {
                                changer("data/fan_data.json", "send_message", "<div  class='lil_box'>From: " . $_SESSION["username"] . "<br>The message is: " . $_POST["wanna_send"] . "<br> (At ".date("h:i:sa").")</div>", $_SESSION["friend"]);
                            }
                            echo trim($_POST["wanna_send"] !== "") ? "<div class='success'>You sent the message!</div>" : "<div class='error'>You can not send empty messages</div>";
                            break;
                    }

                    ?>
                </div>
            </div>

    </section>
</main>
