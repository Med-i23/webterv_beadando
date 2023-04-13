<?php
include_once "common/functions.php";
why_are_you_here();
$errors = [];
global $username, $email, $password, $password_check, $agree_terms_of_use, $subscribe;
if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $email = $_POST["signup-e-mail"];
    $password = $_POST["sign-up-password"];
    $password_check = $_POST["sign-up-password-again"];
    $privilege = "normal";


    if (isset($_POST["agree_terms_of_use"])) {
        $agree_terms_of_use = $_POST["agree_terms_of_use"];
    } else {
        $errors[] = "does_not_agree_terms_of_use";
    }
    $subscribe = $_POST["subscribe"] ?? "off";

    $errors[] = duplicate_username_check($username);
    $errors[] = duplicate_email_check($email);
    $errors[] = empty_username_check($username);
    $errors[] = username_longness($username);
    $errors[] = empty_email_check($email);
    $errors[] = empty_password_check($password);
    $errors[] = empty_password_check($password_check);
    $errors[] = password_acceptance($password);
    $errors[] = password_match($password_check, $password);
    $errors = array_values(array_filter($errors));

    if (count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "privilege" => $privilege,
            "status" => "available",
            "agree_terms_of_use" => $agree_terms_of_use,
            "subscribe" => $subscribe,
            "remember" => "off",
            "friends" => $friends = [],
            "messages" => $messages = [],
            "cart" => $cart = []

        ];
        save_data("data/fan_data.json", $user);
    }


}


if (isset($_POST["login"])) {
    $login_email = $_POST["login-e-mail"];
    $login_password = $_POST["login-password"];

    $users = load_data("data/fan_data.json");
    foreach ($users["users"] as $user) {
        if ($user["email"] === $login_email && password_verify($login_password, $user["password"]) && $user["status"] !== "banned") {
            $_SESSION["username"] = $user["username"];
            if (isset($_COOKIE["use_cookies"]) && isset($_POST["remember_me"])) {
                setcookie("login_email", $login_email, time() + 60 * 60 * 24 * 15);
                setcookie("login_password", $login_password, time() + 60 * 60 * 24 * 15);
                changer("data/fan_data.json", "remember_on", "", $user["username"]);
            } else if (isset($_COOKIE["login_email"]) && !isset($_POST["remember_me"])) {
                changer("data/fan_data.json", "remember_off", "", $user["username"]);
            }
            header("Location: index.php?page=main");
        } else {
            $errors[] = "login_email_or_password_not_valid";
        }
    }


}


