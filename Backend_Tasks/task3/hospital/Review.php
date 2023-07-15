<?php 
session_start();

if(empty($_SESSION['phone'])){
    header('location:Number.php');die;
};

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $errors=[];

    if(empty($_POST['q1'])){
        $errors['q1'] = "<div class='alert alert-danger'> Please answer the first question </div>";
    }
    if(empty($_POST['q2'])){
        $errors['q2'] = "<div class='alert alert-danger'> Please answer the second question</div>";
    } 
    if(empty($_POST['q3'])){
        $errors['q3'] = "<div class='alert alert-danger'> Please answer the third question</div>";
    } 
    if(empty($_POST['q4'])){
        $errors['q4'] = "<div class='alert alert-danger'> Please answer the fourth question</div>";
    } 
    if(empty($_POST['q5'])){
        $errors['q5'] = "<div class='alert alert-danger'> Please answer the last question</div>";
    };

    if(empty($errors)){
        
        $_SESSION['q1'] = $_POST['q1'];
        $_SESSION['q2'] = $_POST['q2'];
        $_SESSION['q3'] = $_POST['q3'];
        $_SESSION['q4'] = $_POST['q4'];
        $_SESSION['q5'] = $_POST['q5'];

        header('location:Result.php');die;
        print_r($_SESSION);
    }
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
          <form action="" method="post">
          <table class="table">
              <thead>
                  <tr>
                      <th>question</th>
                      <th>Bad</th>
                      <th>Good</th>
                      <th>Very Good</th>
                      <th>Excellent</th>
                  </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>Are you satisfied with the level of cleanliness?</td>
                     <td><input type='radio' name='q1' value='Bad' ></td>
                     <td><input type='radio' name='q1' value='Good' ></td>
                     <td><input type='radio' name='q1' value='Very Good' ></td>
                     <td><input type='radio' name='q1' value='Excellent' ></td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the service prices?</td>
                     <td><input type='radio' name='q2' value='Bad'></td>
                     <td><input type='radio' name='q2' value='Good'></td>
                     <td><input type='radio' name='q2' value='Very Good' ></td>
                     <td><input type='radio' name='q2' value='Excellent'></td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the nursing service?</td>
                     <td><input type='radio' name='q3' value='Bad' ></td>
                     <td><input type='radio' name='q3' value='Good' ></td>
                     <td><input type='radio' name='q3' value='Very Good' ></td>
                     <td><input type='radio' name='q3' value='Excellent' ></td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the level of the doctor?</td>
                     <td><input type='radio' name='q4' value='Bad' ></td>
                     <td><input type='radio' name='q4' value='Good' ></td>
                     <td><input type='radio' name='q4' value='Very Good' ></td>
                     <td><input type='radio' name='q4' value='Excellent' ></td>
                 </tr>
                 <tr>
                     <td>Are you satisfied with the calmness in the hospital?</td>
                     <td><input type='radio' name='q5' value='Bad' ></td>
                     <td><input type='radio' name='q5' value='Good' ></td>
                     <td><input type='radio' name='q5' value='Very Good' ></td>
                     <td><input type='radio' name='q5' value='Excellent' ></td>
                 </tr>
             </tbody>
        </table>
            <div class="form-group">
                <button class="btn btn-outline-primary rounded w-100">Review </button>
            </div>
            <div class="form-group">
                <?php
                     if(isset($errors['q1'])){
                        echo $errors['q1'];
                    };
                    if(isset($errors['q2'])){
                        echo $errors['q2'];
                    };
                    if(isset($errors['q3'])){
                        echo $errors['q3'];
                    };
                    if(isset($errors['q4'])){
                        echo $errors['q4'];
                    };
                    if(isset($errors['q5'])){
                        echo $errors['q5'];
                    };
                ?>
            </div>
        </form>
    </div>
</div>
      
      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>