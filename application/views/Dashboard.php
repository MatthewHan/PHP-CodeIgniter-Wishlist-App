<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <script>
    $(document).ready(function(){
        $('#modal-dialog').on('show', function() {
            var link = $(this).data('link'),
            confirmBtn = $(this).find('.confirm');
        })
        $('#btnYes').click(function() {
        // handle form processing here
            alert('submit form');
            $('form').submit();  
        });
    });
    </script>
</head>
<body>
    <!-- Page Content -->
    <!-- Your Wish List -->
    <div class="container">
        <h2>Your Wish List</h2>
        <?php if($user_wishlist)
        { ?>
            <div class="method">
            <?php if($this->session->flashdata('delete_success')){?> 
            <span class="help-block alert alert-danger"><?= $this->session->flashdata('error') ?></span> 
            <?php
            }?>
            <?php if($this->session->flashdata('success')){?> 
            <span class="help-block alert alert-success"><?= $this->session->flashdata('success') ?></span> 
            <?php
            }?>
            <div class="row margin-0 list-header hidden-sm hidden-xs">
                <div class="col-md-2"><div class="header">Item Name</div></div>
                <div class="col-md-2"><div class="header">Added By</div></div>
                <div class="col-md-4"><div class="header">Date Added</div></div>
                <div class="col-md-4"><div class="header">Action</div></div>
            </div>
            <?php foreach ($user_wishlist as $item)
            {?>
                <div class="row margin-0">
                    <div class="col-md-2">
                        <div class="cell">
                            <a href="/wishlist/item/<?= $item['product_id'] ?>"><?= $item['product_name'] ?></a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="cell">
                            <?= $item['add_user'] ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cell">
                            <?= date("F j, Y g:i a" ,strtotime($item['date_added'])) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cell">
                            <?php if($this->session->userdata('id')== $item['add_user_id']){?> <a href="/delete_product/<?= $item['product_id'] ?>">Delete</a> <?php } else {?> <a href="/remove_wishlist/<?= $item['product_id'] ?>">Remove from my Wishlist</a> <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }
            ?>    
        </div>
        <?php }
        else 
        { ?>
        <p> Your Wishlist is empty </p>
        <?php } ?>
    </div>
    <!-- Other User's Wish List -->
    <?php if($wishlist)
    {?>
        <div class="container">
            <h2>Other User's Wish List</h2>
            <div class="method">
                <?php if($this->session->flashdata('delete_success')){?> 
                <span class="help-block alert alert-success"><?= $this->session->flashdata('delete_success') ?></span> 
                <?php
                }?>
                <?php if($this->session->flashdata('update_success')){?> 
                <span class="help-block alert alert-success"><?= $this->session->flashdata('update_success') ?></span> 
                <?php
                }?>
                <div class="row margin-0 list-header hidden-sm hidden-xs">
                    <div class="col-md-2"><div class="header">Item Name</div></div>
                    <div class="col-md-2"><div class="header">Added By</div></div>
                    <div class="col-md-4"><div class="header">Date Added</div></div>
                    <div class="col-md-4"><div class="header">Action</div></div>
                </div>
                <?php foreach ($wishlist as $item)
                {?>
                    <div class="row margin-0">
                        <div class="col-md-2">
                            <div class="cell">
                                <a href="/wishlist/item/<?= $item['product_id'] ?>"><?= $item['product_name'] ?></a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="cell">
                                <?= $item['add_user'] ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cell">
                                <?= date("F j, Y g:i a" ,strtotime($item['date_added'])) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cell">
                                <a href="/add_wishlist/<?= $item['product_id'] ?>">Add to my Wishlist</a>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>    
            </div>
        </div>
    <?php } ?>
    
</body>
</html>