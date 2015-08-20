<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Item</title>
    <link href="/assets/css/login.css" rel="stylesheet">
</head>
<body>
    <!-- Add Item -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="#" class = "active" id="register-form-link">Add New Item/Product</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php if($this->session->flashdata('success')){?> 
                    <span class="help-block alert alert-success"><?= $this->session->flashdata('success') ?></span> 
                    <?php
                    }?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="register-form" action="/add" method="post" role="form" style="display: block">
                                    <div class="form-group">
                                        <input type="text" name="product_name" id="product_name" tabindex="1" class="form-control" placeholder="Item/Product Name" value="<?= set_value('product_name') ?>" >
                                        <?php if(form_error('product_name')){?> 
                                        <span class="help-block alert alert-danger"><?= form_error('product_name') ?></span> 
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <button name="register_submit" id="register_submit" tabindex="4" class="form-control btn btn-register" value="register">Add New Item/Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>