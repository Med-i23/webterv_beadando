<?php
function save_data(string $filename, array $data): void
{
    $users = load_data($filename);
    $users["users"][] = $data;
    file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT));
}

function load_data(string $filename): array
{
    if (!file_exists($filename)) {
        die("Nem létezik ilyen fájl!");
    }
    $json = file_get_contents($filename);

    return json_decode($json, true);
}


$errors = [];
global $username, $email, $password, $password_check, $agree_terms_of_use, $subscribe;
if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $email = $_POST["signup-e-mail"];
    $password = $_POST["sign-up-password"];
    $password_check = $_POST["sign-up-password-again"];


    if (isset($_POST["agree_terms_of_use"])) {
        $agree_terms_of_use = $_POST["agree_terms_of_use"];
    }else{
        array_push($errors,"does_not_agree_terms_of_use");
    }
    $subscribe = $_POST["subscribe"] ?? false;
    $users = load_data("data/fan_data.json");

    foreach ($users["users"] as $user) {
        if ($user["email"] === $email) {
            array_push($errors, "email_already_in_use");
        }
        if ($user["username"] === $username) {
            array_push($errors, "username_already_in_use");
        }
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
    if (count($errors) === 0) {

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            "username" => $username,
            "email" => $email,
            "password" => $password,
            "agree_terms_of_use" => $agree_terms_of_use,
            "subscribe" => $subscribe
        ];
        save_data("data/fan_data.json", $user);
    }

}

if (isset($_POST["login"])) {
    $login_email = $_POST["login-e-mail"];
    $login_password = $_POST["login-password"];

    $users = load_data("data/fan_data.json");
    foreach ($users["users"] as $user){
        if ($user["email"] === $login_email && password_verify($login_password,$user["password"])){
            $_SESSION["username"] = $username;
            header("Location: index.php?page=main");
        }else{
            array_push($errors, "login_email_or_password_not_valid");
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
                <input type="email" name="login-e-mail" id="login-e-mail" placeholder="Email address" maxlength="40"
                       required>
                <div <?php echo in_array("login_email_or_password_not_valid",$errors) ? "class=error" : "hidden" ?>>
                    <?php
                    if (in_array("login_email_or_password_not_valid",$errors)) echo "Email or password not valid!";

                    ?>
                </div>
                <label for="login-password" class="label-required">Password:</label>
                <input type="password" name="login-password" id="login-password" placeholder="Password" minlength="8"
                       maxlength="20" required>
                <div <?php echo in_array("login_email_or_password_not_valid",$errors) ? "class=error" : "hidden" ?>>
                    <?php
                    if (in_array("login_email_or_password_not_valid",$errors)) echo "Email or password not valid!"
                    ?>
                </div>
            </fieldset>
            <div class="buttons">
                <input type="submit" name="login" value="Login">
            </div>
        </form>
        <div <?php echo count($errors) === 0 && isset($_POST["signup"]) ? "class=success" : "hidden" ?>>
            You signed up successfully!
        </div>
        <form method="post" id="form_register" autocomplete="on">
            <fieldset>
                <legend><strong>SingUp</strong></legend>
                <label for="username" class="label-required">Username:</label>
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
                <label for="agree_terms_of_use" class="label-required">I accept the terms of use: </label>
                <input type="checkbox" name="agree_terms_of_use" id="agree_terms_of_use"
                       required <?php if (isset($_POST["agree_terms-of-use"])) echo "checked" ?>>
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
