
<!-- Login and Registration Forms, courtesy of Code_Alchemy -->
<div class="container">

    <?php $data = $controller->data();?>
    <!-- Login Box -->
    <div id="loginbox" style="margin-top:50px;display:<?=$controller->uri()->part(1)=='login'?'':'none'?>" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title">Login</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <?php if ( isset( $data['login_error'])){ ?>
                    <div style="" id="login-alert" class="alert alert-danger col-sm-12"><?=$data['login_error']?></div>
                <?php } ?>

                <form id="loginform" class="form-horizontal" role="form" method="POST" action="/login">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="email address">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-unlock-alt"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                    </div>



                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Stay logged in
                            </label>
                        </div>
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <button type="submit" id="btn-login" class="btn btn-success">Login  </button>
                            <!--
                            <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>
                            -->
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Not signed up yet?
                                <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                    Click to signup
                                </a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="signin_submitted" value="yes"/>
                </form>



            </div>
        </div>
    </div>

    <div id="signupbox" style="display:<?=$controller->uri()->part(1)=='signup'?'':'none'?>; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Signup</div>
                <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
            </div>
            <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="POST" action="/signup">

                    <?php if ( isset( $data['signup_result']) && $data['signup_result']=='error'){?>
                        <div id="signupalert" style="" class="alert alert-danger">
                            <p>Error:</p>
                            <span><?=$data['signup_error']?></span>
                        </div>
                    <?php } ?>


                    <div class="form-group">
                        <label for="firstname" class="col-md-4 control-label">First name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="first_name" placeholder="First name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-4 control-label">Last name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="last_name" placeholder="Last name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email address</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="email" placeholder="Email address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-4 col-md-8">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Signup</button>
                            <!-- <span style="margin-left:8px;">or</span>-->
                        </div>
                    </div>
                    <input type="hidden" name="signup_submitted" value="yes"/>

                </form>
            </div>
        </div>
    </div>
</div>
