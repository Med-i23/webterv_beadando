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
                    foreach ($users["users"][$index]["cart"] as $index_2 => $user_2) {
                        if ($users["users"][$index]["cart"][$index_2] === $given) {
                            array_splice($users["users"][$index]["cart"], $index_2, 1);
                            break;
                        }
                    }

                    break;
                case "account_delete" :
                    if ($user["username"] === $_SESSION["username"]) {
                        array_splice($users["users"], $index, 1);
                    }
                    break;
                case "add_friend" :
                    if (!in_array($given, $users["users"][$index]["friends"])) {
                        $users["users"][$index]["friends"][] = $given;
                    }
                    foreach ($users["users"] as $index_2 => $user_2) {
                        if ($user_2["username"] === $given) {
                            if (!in_array($who, $users["users"][$index_2]["friends"])) {
                                $users["users"][$index_2]["friends"][] = $who;
                            }
                        }
                    }
                    break;
                case "remove_friend" :
                    foreach ($users["users"][$index]["friends"] as $index_2 => $user_2) {
                        if ($users["users"][$index]["friends"][$index_2] === $given) {
                            array_splice($users["users"][$index]["friends"], $index_2, 1);
                            break;
                        }
                    }
                    break;
                case "send_message" :
                        $users["users"][$index]["messages"][] = $given;
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

function validate_cc($ccNum, $type = 'all', $regex = null): bool
{

    $ccNum = str_replace(array('-', ' '), '', $ccNum);
    if (mb_strlen($ccNum) < 13) {
        return false;
    }

    if ($regex !== null) {
        if (is_string($regex) && preg_match($regex, $ccNum)) {
            return true;
        }
        return false;
    }

    $cards = array(
        'all' => array(
            'amex'		=> '/^3[4|7]\\d{13}$/',
            'bankcard'	=> '/^56(10\\d\\d|022[1-5])\\d{10}$/',
            'diners'	=> '/^(?:3(0[0-5]|[68]\\d)\\d{11})|(?:5[1-5]\\d{14})$/',
            'disc'		=> '/^(?:6011|650\\d)\\d{12}$/',
            'electron'	=> '/^(?:417500|4917\\d{2}|4913\\d{2})\\d{10}$/',
            'enroute'	=> '/^2(?:014|149)\\d{11}$/',
            'jcb'		=> '/^(3\\d{4}|2100|1800)\\d{11}$/',
            'maestro'	=> '/^(?:5020|6\\d{3})\\d{12}$/',
            'mc'		=> '/^5[1-5]\\d{14}$/',
            'solo'		=> '/^(6334[5-9][0-9]|6767[0-9]{2})\\d{10}(\\d{2,3})?$/',
            'switch'	=>
                '/^(?:49(03(0[2-9]|3[5-9])|11(0[1-2]|7[4-9]|8[1-2])|36[0-9]{2})\\d{10}(\\d{2,3})?)|(?:564182\\d{10}(\\d{2,3})?)|(6(3(33[0-4][0-9])|759[0-9]{2})\\d{10}(\\d{2,3})?)$/',
            'visa'		=> '/^4\\d{12}(\\d{3})?$/',
            'voyager'	=> '/^8699[0-9]{11}$/'
        ),
        'fast' =>
            '/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})$/'
    );

    if (is_array($type)) {
        foreach ($type as $value) {
            $regex = $cards['all'][strtolower($value)];

            if (is_string($regex) && preg_match($regex, $ccNum)) {
                return true;
            }
        }
    } elseif ($type === 'all') {
        foreach ($cards['all'] as $value) {
            $regex = $value;

            if (is_string($regex) && preg_match($regex, $ccNum)) {
                return true;
            }
        }
    } else {
        $regex = $cards['fast'];

        if (is_string($regex) && preg_match($regex, $ccNum)) {
            return true;
        }
    }
    return false;
}