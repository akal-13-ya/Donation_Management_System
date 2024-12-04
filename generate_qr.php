<?php
include("dbconnect.php");
include("phpqrcode/qrlib.php"); // Include the QR code library

// Handle form submission to generate QR code
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_qr'])) {
    $donationAmount = $_POST['donation_amount']; // Get the entered amount
    $mobileNumber = "8248119413@upi"; // The UPI ID for Google Pay
    $requestId = $_POST['request_id']; // Get the request ID

    // Google Pay UPI URL format
    $googlePayUrl = "upi://pay?pa={$mobileNumber}&pn=Donor&am={$donationAmount}&cu=INR";

    // Create a folder to store the QR code if it doesn't exist
    $dir = 'qr_codes/';
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    // Path to save the QR code image
    $filePath = $dir . 'googlepay_donation_' . $requestId . '.png';

    // Generate and save the QR code image
    QRcode::png($googlePayUrl, $filePath);

    // Save QR code generation details in database (optional)
    $qry = "INSERT INTO qr_logs (request_id, qr_url) VALUES ('$requestId', '$googlePayUrl')";
    mysqli_query($conn, $qry);

    // Display the QR code and payment completion option
    $qrGenerated = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation QR Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .success-animation {
            font-size: 20px;
            color: green;
            font-weight: bold;
            animation: successAnimation 1s ease-in-out;
        }
        @keyframes successAnimation {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        .qr-code {
            margin: 20px 0;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Generate Donation QR Code</h1>
    <form method="POST">
        <label for="request_id">Request ID:</label><br>
        <input type="text" id="request_id" name="request_id" required><br><br>

        <label for="donation_amount">Donation Amount:</label><br>
        <input type="number" id="donation_amount" name="donation_amount" step="0.01" required><br><br>

        <button type="submit" name="generate_qr">Generate QR Code</button>
    </form>

    <?php if (isset($qrGenerated) && $qrGenerated): ?>
        <div class="qr-code">
            <h2>Google Pay QR Code Generated Successfully!</h2>
            <p>Scan this QR code to pay with Google Pay:</p>
            <img src="<?php echo $filePath; ?>" alt="Google Pay QR Code" />
        </div>
        <button id="completePaymentBtn" onclick="paymentComplete()">Payment Complete</button>
        <div id="paymentStatus"></div>
    <?php endif; ?>

    <script>
        function paymentComplete() {
            // Show success animation
            document.getElementById('paymentStatus').innerHTML = '<div class="success-animation">Payment Successful! &#10003;</div>';

            // Store payment details in the database
            const donationAmount = '<?php echo $donationAmount ?? ''; ?>';
            const requestId = '<?php echo $requestId ?? ''; ?>';

            // Make an AJAX call to store payment details
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // Use the same page
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert('Payment details stored successfully!');
                } else {
                    alert('Error storing payment details.');
                }
            };
            xhr.send("store_payment=1&donation_amount=" + donationAmount + "&request_id=" + requestId);
        }
    </script>

    <?php
    // Handle AJAX request to store payment details in the database
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['store_payment'])) {
        $donationAmount = $_POST['donation_amount'];
        $requestId = $_POST['request_id'];
        $paymentStatus = "Success"; // Example status

        // Insert payment details into the payments table
        $qry = "INSERT INTO payments (request_id, amount, payment_status) VALUES ('$requestId', '$donationAmount', '$paymentStatus')";
        mysqli_query($conn, $qry);

        echo "Payment details stored successfully!";
        exit; // Stop further output to ensure AJAX response is clean
    }
    ?>
</body>
</html>
