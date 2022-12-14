<?php
$title = "Register";
include_once "layouts/header.php";
include_once "App/Middlewares/auth_for_guest.php";
include_once "layouts/navbar.php";
include_once "layouts/breadcrumb.php";
use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Mails\VerificationCode;

$validation = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $validation->setKey('name')->setValue($_POST['name'])->required()->string()->min(2)->max(32);
    $validation->setKey('phone')->setValue($_POST['phone'])->required()->regex('/^01[0125][0-9]{8}$/')->unique('users','phone');
    $validation->setKey('email')->setValue($_POST['email'])->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->unique('users','email');
    $validation->setKey('password')->setValue($_POST['password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',"Minimum 8 characters,and maximum 32 , at least one uppercase letter, one lowercase letter, one number and one special character:")->confirmed($_POST['password_confirmation']);
    $validation->setKey('password_confirm')->setValue($_POST['password_confirm'])->required();
    $validation->setKey('gender')->setValue($_POST['gender'])->required()->in(['m','f']);
    if(empty($validation->getErrors())){
        $code = rand(100000,999999);
        $user = new User;
        $user->setname($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setPhone($_POST['phone']);
        $user->setGender($_POST['gender']);
        $user->setPassword($_POST['password']);
        $user->setCode($code);
        try{
          //  var_dump($user);die;
            $user->insert();
            $body = "<p> Hello {$_POST['name']} .</p><p> Your Verification Code:<b style='color:blue;'>{$code}</b> </p><p>Thank You.</p>";
            $verificationCode = new VerificationCode($_POST['email'],"Verification Code",$body);
            if($verificationCode->send()){
                $_SESSION['email'] = $_POST['email'];
                header('location:checkCode.php?page=register');die;
            }else{
                $error = "<p class='alert alert-danger text-center'>something went wrong</p>";
            }
           
        }catch(Exception $e){
            $error = "<p class='alert alert-danger text-center'>something went wrong</p>";
        }
    }
}
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                    <?= $error ?? "" ?>
                                        <input type="text" name="name" placeholder="Name" value="<?= $_POST['name'] ?? "" ?>">
                                        <?= "<p class='text-danger font-weight-bold  '>" . $validation->getError('name') . "</p>" ?>
                                        <input name="email" placeholder="Email" type="email" value="<?= $_POST['email'] ?? "" ?>">
                                        <?=  "<p class='text-danger font-weight-bold  '>" .$validation->getError('email') . "</p>" ?>
                                        <input name="phone" placeholder="Phone" type="number" value="<?= $_POST['phone'] ?? "" ?>">
                                        <?=  "<p class='text-danger font-weight-bold  '>" .$validation->getError('phone') . "</p>" ?>
                                        <input type="password" name="password" placeholder="Password" >
                                        <?=  "<p class='text-danger font-weight-bold  '>" . $validation->getError('password')  . "</p>" ?>
                                        <input type="password" name="password_confirm" placeholder="Confirm Password">
                                        <?=  "<p class='text-danger font-weight-bold  '>" . $validation->getError('password_confirmation') . "</p>" ?>
                                        <select name="gender" class="form-control" id="">
                                            <option <?= (isset($_POST['gender']) && $_POST['gender'] == 'm') ?  "selected" : '' ?> value="m">Male</option>
                                            <option <?= (isset($_POST['gender']) && $_POST['gender'] == 'f') ?  "selected" : '' ?>  value="f">Female</option>
                                        </select>
                                        <?= "<p class='text-danger font-weight-bold  '>" . $validation->getError('gender') . "</p>" ?>
                                        <div class="button-box mt-5">
                                            <button type="submit"><span>Register</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include_once "layouts/footer.php";
include_once "layouts/footer-scripts.php";
?>