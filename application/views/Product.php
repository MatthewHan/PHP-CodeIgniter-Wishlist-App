<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>
    <!-- Page Content -->

    <div class="container">
        <h2><?= $product['name'] ?></h2>
        <div class="method">
            <div class="row margin-0 list-header hidden-sm hidden-xs">
                <div class="col-md-12"><div class="header">Users Who Have This Item On Their Wishlist</div></div>
            </div>
            <?php foreach ($product_users as $user)
            {?>
                <div class="row margin-0">
                    <div class="col-md-12">
                        <div class="cell">
                            <?= $user['name'] ?>
                        </div>
                    </div>
                </div>
            <?php }
            ?>    
        </div>
    </div>
</body>
</html>