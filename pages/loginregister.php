<?php
$errors = [];
if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $email = $_POST["signup-e-mail"];
    $password = $_POST["sign-up-password"];
    $password_check = $_POST["sign-up-password-again"];
    $subscribe = $_POST["subscribe"];
    if (isset($subscribe)) {
        $subscribe = true;
    } else {
        $subscribe = false;
    }
    if (isset($_POST["subscribe"])) {
        $subscribe = $_POST["subscribe"];
    }
    if (trim($username) === "") {
        array_push($errors, "empty_username");
    }
    if (strlen($username) > 30) {
        array_push($errors, "long_username");
    }
    if (trim($email) === "") {
        array_push($errors, "empty_email");
    }
    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "invalid_email");
    }
    if (trim($password) === "") {
        array_push($errors, "empty_password");
    }
    if (trim($password_check) === "") {
        array_push($errors, "empty_password_check");
    }
    if (($password !== "" && strlen($password) < 8) || ($password !== "" && strlen($password) > 20)) {
        array_push($errors, "does_not_met_requirements");
    }
    if ($password !== "" && (strlen($password) >= 8 && strlen($password) <= 20) && (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!@#$%^&*+`~'=?\]\[\-<>]).{8,}/", $password))) {
        array_push($errors, "does_not_met_requirements");
    }
    if ($password_check !== "" && $password !== $password_check) {
        array_push($errors, "passwords_not_match");
    }


}

?>
<main>
    <section id="form-block">
        <h2 class="more-space">Login to your account / Signup for an account </h2>
        <form method="post" id="form_login" autocomplete="on">
            <fieldset>
                <legend><strong>Login</strong></legend>
                <label for="login-e-mail" class="label-required">E-mail:</label>
                <input type="email" name="login-e-mail" id="login-e-mail" placeholder="Email address" maxlength="40"
                       required>
                <div class="error">

                </div>
                <label for="login-password" class="label-required">Password:</label>
                <input type="password" name="login-password" id="login-password" placeholder="Password" minlength="8"
                       maxlength="20" required>
                <div class="error">

                </div>
            </fieldset>
            <div class="buttons">
                <input type="submit" value="Login">
            </div>
        </form>
        <form method="post" id="form_register" autocomplete="on">
            <fieldset>
                <legend><strong>SingUp</strong></legend>
                <label for="username" class="label-required">Username:</label>
                <input type="text" name="username" id="username" placeholder="TheBigUserName54" maxlength="30" value=""
                       required>
                <div class="error">
                    <?php
                    if (in_array("long_username", $errors)) echo "The username can not be longer that 20 characters!";
                    if (in_array("empty_username", $errors)) echo "You must fill this field!";
                    ?>
                </div>
                <label for="signup-e-mail" class="label-required">E-mail:</label>
                <input type="email" name="signup-e-mail" id="signup-e-mail" placeholder="kittens@garden.meow" value=""
                       required>
                <div class="error">
                    <?php
                    if (in_array("empty_email", $errors)) echo "You must fill this field!";
                    if (in_array("invalid_email", $errors)) echo "This email is not valid!";
                    ?>
                </div>
                <label for="sign-up-password" class="label-required">Password must contain:</label>
                <ul>
                    <li>small letter</li>
                    <li>capital letter</li>
                    <li>number</li>
                    <li>special character</li>
                    <li>at least 8 characters</li>
                </ul>
                <input type="password" name="sign-up-password" id="sign-up-password" placeholder="Password$541"
                       minlength="8" maxlength="20" required>
                <div class="error">
                    <?php
                    if (in_array("empty_password", $errors)) echo "You must fill this field!";
                    if (in_array("does_not_met_requirements", $errors)) echo "The password not matches the requirements!";
                    if (in_array("passwords_not_match", $errors) && !in_array("does_not_met_requirements", $errors)) echo "Passwords does not match!";
                    ?>
                </div>
                <label for="sign-up-password-again" class="label-required">Password again</label>
                <input type="password" name="sign-up-password-again" id="sign-up-password-again"
                       placeholder="Password$541" minlength="8" maxlength="20" required>
                <div class="error">
                    <?php
                    if (in_array("passwords_not_match", $errors)) echo "Passwords does not match!";
                    ?>
                </div>
                <label for="subscribe">Subscribe to our newsletter:<input type="checkbox" name="subscribe"
                                                                          id="subscribe"></label>
            </fieldset>
            <div class="buttons">
                <input type="reset" name="login" value="Reset">
                <input type="submit" name="signup" value="SignUp">
            </div>
        </form>
    </section>
</main>
