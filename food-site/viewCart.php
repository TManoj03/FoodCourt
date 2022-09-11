<?php
  include('./assets/nav.php');
?>

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Court</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container my-5 mt-5">
    <div class="row">
            <?php
            // echo "<pre>";
            // print_r($_SESSION["cart"]);
            ?>
                <table class="table table-bordered table-hover view-table">
                    <tr class="bg-warning">
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                    <?php

                        if (isset($_GET['del'])) {
                            foreach($_SESSION['cart'] as $keys=>$values){
                                if ($values['id']==$_GET['del']) {
                                    unset($_SESSION['cart'][$keys]);
                                }
                            }
                        }

                        if(!empty($_SESSION['cart'])){
                            $total=0;
                            foreach ($_SESSION['cart'] as $keys => $values) {
                                $amt=$values["qty"]*$values["price"];
                                $total+=$amt;
                                echo "
                                    <tr>
                                        <td>{$values['name']}</td>
                                        <td>{$values['qty']}</td>
                                        <td>{$values['price']}</td>
                                        <td>{$amt}</td>
                                        <td><a href='viewCart.php?del={$values['id']}'>Remove</a></td>
                                    </tr>
                                ";
                            }

                            echo "
                                <tr>
                                    <td colspan='3'></td>
                                    <td>Total</td>
                                    <td>{$total}</td>
                                </tr>
                                <tr>
                                    <td colspan='4'></td>
                                    <td>
                                    <form method='post' action='./payment-gateway/data.php'>
                                    <input type='submit' value='Order Now' name='pay1' class='btn btn-success mt-4'/></td>
                                </tr>
                                <input type='hidden' value={$total} name='total'/>
                                </form>
                            ";
                        }
                        else{
                            echo "<script>alert('Pleace Select Any Product..');</script>";
                            header('location:view.php');
                        }
                    ?>
                    
                </table>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>


