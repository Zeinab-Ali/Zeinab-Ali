<?php

$user = [];
if($_POST){

    $errors = [];
   if(empty($_POST['user-name'])){
        $errors['name-required'] = "<br><div class=' text-danger font-weight-bold  p-1 rounded'> * name Is Required </div>";
   }

   if(empty($_POST['loan-amount'])){   
        $errors['amount-required'] = "<br><div class='text-danger font-weight-bold  p-1 rounded'> * amount Is Required </div>";
   }

   if(empty($_POST['loan-years'])){   
    $errors['years-required'] = "<br><div class='text-danger font-weight-bold  p-1 rounded'> * years Is Required </div>";
   }

   if(!(empty($_POST['loan-years'])) && $_POST['loan-amount'] < 0){   
    $errors['amount-neg'] = "<br><div class='text-danger font-weight-bold  p-1 rounded'> * amount  must be positive </div>";
   }

   if(!(empty($_POST['loan-years'])) && $_POST['loan-years'] < 0){   
   $errors['years-neg'] = "<br><div class='text-danger  font-weight-bold  p-1 rounded'> * years must be positive </div>";
   }

   if(empty($errors)){
    $user['name'] = $_POST['user-name'];
    $user['loan-amount'] = $_POST['loan-amount'];
    $user['loan-years'] = $_POST['loan-years'];

    if($_POST['loan-years'] <= 3){
        $user['interest-rate'] = $_POST['loan-amount'] * 10/100 * $_POST['loan-years'];
        $user['loan-after-interest'] = $_POST['loan-amount'] + $user['interest-rate'];
        $user['monthly'] = $user['loan-after-interest'] / (12 * $_POST['loan-years']);
    }else{
        $user['interest-rate'] = $_POST['loan-amount'] * 15/100 * $_POST['loan-years'];
        $user['loan-after-interest'] = $_POST['loan-amount'] + $user['interest-rate'];
        $user['monthly'] = $user['loan-after-interest'] / (12 * $_POST['loan-years']);
    }

    $table = "<table class='table'>
    <thead>
      <tr class='bg-primary text-light'>
        <th >User Name</th>
        <th >Loan Amount</th>
        <th >Loan years</th>
        <th >Interest Rate</th>
        <th >Loan After Interest</th>
        <th >Monthly</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{$user['name']}</td>
        <td>{$user['loan-amount']}</td>
        <td>{$user['loan-years']}</td>
        <td>{$user['interest-rate']}</td>
        <td>{$user['loan-after-interest']}</td>
        <td>{$user['monthly']}</td>
      </tr>
    </tbody>
  </table>";
   }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Bank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body> 
      <div class="container-fluid">
        <div class="row w-100">
            <div class="col-12 d-flex flex-row justify-content-between align-items-center m-5 p-5">
                <div class="align-self-start flex-shrink-1 w-30">
                    <img src="images/bank.gif" alt="bank" style="background-size:cover">
                </div>
                <div class="flex-fill flex-grow-1 w-100 mt-4">
                    <form action="" method="POST" class=" ml-5">
                        <div class="input-group mt-3 w-50">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-light" for="name"> User Name </label>
                            </div>
                            <input type="text" name="user-name" id="name" value="<?= isset($_POST['user-name']) ? $_POST['user-name'] : ''?>" class="form-control w-50" placeholder="Enter Your User Name" >
                            <?php if(isset($errors['name-required'])){
                                echo $errors['name-required'];
                                }?>
                        </div>

                        <div class="input-group mt-3 w-50">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-light" for="loan-amount"> Loan Amount </label>
                            </div>
                            <input type="number" name="loan-amount" id="loan-amount" value="<?= isset($_POST['loan-amount']) ? $_POST['loan-amount'] : ''?>" class="form-control w-50" placeholder="Enter Loan Amount" >
                            <?php if(isset($errors['amount-required'])){
                            echo $errors['amount-required'];
                                }
                                if(isset($errors['years-neg'])){
                                  echo $errors['years-neg'];
                                 }?>
                        </div>

                        <div class="input-group mt-3 w-50">
                            <div class="input-group-prepend">
                                <label class="input-group-text bg-primary text-light" for="loan-years"> Loan years </label>
                            </div>
                            <input type="number" name="loan-years" id="loan-years" value="<?= isset($_POST['loan-years']) ? $_POST['loan-years'] : ''?>" class="form-control w-50" placeholder="Enter Loan years" >
                            <?php if(isset($errors['years-required'])){
                                echo $errors['years-required'];
                               }
                               if(isset($errors['years-neg'])){
                                echo $errors['years-neg'];
                               }?>
                        </div>

                        <div class="form-group">
                           <button class="btn btn-outline-primary mt-3"> submit </button>
                        </div>

                        <div class="input-group mt-3 w-95 me-2">
                        <?php if(isset($table)){
                                echo $table;
                        }?>
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