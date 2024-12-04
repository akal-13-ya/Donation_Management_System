<?php
include("dbconnect.php");

session_start();

 
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

                    <li><a href="admin.php">HOME</a></li>
					
					 <li><a href="view.php">VIEW RESPONSE</a></li>
					 <li><a href="viewu.php">VIEW USERS</a></li>
					 <li><a href="index.html">LOGOUT</a></li>

                  </ul>

                </div> <!-- /#navbar -->

              </div> <!-- /.container -->
              
            </div> <!-- /.navbar-main -->


        </nav> 

    </header> <!-- /. main-header -->


	<div class="page-heading text-center">

		<div class="container zoomIn animated">
			
			<h1 class="page-title">REGISTERED DONORS <span class="title-under"></span></h1>
			<p class="page-description">
				
			</p>
			
		</div>

	</div>

	<div class="main-container">
<body style="font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; color: #2d3436; line-height: 1.6;">
    <h2 style="text-align: center; color: #2d3436; font-size: 2rem; margin: 2rem 0; position: relative; padding-bottom: 10px;">View Donors</h2>

   <table style="width: 100%; border-collapse: separate; border-spacing: 0; margin: 20px 0; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); overflow: hidden;">
    <thead>
        <tr>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">ID</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Name</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Gender</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Age</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Email</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Phone</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Address</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Username</th>
            <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Password</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection
       

        // Check if connection is successful
       
        // Query to fetch user data
        $qry = mysqli_query($conn, "SELECT * FROM register");
        if (mysqli_num_rows($qry) > 0) {
            while ($row = mysqli_fetch_assoc($qry)) {
                echo "<tr style='transition: background-color 0.3s ease; hover:background-color: #f8f9fa;'>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['id']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['name']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['gender']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['age']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['email']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['phone']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['address']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['uname']}</td>";
                echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['psw']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9' style='padding: 12px; text-align: center; border: 1px solid #ddd;'>No users found</td></tr>";
        }

        // Close the connection
        mysqli_close($conn);
        ?>
    </tbody>
</table>




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
