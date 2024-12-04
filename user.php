
<?php
 	include("dbconnect.php");
	extract($_POST);
	session_start();
if(isset($_POST['btn']))
{


if($type=='Admin')
{
$qry=mysqli_query($conn,"select * from admin where uname='$uname' && psw='$password'");
$num=mysqli_num_rows($qry);
if($num==1)
{
?>
<script>alert('welcome to admin home page');
</script>
<?php

header("location:admin.php");
}
else
{
echo "<script>alert('User Name Password Wrong.....')</script>";

}
}




if($type=='User')
{
$qry=mysqli_query($conn,"select * from register where uname='$uname' && psw='$password'");
$num=mysqli_num_rows($qry);
if($num==1)
{
$qry=mysqli_query($conn,"select * from register where uname='$uname' && psw='$password'");
$row=mysqli_fetch_assoc($qry);
$_SESSION['uid']=$row['id'];
echo "<script>alert('Welcome to user homa page')</script>";
header("location:uhome.php");
}
else
{
echo "<script>alert('User Name Password Wrong.....')</script>";

}
}


}
?> 


<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title>Gallery | Charity / Non-profit responsive Bootstrap HTML5 template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>

        <!-- Bootsrap -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">


        <!-- Font awesome -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- PrettyPhoto -->
        <link rel="stylesheet" href="assets/css/prettyPhoto.css">

        <!-- Template main Css -->
        <link rel="stylesheet" href="assets/css/style.css">
        
        <!-- Modernizr -->
        <script src="assets/js/modernizr-2.6.2.min.js"></script>


    </head>
    <body>
    <!-- NAVBAR
    ================================================== -->

    <header class="main-header">
        
    
        <nav class="navbar navbar-static-top">

            <div class="navbar-top">

              <div class="container">
                  <div class="row">

                    <div class="col-sm-6 col-xs-12">

                        <ul class="list-unstyled list-inline header-contact">
                            <li> <i class="fa fa-phone"></i> <a href="tel:">+212 658 986 213 </a> </li>
                             <li> <i class="fa fa-envelope"></i> <a href="mailto:contact@sadaka.org">contact@sadaka.org</a> </li>
                       </ul> <!-- /.header-contact  -->
                      
                    </div>

                    <div class="col-sm-6 col-xs-12 text-right">
                        <h1>DONATION SYSTEM</h1>
                        <ul class="list-unstyled list-inline header-social">

                            <li> <a href="#" target="_blank"> <i class="fa fa-facebook"></i> </a> </li>
                            <li> <a href="#" target="_blank"> <i class="fa fa-twitter"></i>  </a> </li>
                            <li> <a href="#" target="_blank"> <i class="fa fa-google"></i>  </a> </li>
                            <li> <a href="#" target="_blank"> <i class="fa fa-youtube"></i>  </a> </li>
                            <li> <a href="#" target="_blank"> <i class="fa fa fa-pinterest-p"></i>  </a> </li>

                       </ul> <!-- /.header-social  -->
                      
                    </div>


                  </div>
              </div>

            </div>

            <div class="navbar-main">
              
              <div class="container">

                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                  </button>
                  
                  <a class="navbar-brand" href="index.html"><img src="" alt=""></a>
                  
                </div>

                <div id="navbar" class="navbar-collapse collapse pull-right">

                  <ul class="nav navbar-nav">

                    <li><a href="index.html">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>

                      <ul class="submenu">
                         <li class="submenu-item"><a href="causes.html">Causes list </a></li>
                         <li class="submenu-item"><a href="causes-single.html">Single cause </a></li>
                         <li class="submenu-item"><a href="causes-single.html">Single cause </a></li>
                         <li class="submenu-item"><a href="causes-single.html">Single cause </a></li>
                      </ul>

                    </li>
                    <li><a  href="gallery.html">GALLERY</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
					  <li><a class="is-active" href="user.php">SIGN IN</a></li>

                  </ul>

                </div> <!-- /#navbar -->

              </div> <!-- /.container -->
              
            </div> <!-- /.navbar-main -->


        </nav> 

    </header> <!-- /. main-header -->


	<div class="page-heading text-center">

		<div class="container zoomIn animated">
			
			<h1 class="page-title">SIGI IN <span class="title-under"></span></h1>
			<p class="page-description">
				
			</p>
			
		</div>

	</div>

	<div class="main-container">

		<br><br><br>
<form id="form1" name="form1" method="post" action="" style="
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    max-width: 450px;
    margin: 50px auto;
    color: white;
    position: relative;
    overflow: hidden;
