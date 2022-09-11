<section class="menu" id="menu">
        <h1 class="text-center p-5 menu-txt">Best Menus</h1>
        <div class="container ">
          <div class="row">
            <?php
              for ($i=0; $i < $row = $result->fetch_array(); $i++) { 
                echo '<div class="col-sm-6 col-md-6 col-lg-3">';
                echo '<div class="card p-3 mt-3 shadow-lg p-3 mb-5 bg-white rounded">';
                echo '<img src="img/menu/'.$row['image'].'" class="card-image-top menu-img" alt="">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['name'].'</h5>';
                echo '<h6 class="card-title">Rs.'.$row['price'].'&nbsp;&nbsp; <s>$250</s></h6>';
                // echo '<input type="number" class="form-control mb-2">';
                echo '<div>
                    <i class="fa-solid fa-star ml-2 text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i><i class="fa-solid fa-star text-warning"></i>
                </div>';
                echo '<a href="view.php?id='.$row['id'].'" class="btn btn-primary btn-block">Taste Now &#128523;</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              } 
            ?>
          </div>
        </div>
    </section>