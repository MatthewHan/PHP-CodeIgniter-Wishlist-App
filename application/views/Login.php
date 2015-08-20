<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Login/Register</title>
    <link href="/assets/css/login.css" rel="stylesheet">
    <script type = "text/javascript">
    $(document).ready(function(){
        $(function() {
            $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
            });
        });
    })
    </script>
</head>
<body>
    <!-- Login/Registration -->
    <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <a href="#" class="<?php if(form_error('first_name') ||form_error('last_name') || form_error('email') || form_error('password')|| form_error('confirm_password')){echo '#';} else {echo 'active';} ?>" id="login-form-link">Login</a>
                  </div>
                  <div class="col-xs-6">
                    <a href="#" class = "<?php if(form_error('first_name') ||form_error('last_name') || form_error('email') || form_error('password')|| form_error('confirm_password')){echo 'active';} else {echo '#';} ?>" id="register-form-link">Register</a>
                  </div>
                </div>
                <hr>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form id="login-form" action="/user/login" method="post" role="form" style="display: <?php if(form_error('first_name') ||form_error('last_name') || form_error('email') || form_error('password')|| form_error('confirm_password')){echo 'none';} else {echo 'block';} ?>;">
                      <?php if($this->session->flashdata('login_error')){?> 
                      <span class="help-block alert alert-danger"><?= $this->session->flashdata('login_error') ?></span> 
                      <?php
                      } ?>
                      <?php if($this->session->flashdata('registered')){?> 
                      <span class="help-block alert alert-success"><?= $this->session->flashdata('registered')?></span> 
                      <?php
                      } ?>
                      <div class="form-group">
                        <input type="text" name="login_username" id="login_username" tabindex="1" class="form-control" placeholder="Username" value="<?= set_value('login_username') ?>">
                        <?php if(form_error('login_username')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('login_username') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="password" name="login_password" id="login_password" tabindex="2" class="form-control" placeholder="Password">
                        <?php if(form_error('login_password')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('login_password') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <button name="login_submit" id="login_submit" tabindex="4" class="form-control btn btn-login" value="login">Log In</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <form id="register-form" action="/user/register" method="post" role="form" style="display: <?php if(form_error('first_name') ||form_error('last_name') || form_error('email') || form_error('password')|| form_error('confirm_password')){echo 'block';} else {echo 'none';} ?>;">
                      <div class="form-group">
                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Full Name" value="<?= set_value('name') ?>" >
                        <?php if(form_error('name')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('name') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" >
                        <?php if(form_error('username')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('username') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                        <?php if(form_error('password')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('password') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirm Password">
                        <?php if(form_error('confirm_password')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('confirm_password') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="date_hired" id="date_hired" tabindex="2" class="form-control" placeholder="Date Hired (MM/DD/YYYY)" value="<?= set_value('date_hired') ?>" >
                        <?php if(form_error('date_hired')){?> 
                        <span class="help-block alert alert-danger"><?= form_error('date_hired') ?></span> 
                        <?php
                        } ?>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <button name="register_submit" id="register_submit" tabindex="4" class="form-control btn btn-register" value="register">Register Now</button>
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