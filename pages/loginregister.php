<?php

?>
<main>
    <section id="form-block">
        <h2 class="more-space">Login to your account / Signup for an account </h2>
        <form>
            <fieldset>
                <legend><strong>Login</strong></legend>
                <label for="login-e-mail" class="label-required">E-mail:</label>
                <input type="email" name="login-e-mail" id="login-e-mail" placeholder="Email address" maxlength="40" required>
                <label for="login-password" class="label-required">Password:</label>
                <input type="password" name="login-password" id="login-password" placeholder="Password" minlength="8" maxlength="20" autocomplete="on" required>
            </fieldset>
            <div class="buttons">
                <input type="submit" value="Login">
            </div>
        </form>
        <form>
            <fieldset>
                <legend><strong>SingUp</strong></legend>
                <label for="username" class="label-required">Username:</label>
                <input type="text" name="username" id="username" placeholder="TheBigUserName54" required>
                <label for="signup-e-mail" class="label-required">E-mail:</label>
                <input type="email" name="signup-e-mail" id="signup-e-mail" placeholder="kittens@garden.meow" maxlength="40" required>
                <label for="sign-up-password" class="label-required">Password must contain:</label>
                <ul>
                    <li>small letter</li>
                    <li>capital letter</li>
                    <li>number</li>
                    <li>special character</li>
                    <li>at least 8 characters</li>
                </ul>

                <input type="password" name="sign-up-password" id="sign-up-password" placeholder="Password$541" minlength="8" maxlength="20" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!@#$%^&*+`~'=?\|\]\[\(\)\-<>]).{8,}" required>
                <label for="sign-up-password-again" class="label-required">Password again</label>
                <input type="password" name="sign-up-password-again" id="sign-up-password-again" placeholder="Password$541" minlength="8" maxlength="20" autocomplete="on" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!@#$%^&*+`~'=?\|\]\[\(\)\-<>]).{8,}" required>
                <label for="subscribe">Subscribe to our newsletter:<input type="checkbox" name="subscribe" id="subscribe"></label>
            </fieldset>
            <div class="buttons">
                <input type="reset" value="Reset">
                <input type="submit" value="SignUp">
            </div>
        </form>
    </section>
</main>