">
    <!-- Decorative Background Elements -->
    <div style="
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background-color: rgba(255,255,255,0.1);
        border-radius: 50%;
    "></div>
    <div style="
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 150px;
        height: 150px;
        background-color: rgba(255,255,255,0.1);
        border-radius: 50%;
    "></div>

    <!-- Login Title -->
    <div style="
        text-align: center; 
        margin-bottom: 30px;
        position: relative;
    ">
        <h2 style="
            font-size: 28px;
            margin-bottom: 10px;
            color: white;
            letter-spacing: 1px;
        ">Secure Login</h2>
        <div style="
            width: 50px;
            height: 3px;
            background-color: white;
            margin: 0 auto;
        "></div>
    </div>

    <!-- Form Content -->
    <div style="space-y: 20px;">
        <!-- User Type Dropdown -->
        <div style="margin-bottom: 20px;">
            <label style="
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: rgba(255,255,255,0.8);
            ">Select User Type</label>
            <select name="type" style="
                width: 100%;
                padding: 12px 15px;
                border: 2px solid rgba(255,255,255,0.2);
                border-radius: 8px;
                background-color: rgba(255,255,255,0.1);
                color: white;
                font-size: 16px;
                outline: none;
                transition: all 0.3s ease;
            ">
                <option value="" style="color: #333;">Select</option>
                <option value="Admin" style="color: #333;">Admin</option>
                <option value="User" style="color: #333;">User</option>
            </select>
        </div>

        <!-- Username Input -->
        <div style="margin-bottom: 20px;">
            <label style="
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: rgba(255,255,255,0.8);
            ">Username</label>
            <input name="uname" type="text" id="uname" style="
                width: 100%;
                padding: 12px 15px;
                border: 2px solid rgba(255,255,255,0.2);
                border-radius: 8px;
                background-color: rgba(255,255,255,0.1);
                color: white;
                font-size: 16px;
                outline: none;
                transition: all 0.3s ease; 
            " />
        </div>

        <!-- Password Input -->
        <div style="margin-bottom: 20px;">
            <label style="
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: rgba(255,255,255,0.8);
            ">Password</label>
            <input name="password" type="password" id="password" style="
                width: 100%;
                padding: 12px 15px;
                border: 2px solid rgba(255,255,255,0.2);
                border-radius: 8px;
                background-color: rgba(255,255,255,0.1);
                color: white;
                font-size: 16px;
                outline: none;
                transition: all 0.3s ease;
            " />
        </div>

        <!-- Action Buttons -->
        <div style="
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        ">
            <input name="btn" type="submit" id="btn" value="Login" style="
                flex-grow: 1;
                margin-right: 10px;
                padding: 12px;
                background-color: white;
                color: #667eea;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            "/>
            <input type="reset" name="Submit2" value="Cancel" style="
                flex-grow: 1;
                padding: 12px;
                background-color: rgba(255,255,255,0.2);
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            "/>
        </div>

        <!-- Registration Link -->
        <div style="
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: rgba(255,255,255,0.7);
        ">
            Not yet Registered? 
            <a href="register.php" style="
                color: white;
                font-weight: bold;
                text-decoration: none;
                border-bottom: 1px solid white;
                transition: color 0.3s ease;
            ">Register Now</a>
        </div>
    </div>
</form>
<br>

<br><br><br>


	</div> <!-- /.main-container  -->


    <footer class="main-footer">

        <div class="footer-top">
            
        </div>


        <div class="footer-main">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-4">

                        <div class="footer-col">

                            <h4 class="footer-title">About us <span class="title-under"></span></h4>

                            <div class="footer-content">
                                <p>
                                    <strong>Sadaka</strong> ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                                </p> 

                                <p>
                                    ILorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                                </p>

                            </div>
                            
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="footer-col">

                            <h4 class="footer-title">LAST TWEETS <span class="title-under"></span></h4>

                            <div class="footer-content">
                                <ul class="tweets list-unstyled">
                                    <li class="tweet"> 

                                        20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar  http://t.co/fTSazikPd4 

                                    </li>

                                    <li class="tweet"> 

                                        20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar  http://t.co/fTSazikPd4 

                                    </li>

                                    <li class="tweet"> 

                                        20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar  http://t.co/fTSazikPd4 

                                    </li>

                                </ul>
                            </div>
                            
                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="footer-col">

                            <h4 class="footer-title">Contact us <span class="title-under"></span></h4>

                            <div class="footer-content">

                                <div class="footer-form" >
                                    
                                    <form action="php/mail.php" class="ajax-form">

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                        </div>

                                         <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                                        </div>

                                        <div class="form-group alerts">
                        
                                            <div class="alert alert-success" role="alert">
                                              
                                            </div>

                                            <div class="alert alert-danger" role="alert">
                                              
                                            </div>
                                            
                                        </div>

                                         <div class="form-group">
                                            <button type="submit" class="btn btn-submit pull-right">Send message</button>
                                        </div>
                                        
                                    </form>

                                </div>
                            </div>
                            
                        </div>

                    </div>
                    <div class="clearfix"></div>



                </div>
                
                
            </div>

            
        </div>

        <div class="footer-bottom">

            <div class="container text-right">
                Sadaka @ copyrights 2015 - by <a href="http://www.ouarmedia.com" target="_blank">Ouarmedia</a>
            </div>
        </div>
        
    </footer>




       
        
        <!-- jQuery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/jquery-1.11.1.min.js"><\/script>')</script>

        <!-- Bootsrap javascript file -->
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- PrettyPhoto javascript file -->
        <script src="assets/js/jquery.prettyPhoto.js"></script>

        <!-- Template main javascript -->
        <script src="assets/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>
