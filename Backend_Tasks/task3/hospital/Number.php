<?php
session_start();

if($_POST){
    $errors=[];
    $phone = $_POST['phone'];
    if(empty($phone)){
        $errors['phone-required'] = "<div class='alert alert-danger'> Please enter your phone Number</div>";
    }else{
        if(is_numeric($phone)){
            if((int)$phone < 0){
                $errors['phone-number-neg'] = "<div class='alert alert-danger'> Please enter positive number </div>";
            }
           
        }else{
            $errors['phone-number-not-int'] = "<div class='alert alert-danger'> Please enter phone number contain integer numbers only </div>";
        }
    }
    if(empty($errors)){
        $_SESSION['phone'] = $phone ;
        header('location:Review.php');die;
    }
    
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Hospital</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body> 
      <div class="container-fluid">
        <div class="row w-100">
            <div class="col-12 d-flex flex-row justify-content-between align-items-center">
                <div class="align-self-start flex-shrink-1 m-5">
                    <img src="images/hospital.gif" alt="hospital" style="background-size:cover">
                </div>
                <div class="flex-fill w-70">
                    <form action="" method="POST" class=" ml-5">
                        <div class="input-group mt-3 w-50">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-light" for="phone"> Phone </label>
                            </div>
                            <input type="text" name="phone" id="num" class="form-control" placeholder="Enter Your Phone number" >
                        </div>

                        <div class="input-group mt-3 w-50">
                        <?php if(isset($errors['phone-required'])){
                                echo $errors['phone-required'];
                        }
                        if(isset($errors['phone-number-neg'])){
                            echo $errors['phone-number-neg'];
                        }
                        
                        if(isset($errors['phone-number-not-int'])){
                            echo $errors['phone-number-not-int'];
                        }
                       
                        ?>
                        </div>
                        
                        <div class="form-group">
                           <button class="btn btn-outline-primary mt-3"> submit </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
      </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>