<?php
if(isset($_GET["payment_status"]) && ($_GET["payment_status"] == "Failed")) {
    header("location: failed.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	<title>Thank You, Mojo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
	<body>
    <div class="row">
        <div class="col">
            <div class="container mx-auto w-50 p-3 mt-5 text-center">
                <div class="page-header">
                    <h1 class="text-uppercase bg-success p-5 text-white rounded-top">Online Payment</h1>
                </div>
                <h3 style="color:#6da552">Thank You, Payment success!!</h3>
                <?php
                include 'src/Instamojo.php';
                $api = new Instamojo\Instamojo('test_f504076ce1126eface124df525c', 'test_63952ed71fbb0779ad656c72bf1', 'https://test.instamojo.com/api/1.1/');
                $payid = $_GET["payment_request_id"];
                try {
                    $response = $api->paymentRequestStatus($payid);
                    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
                    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
                    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
                // echo "<pre>";
                //    print_r($response);
                // echo "</pre>";
                }
                catch (Exception $e) {
                    print('Error: ' . $e->getMessage());
                }
                ?>
                <button class="btn btn-success mt-3" ><a style="text-decoration:none" class="text-white p-5" href='http://localhost/food-site/'>Back to Home</a></button>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>