?>
<main>
    <section id="form-block">
        <h2 class="more-space">Login to your account / Signup for an account </h2>
        <form method="post" id="form_login" enctype="multipart/form-data" autocomplete="on">
            <fieldset>
                <legend><strong>Login</strong></legend>
                <label for="login-e-mail" class="label-required">E-mail:</label>
                <input type="email" name="login-e-mail" id="login-e-mail" placeholder="Email address"
                       value="<?php
                       $users = load_data("data/fan_data.json");
                       foreach ($users["users"] as $user) {
                           if (isset($_COOKIE["login_email"]) && $_COOKIE["login_email"] === $user["email"] && $user["remember"] === "on") {
                               echo $_COOKIE["login_email"];
                           }
                       }

                       ?>" maxlength="40"
                       required>
                <div <?php echo in_array("login_email_or_password_not_valid", $errors) ? "class=error" : "hidden" ?>>
                    <?php
                    if (in_array("login_email_or_password_not_valid", $errors)) echo "Email or password not valid!";

                    ?>
                </div>
                <label for="login-password" class="label-required">Password:</label>
                <input type="password" name="login-password" id="login-password" placeholder="Password"
                       value="<?php
                       foreach ($users["users"] as $user) {
                           if (isset($_COOKIE["login_email"]) && $_COOKIE["login_email"] === $user["email"] && $user["remember"] === "on") {
                               echo $_COOKIE["login_password"];
                           }
                       }
                       ?>"
                       minlength="8"
                       maxlength="20" required>
                <div <?php echo in_array("login_email_or_password_not_valid", $errors) ? "class=error" : "hidden" ?>>
                    <?php
                    if (in_array("login_email_or_password_not_valid", $errors)) echo "Email or password not valid!"
                    ?>
                </div>
                <label for="remember_me">Remember me (You must accept cookies before use):
                    <input type="checkbox" name="remember_me" id="remember_me"
                        <?php
                        foreach ($users["users"] as $user) {
                            if (isset($_COOKIE["login_email"]) && $_COOKIE["login_email"] === $user["email"] && $user["remember"] === "on") {
                                echo "checked";
                            }
                        } ?>>
                </label>

            </fieldset>
            <div class="buttons">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
        <div <?php echo count($errors) === 0 && isset($_POST["signup"]) ? "class=success" : "hidden" ?>>
            You signed up successfully!
        </div>
        <form method="post" id="form_register" enctype="multipart/form-data" autocomplete="on">
            <fieldset>
                <legend><strong>SingUp</strong></legend>
                <label for="username" class="label-required">Username (max 30 characters):</label>
                <input type="text" name="username" id="username" placeholder="TheBigUserName54" maxlength="30"
                       value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>"
                       required>
                <div <?php echo in_array("long_username", $errors) || in_array("empty_username", $errors) || in_array("username_already_in_use", $errors) ? "class=error" : "hidden"; ?> >
                    <?php
                    if (in_array("long_username", $errors)) echo "The username can not be longer that 20 characters!";
                    if (in_array("empty_username", $errors)) echo "You must fill this field!";
                    if (in_array("username_already_in_use", $errors)) echo "This username is already in use!";
                    ?>
                </div>
                <label for="signup-e-mail" class="label-required">E-mail:</label>
                <input type="email" name="signup-e-mail" id="signup-e-mail" placeholder="kittens@garden.meow"
                       value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>"
                       required>
                <div <?php echo in_array("empty_email", $errors) || in_array("invalid_email", $errors) || in_array("email_already_in_use", $errors) ? "class=error" : "hidden"; ?>>
                    <?php
                    if (in_array("empty_email", $errors)) echo "You must fill this field!";
                    if (in_array("invalid_email", $errors)) echo "This email is not valid!";
                    if (in_array("email_already_in_use", $errors) && !in_array("empty_email", $errors) && !in_array("invalid_email", $errors)) echo "This email is already in use!";
                    ?>
                </div>
                <label for="sign-up-password" class="label-required">Password must contain:</label>
                <ul>
                    <li>small letter</li>
                    <li>capital letter</li>
                    <li>number</li>
                    <li>special character</li>
                    <li>at least 8 characters</li>
                    <li>max 20 characters</li>
                </ul>
                <input type="password" name="sign-up-password" id="sign-up-password" placeholder="Password$541"
                       minlength="8" maxlength="20" required>
                <div <?php echo in_array("empty_password", $errors) || in_array("does_not_met_requirements", $errors) || in_array("passwords_not_match", $errors) && !in_array("does_not_met_requirements", $errors) ? "class=error" : "hidden"; ?>>
                    <?php
                    if (in_array("empty_password", $errors)) echo "You must fill this field!";
                    if (in_array("does_not_met_requirements", $errors)) echo "The password not matches the requirements!";
                    if (in_array("passwords_not_match", $errors) && !in_array("does_not_met_requirements", $errors)) echo "Passwords does not match!";
                    ?>
                </div>
                <label for="sign-up-password-again" class="label-required">Password again</label>
                <input type="password" name="sign-up-password-again" id="sign-up-password-again"
                       placeholder="Password$541" minlength="8" maxlength="20" required>
                <div <?php echo in_array("passwords_not_match", $errors) ? "class=error" : "hidden"; ?> >
                    <?php
                    if (in_array("passwords_not_match", $errors)) echo "Passwords does not match!";
                    ?>
                </div>
                <label for="agree_terms_of_use" class="label-required">I accept the <a class="terms"
                                                                                       href="index.php?page=termsofservice">Terms
                        of Use</a>:<input type="checkbox" name="agree_terms_of_use" id="agree_terms_of_use"
                                          required <?php if (isset($_POST["agree_terms-of-use"])) echo "checked" ?>>
                </label>

                <div <?php echo in_array("does_not_agree_terms_of_use", $errors) ? "class=error" : "hidden"; ?>>
                    <?php
                    if (in_array("does_not_agree_terms_of_use", $errors)) echo "You must check this checkbox!";
                    ?>
                </div>

                <label for="subscribe">Subscribe to our newsletter:<input type="checkbox" name="subscribe"
                                                                          id="subscribe" <?php if (isset($_POST["subscribe"])) echo "checked" ?>></label>
            </fieldset>
            <div class="buttons">
                <input type="reset" name="reset" value="Reset">
                <input type="submit" name="signup" value="SignUp">
            </div>
        </form>
    </section>
</main>
