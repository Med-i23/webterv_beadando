<?php
include_once "common/functions.php";
$users = load_data("data/fan_data.json");
$admin = false;
foreach ($users["users"] as $user){
    if ($user["username"] === $_SESSION["username"] && $user["privilege"] === "admin"){
        $admin=true;
    }
}
?>

<div class="h1-imitator">Account management</div>
<main>
    <section class="article-imitator">
        <div class="flex-box">
            <?php
            if (isset($_SESSION["username"]) && $admin){
                ?>
                <div class="card">
                    <a>Manage users</a>
                </div>
                <?php
            }
                ?>
            <div class="card">
                <a>Settings</a>
            </div>
            <div class="card">
                <a>Niffer</a>
            </div>
            <div class="card">
                <a>Buffer</a>
            </div>
            <div class="card">
                <a>Filler</a>
            </div>
            <div class="card">
                <a>Tiller</a>
            </div>
            <div class="card">
                <a>Siller</a>
            </div>
            <div class="card">
                <a>Kill</a>
            </div>
            <div class="card">
                <a>Breer</a>
            </div>
            <div class="card">
                <a>Fleer</a>
            </div>
            <div class="card">
                <a>Beer</a>
            </div>
            <div class="card">
                <a>Fire Water</a>
            </div>
            <div class="card">
                <a>Saxof</a>
            </div>
            <div class="card">
                <a>Construction</a>
            </div>
            <div class="card">
                <a>Klomel</a>
            </div>
            <div class="card">
                <a>Felis</a>
            </div>
        </div>
    </section>
</main>