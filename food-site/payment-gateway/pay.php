<?php
    if(isset($_POST["pay"])) {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $purpose = $_POST['purpose'];
        $amount = $_POST['amount'];

        include 'src/Instamojo.php';


        $api = new Instamojo\Instamojo('test_f504076ce1126eface124df525c', 'test_63952ed71fbb0779ad656c72bf1', 'https://test.instamojo.com/api/1.1/');


        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $purpose,
                "amount" => $amount,
                "send_email" => false,
                "email" => $email,
                "send_sms" => false,
                "phone" => $phone,
                "buyer_name" => $name,
                "allow_repeated_payments" => false,
               "redirect_url" => "http://localhost/food-site/payment-gateway/success.php",
                // "webhook" => "http://localhost/payment_gateway/webhook.php"
                ));
            // print_r($response);
            $pay_ulr = $response['longurl'];
            header("Location: $pay_ulr");
            exit();
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
    }

?>