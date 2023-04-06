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
            if (isset($_SESSION["username"]) && !$admin){
                ?>
                <div class="card">Settings</div>

                <?php
            }else{
                ?>
                <div class="card">Settings</div>
                <div class="card">Manage users</div>
                <?php
            }
            ?>

        </div>
    </section>
</main>
