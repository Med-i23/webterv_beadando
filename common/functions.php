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

function why_are_you_here() : void{
    if (isset($_SESSION["username"])){
        header("Location: index.php?page=main");
    }
}

function empty_username_check($username) : string{
    if (trim($username) === "") {
        return "empty_username";
    }
    return "";
}

function username_longness($username) : string{
    if (strlen($username) > 30) {
        return "long_username";
    }
    return "";
}

function duplicate_username_check($username) : string{
    $users = load_data("data/fan_data.json");
    foreach ($users["users"] as $user) {
        if ($user["username"] === $username) {
            return "username_already_in_use";
        }
    }
    return "";
}

function duplicate_email_check($email) : string{
    $users = load_data("data/fan_data.json");
    foreach ($users["users"] as $user) {
        if ($user["email"] === $email) {
            return "email_already_in_use";
        }
    }
    return "";
}

function empty_email_check($email) : string{
    if (trim($email) === "") {
        return "empty_email";
    }
    return "";
}

function changer($filename, $data){
    $users = load_data($filename);
    $users =  array_values(array_filter($users, function ($thename){ return $thename === $_SESSION["username"];}));
    $users["users"][] = $data;
    file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT));
}

function bann_user($filename, $data, $wannaBann){
    $users = load_data($filename);
    $users =  array_values(array_filter($users, function ($thename) use ($wannaBann) { return $thename === $wannaBann;}));
    $users["users"][] = $data;
    file_put_contents($filename, json_encode($users, JSON_PRETTY_PRINT));
}


