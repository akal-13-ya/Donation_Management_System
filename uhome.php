<?php
include("dbconnect.php");
include("phpqrcode/qrlib.php");
session_start();

 $uid=$_SESSION['uid'];

// Initialize variables
$qrGenerated = false;
$paymentSuccess = false;

// Handle QR code generation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_qr'])) {
    $donationAmount = $_POST['donation_amount'];
    $requestId = $_POST['request_id'];
    $mobileNumber = "9600209586@ibl"; // UPI ID for Google Pay

    // Generate UPI URL
    $googlePayUrl = "upi://pay?pa={$mobileNumber}&pn=Donor&am={$donationAmount}&cu=INR";

    // Create QR code storage directory
    $dir = 'qr_codes/';
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    // Save QR code image
    $filePath = $dir . 'googlepay_donation_' . $requestId . '.png';
    QRcode::png($googlePayUrl, $filePath);

    // Store QR code generation details in the database (optional)
    $qry = "INSERT INTO qr_logs (request_id, amount, qr_url,uid) VALUES ('$requestId', '$donationAmount', '$googlePayUrl','$uid')";
    mysqli_query($conn, $qry);

    $qrGenerated = true;
}

// Handle payment completion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complete_payment'])) {
    $requestId = $_POST['request_id'];
    $donationAmount = $_POST['donation_amount'];

    // Fetch total payments made for this request
    $paidQuery = "SELECT SUM(amount) AS total_paid FROM payments WHERE request_id = '$requestId'";
    $paidResult = mysqli_query($conn, $paidQuery);
    $paidData = mysqli_fetch_assoc($paidResult);
    $totalPaid = $paidData['total_paid'] ?? 0;

    // Fetch requested amount
    $requestQuery = "SELECT amount FROM donationreq WHERE id = '$requestId'";
    $requestResult = mysqli_query($conn, $requestQuery);
    $requestData = mysqli_fetch_assoc($requestResult);
    $requestedAmount = $requestData['amount'];

    // Check if the donation exceeds the requested amount
    if (($totalPaid + $donationAmount) > $requestedAmount) {
        echo "<script>alert('Donation amount exceeds the requested amount!');</script>";
    } else {
        // Insert payment
        $qry = "INSERT INTO payments (request_id, amount, payment_status, payment_date,uid) VALUES ('$requestId', '$donationAmount', 'Success', NOW(),'$uid')";
        mysqli_query($conn, $qry);

        $paymentSuccess = true;
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

                    <li><a class="is-active" href="uhome.php">HOME</a></li>
                    <li><a href="yc.php">Your Contributions</a></li>

                     

                    </li>
                   
                    <li><a href="index.html">Logout</a></li>

                  </ul>

                </div> <!-- /#navbar -->

              </div> <!-- /.container -->
              
            </div> <!-- /.navbar-main -->


        </nav> 

    </header> <!-- /. main-header -->


	<div class="page-heading text-center">

		<div class="container zoomIn animated">
			
			<h1 class="page-title">DONATION REQUEST <span class="title-under"></span></h1>
			<p class="page-description">
				
			</p>
			
		</div>

	</div>

	<div class="main-container">
<body style="font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; color: #2d3436; line-height: 1.6;">
    <h2 style="text-align: center; color: #2d3436; font-size: 2rem; margin: 2rem 0; position: relative; padding-bottom: 10px;">Donation Requests</h2>

    <table style="width: 100%; border-collapse: separate; border-spacing: 0; margin: 20px 0; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <thead>
            <tr>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">ID</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Requested Amount</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Reason</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Urgency</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Additional Information</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Submitted At</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Amount Paid</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Balance Amount</th>
                <th style="padding: 12px; text-align: center; background-color: #f2f2f2; font-weight: 600; color: #333; border: 1px solid #ddd;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $qry = mysqli_query($conn, "SELECT * FROM donationreq");
            if (mysqli_num_rows($qry) > 0) {
                while ($row = mysqli_fetch_assoc($qry)) {
                    $requestId = $row['id'];
                    $requestedAmount = $row['amount'];

                    $paidQuery = "SELECT SUM(amount) AS total_paid FROM payments WHERE request_id = '$requestId'";
                    $paidResult = mysqli_query($conn, $paidQuery);
                    $paidData = mysqli_fetch_assoc($paidResult);
                    $totalPaid = $paidData['total_paid'] ?? 0;

                    $balanceAmount = $requestedAmount - $totalPaid;
                    $isRequirementComplete = ($balanceAmount <= 0);

                    echo "<tr style='transition: background-color 0.3s ease; hover:background-color: #f8f9fa;'>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['id']}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['amount']}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['reason']}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['urgency']}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['additional_info']}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$row['submitted_at']}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$totalPaid}</td>";
                    echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>{$balanceAmount}</td>";

                    if ($isRequirementComplete) {
                        echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd; color: #4caf50; font-weight: bold;'>Requirement Complete</td>";
                    } else {
                        echo "<td style='padding: 12px; text-align: center; border: 1px solid #ddd;'>
                                <form method='POST' style='margin: 0;'>
<input 
    type='number' 
    name='donation_amount' 
    placeholder='Enter Amount' 
    required 
    min='1'  
    max='{$balanceAmount}'
    style='width: 120px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin-right: 8px;'
>                                    <input type='hidden' name='request_id' value='{$row['id']}'>
                                    <button type='submit' name='generate_qr' 
                                        style='background-color: #4caf50; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease;'>
                                        Generate QR Code
                                    </button>
                                </form>
                              </td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9' style='padding: 12px; text-align: center; border: 1px solid #ddd;'>No donation requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php if ($qrGenerated): ?>
    <div style="text-align: center; margin: 20px 0; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333; margin-bottom: 15px;">QR Code Generated Successfully!</h2>
        <p style="color: #666; margin-bottom: 15px;">Scan this QR code to pay with Google Pay:</p>
        <img src="<?php echo $filePath; ?>" alt="Google Pay QR Code" style="max-width: 200px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <form method="POST" style="margin-top: 15px;">
            <input type="hidden" name="request_id" value="<?php echo $requestId; ?>">
            <input type="hidden" name="donation_amount" value="<?php echo $donationAmount; ?>">
            <button type="submit" name="complete_payment" 
                style="background-color: #4caf50; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease;">
                Payment Complete
            </button>
        </form>
    </div>
    <?php endif; ?>

   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Animation</title>
</head>
<body>
  <?php if ($paymentSuccess): ?>
   <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.2); 
        display: flex; justify-content: center; align-items: center; z-index: 1000;
        animation: modalFadeIn 0.3s ease-out forwards, modalFadeOut 0.5s ease-out 2.5s forwards;">
        
        <!-- Main Animation Container -->
        <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            position: relative; width: 300px; height: 300px; display: flex; flex-direction: column; 
            justify-content: center; align-items: center;
            animation: containerSlideUp 0.5s ease-out, containerSlideDown 0.5s ease-out 2.5s forwards;">

            <!-- Processing Circle Animation -->
            <div style="position: absolute; width: 100px; height: 100px; border: 4px solid #f3f3f3; 
                border-top: 4px solid #4CAF50; border-radius: 50%;
                animation: spin 1s linear infinite, fadeOut 0.3s ease-out 0.8s forwards;">
            </div>

            <!-- Success Circle -->
            <div style="position: absolute; width: 120px; height: 120px; border-radius: 50%; 
                border: 4px solid #4CAF50; opacity: 0; transform: scale(0);
                animation: successCircle 0.5s ease-out 0.8s forwards, glowPulse 2s infinite 0.8s;">
            </div>

            <!-- Corrected Checkmark -->
            <div style="position: absolute; opacity: 0;
                animation: checkmarkFadeIn 0.5s ease-out 1.3s forwards">
                <div style="position: relative; width: 32px; height: 60px; 
                    border-right: 6px solid #4CAF50; border-bottom: 6px solid #4CAF50;
                    transform: rotate(45deg); transform-origin: 50% 50%;
                    animation: checkmarkDraw 0.3s ease-out 1.3s forwards;">
                </div>
            </div>

            <!-- Success Stars/Particles -->
            <div style="position: absolute; width: 100%; height: 100%;">
                <div style="position: absolute; top: 50%; left: 50%; width: 8px; height: 8px; 
                    background: #4CAF50; border-radius: 50%; opacity: 0;
                    animation: particle1 0.8s ease-out 1.5s forwards;">
                </div>
                <!-- Repeated for particles 2-8 -->
            </div>

            <!-- Success Text -->
            <div style="position: absolute; bottom: 50px; text-align: center; opacity: 0;
                animation: textFadeIn 0.5s ease-out 1.8s forwards;">
                <p style="margin: 0; color: #4CAF50; font-size: 24px; font-weight: bold;">
                    Payment Successful!
                </p>
                <p style="margin: 10px 0 0; color: #666; font-size: 16px;">
                    Transaction completed
                </p>
            </div>
        </div>
    </div>

    <style>
        @keyframes modalFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes modalFadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }

        @keyframes containerSlideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes containerSlideDown {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(50px); opacity: 0; visibility: hidden; }
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes fadeOut {
            to { opacity: 0; visibility: hidden; }
        }

        @keyframes successCircle {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes glowPulse {
            0% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4); }
            70% { box-shadow: 0 0 0 20px rgba(76, 175, 80, 0); }
            100% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0); }
        }

        @keyframes checkmarkFadeIn {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes checkmarkDraw {
            from { height: 0; opacity: 0; }
            to { height: 60px; opacity: 1; }
        }

        @keyframes textFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes particle1 { 
            0% { transform: translate(-50%, -50%) rotate(0deg) translateY(0) scale(1); opacity: 1; }
            100% { transform: translate(-50%, -50%) rotate(0deg) translateY(75px) scale(0); opacity: 0; }
        }
        /* Additional particle animations would follow similar pattern */
    </style>
    <?php endif; ?>
</body>
</html>






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
