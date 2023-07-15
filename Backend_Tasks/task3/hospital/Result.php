<?php
session_start();
if(empty($_SESSION['phone'])){
    header('location:Number.php');die;
};
  
$values = [];
for($i=1;$i<=5;$i++){
        if($_SESSION["q$i"] == "Bad"){
            $values["q$i"] = 0 ;
        }elseif($_SESSION["q$i"] == "Good"){
            $values["q$i"] = 3;
        }elseif($_SESSION["q$i"] == "Very Good"){
            $values["q$i"]  = 5;
        }else{
            $values["q$i"] = 10;
        }
    }

    $result = $values["q1"] + $values["q2"] + $values["q3"] + $values["q4"] + $values["q5"];
    
    if($result < 25){
          $total_review = "Bad";
     }elseif($result >= 25 && $result < 35)  {
          $total_review = "Good";
     }elseif($result >= 35 && $result < 45)  {
          $total_review = "Very Good";
     }elseif($result >= 45 && $result <= 50) {
          $total_review = "Excellent";   
     }

     if($result <25 ){
         $Bad_Review = "<tr class='text-light bg-dark text-center' col-span='2'><td>We Will Call You Later On This Phone ( " . $_SESSION['phone'] . " )<td></tr>";
     }else{
        $Good_Review = "<tr class=' bg-info text-center' col-span='2'><td> THANKS FOR YOUR REVIEW <td></tr>";
     }

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Review</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
          <div class="my-5">
          <table class="table">
              <thead>
                  <tr>
                      <th>question</th>
                      <th>Reviews</th>
                  </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>Are you satisfied with the level of cleanliness?</td>
                     <td>
                        <?php if(isset($_SESSION['q1'])){
                                echo $_SESSION['q1'];
                            }?>
                     </td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the service prices?</td>
                     <td>
                     <?php if(isset($_SESSION['q2'])){
                                echo $_SESSION['q2'];
                            }?>
                     </td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the nursing service?</td>
                     <td>
                     <?php if(isset($_SESSION['q3'])){
                                echo $_SESSION['q3'];
                            }?>
                     </td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the level of the doctor?</td>
                     <td>
                     <?php if(isset($_SESSION['q4'])){
                                echo $_SESSION['q4'];
                            }?>
                     </td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the calmness in the hospital?</td>
                     <td>
                     <?php if(isset($_SESSION['q5'])){
                                echo $_SESSION['q5'];
                            }?>
                     </td>
                 </tr>
                 <tr class="bg-primary text-light">
                     <td>Total Review</td>
                     <td><?php if(isset($total_review)){
                        echo $total_review;
                    }?>
                     </td>
                 </tr>
             </tbody>
             <tfoot>
             <?php if(isset($Bad_Review)){
                     echo $Bad_Review;
                 }if(isset($Good_Review)){
                    echo $Good_Review;
                }?>
             </tfoot>
        </table>
            <!-- <div class="form-group w-100">
                <?php
                ?>
            </div> -->
    </div>
</div>
      
      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>