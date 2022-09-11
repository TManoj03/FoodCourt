<?php
session_start();
  $con = mysqli_connect('localhost','root','','food');

  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT * FROM foods ORDER BY rand() Limit 6";
  $result1 = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="view.css">
</head>

<body>

<?php
  include('./assets/nav.php');
?>

<div class="col-md-8 col-sm-12 ml-auto mr-auto ">
    <?php

  if(isset($_POST["addcart"])){

      if(isset($_SESSION["cart"])){

        $id_array=array_column($_SESSION["cart"],"id");
          if(!in_array($_GET["id"],$id_array)){

            $index = count($_SESSION["cart"]);
            $item=array(
              'id' => $_GET['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'qty' => $_POST['qty'],
            );
            $_SESSION['cart'][$index]=$item;
            echo "<script>alert('Product Added Successfully!!!');</script>";
            header('location:viewCart.php');

          }
          else{

            echo "<script>alert('Product Alredy Added....!!!');</script>";
          
          }

      }
      else{
          $item=array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'qty' => $_POST['qty'],
          );
          $_SESSION['cart'][0]=$item;
          echo "<script>alert('Product Added Successfully');</script>";
          header("location:viewCart.php");
      }

  }

    $url = $_SERVER['REQUEST_URI'];
      if($_GET['id']==''){
        header("location:index.php");
      }
      else{
        if(isset($_GET["id"])){
          $sql= "select * from foods where id={$_GET["id"]}";
          $res=$con->query($sql);
            if($res->num_rows>0){
              $row=$res->fetch_assoc();
              $name= $row['name'];
              $price = $row['price'];
              // echo '<pre>';
              // print_r($row);
              // echo '</pre>'; 
              echo '
              <form method="post" action="'.$url.'">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card mt-4 shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="card-horizontal">
                                <div class="img-square-wrapper">
                                    <img class="view-menu mt-5" src="./img/menu/'.$row['image'].'" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                      <tr><td>Name</td>
                                        <td><h4 class="card-title">'.$row['name'].'</h4></td></tr>
                                      <tr><td>Price</td>
                                        <td><p class="card-text">Rs.'.$row['price'].'&nbsp;&nbsp;Rs.<s>200</s></p></td></tr>
                                      <tr><td>Category</td>
                                        <td><p class="card-text">'.$row['content'].'</p></td></tr>
                                      <tr><td>Incredents</td>
                                        <td><p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa quis commodi illo?
                                        </p></td></tr>
                                      <tr><td>Qty</td>
                                        <td>
                                        <input type="text" name="qty" class="form-control mb-2 qty"required/>
                                        <input type="hidden" value="'.$name.'" name="name" class="form-control mb-2 qty"/>
                                        <input type="hidden" value="'.$price.'" name="price" class="form-control mb-2 qty"/>
                                        </td>
                                      </tr>
                                      <tr><td colspan="2"><input type="submit" value="Add to Cart" name="addcart" class="btn btn-success btn-block"/></td></tr>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>
              ';
            }
            else{
              header("location:index.php");
            }
        }
        else{
          header("location:index.php");
        }
      }
    ?>
</div>

<div class="related-menus">
    <h1 class="text-center p-5 menu-txt text-uppercase font-weight-bold">Related Menus</h1>
        <div class="container ">
          <div class="row">
            <?php
              for ($i=0; $i < $row = $result1->fetch_array(); $i++) { 
                echo '<div class="col-sm-4 col-md-4 col-lg-3">';
                echo '<div class="card p-3 mt-3 shadow-lg p-3 mb-5 bg-white rounded">';
                echo '<a href="#"><img src="img/menu/'.$row['image'].'" class="card-image-top menu-img" alt=""></a>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['name'].'</h5>';
                echo '<h6 class="card-title">Rs.'.$row['price'].'&nbsp;&nbsp; <s>$250</s></h6>';
                // echo '<input type="number" class="form-control mb-2">';
                echo '<a href="view.php?id='.$row['id'].'" class="btn btn-primary btn-block">Taste Now &#128523;</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
            ?>
          </div>
        </div>
</div>

<?php
  include('./assets/footer.php');
?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>