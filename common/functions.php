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

