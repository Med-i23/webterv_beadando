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

function why_are_you_here(): void
{
    if (!isset($_SESSION["username"])) {
        header("Location: index.php?page=main");
    }
}

function empty_username_check($username): string
{
    if (trim($username) === "") {
        return "empty_username";
    }
    return "";
}

function username_longness($username): string
{
    if (strlen($username) > 30) {
        return "long_username";
    }
    return "";
}

function duplicate_username_check($username): string
{
    $users = load_data("data/fan_data.json");
    foreach ($users["users"] as $user) {
        if ($user["username"] === $username) {
            return "username_already_in_use";
        }
    }
    return "";
}

function duplicate_email_check($email): string
{
    $users = load_data("data/fan_data.json");
    foreach ($users["users"] as $user) {
        if ($user["email"] === $email) {
            return "email_already_in_use";
        }
    }
    return "";
}

function empty_email_check($email): string
{
    if (trim($email) === "") {
        return "empty_email";
    }
    return "";
}

function empty_password_check($password): string
{
    if (trim($password) === "") {
        return "empty_password";
    }
    return "";
}

function password_acceptance($password): string
{
    if (($password !== "" && strlen($password) < 8) || ($password !== "" && strlen($password) > 20) || (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!@#$%^&*+`~'=?\]\[\-<>]).{8,}/", $password))) {
        return "does_not_met_requirements";
    }
    return "";
}

function password_match($password_check, $password): string
{
    if ($password_check !== "" && $password !== $password_check) {
        return "passwords_not_match";
    }
    return "";
}

function changer($filename, $type, $given, $who): void
{
    $users = load_data($filename);
    foreach ($users["users"] as $index => $user) {
        if ($user["username"] === $who) {
            switch ($type) {
                case "username" :
                    $users["users"][$index]["username"] = $given;
                    break;
                case "password" :
                    $users["users"][$index]["password"] = password_hash($given, PASSWORD_DEFAULT);
                    break;
                case "email" :
                    $users["users"][$index]["email"] = $given;
                    break;
                case "bann" :
                    $users["users"][$index]["status"] = "banned";
                    break;
                case "pardon" :
                    $users["users"][$index]["status"] = "allowed";
                    break;
                case "remember_on" :
                    $users["users"][$index]["remember"] = "on";
                    break;
                case "remember_off" :
                    $users["users"][$index]["remember"] = "off";
                    break;
                case "add_to_cart" :
                    $users["users"][$index]["cart"][] = $given;
                    break;
                case "remove_from_cart" :
                    foreach ($users["users"][$index]["cart"] as $index_2 => $user_2){
                        if ($users["users"][$index]["cart"][$index_2] === $given) {
                           array_splice($users["users"][$index]["cart"],$index_2,1);
                           header("Refresh: 0");
                           break;
                        }
                    }

                    break;
            }
            break;
        }
    }

    file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT));
}

function is_someone_logged(): void
{
    echo isset($_SESSION["username"]) ? "Add to cart" : "Buy now";
}