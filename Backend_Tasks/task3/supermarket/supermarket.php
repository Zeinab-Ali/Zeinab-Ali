<?php
$massage = "";
$product_detils = [[]];
$head = ['Product Name', 'Price', 'Quantities', 'Sub total'];

if (isset($_POST['user_details'])) {
   // print_r($_POST);
    $user = $_POST['user'];
    $city = $_POST['city'];
    $product = $_POST['product'];
    $massage .= "<table table-danger text-center w-50>";
    for ($j = 1; $j < 4; $j++) {
        $massage .= "<th>";
        $massage .= $head[$j - 1];
        $massage .= "</th>";
    }
    for ($i = 1; $i <= $product; $i++) {
        $massage .= "<tr>";
        for ($j = 0; $j < 3; $j++) {
            $massage .= "
            <td>
            <input name='value[{$i}][$head[$j]]' class='form-control' required>
            </td>";
        }  
        $massage .= "</tr>";
    }

    $massage .= "</table>
    <button name='order_bill' class='btn btn-outline-primary mt-3 text-center'>Receipt</button>
    ";
}
if (isset($_POST['order_bill'])) {
    $res_table='';
    $total=0;
    $discount=0;
    $city='';
    $res_table .= "<table >";
    for ($j = 1; $j <= 4; $j++) {
        $res_table .= "<th>";
        $res_table .= $head[$j - 1];
        $res_table .= "</th>";
    }
    for ($i = 1; $i <= $_POST['product']; $i++) {
        $res_table .= "<tr>";
        for ($j = 0; $j < 3; $j++) {
            $res_table .= "
            <td>
            {$_POST['value'][$i][$head[$j]]} 
            </td>";
        }
        $res=$_POST['value'][$i][$head[1]]*$_POST['value'][$i][$head[2]];
        $total+=$res;
        $res_table .= "
        <td>
        $res
        </td>";
        $res_table .= "</tr>";
    }
    $res_table.="</table>";
    if($total<3000 && $total>1000){
       $discount=$total*0.10;
    }else if($total<4500){
        $discount=$total*0.15;
    }else{
        $discount=$total*0.20;
    }
    $totalAfter=$total-$discount;
    if($_POST['city']=='0')
    $city='Cairo';
    else if($_POST['city']=='30')
    $city='Giza';
    else if($_POST['city']=='50')
    $city='Alex';
    else
    $city='Other';
    $net_total=$totalAfter+intval($_POST['city']);
    $check="<table>
    <tr>
    <th>Client Name</th>
    <td>{$_POST['user']}</td>
    </tr>
    <tr><th>City</th>
    <td>{$city}</td>
    </tr>
    <tr><th>Total</th>
    <td>{$total} EGP</td>
    </tr>
    <tr><th>Discount</th>
    <td>{$discount} EGP</td>
    </tr>
    <tr><th>Total after discount</th>
    <td>{$totalAfter} EGP</td>
    </tr>
    <tr><th>Delivery</th>
    <td>{$_POST['city']} EGP</td>
    </tr>
    <tr><th>Net Total</th>
    <td>{$net_total} EGP</td>
    </tr>
    </table>";

    //echo $res_table;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>SuperMarket</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        #sticky-sidebar {
            position: fixed;
            max-width: 20%;
        }

        table,
        th,
        td { 

            border: 1px solid black;
        }

        table {
            width: 500px; 
            text-align: center;
        }
    </style>
 
 
</head>

<body>
<div class="container-fluid">
        <div class="row w-100">
            <div class="col-10 d-flex flex-row justify-content-between align-items-center m-5 p-5">
                <div class="align-self-start flex-shrink-1 w-30">
                <img src="images/subermarket.jpg" width="600" height="600">
                </div>
                <div class="flex-fill flex-grow-1 w-100  ">
                    <form action="" method="POST"class=" ml-5">
                        <div class="form-group mt-3 w-50">
                            <div class="form-group-prepend">
                                <label  class="input-group-text bg-primary text-light" name="user">Enter UserName:</label>
                                <input name="user" class="form-control " value="<?= $_POST['user'] ?? "" ?>" required>
                                
                            </div>
                            <div class="form-group mt-3 w-50">
                                <label class="input-group-text bg-primary text-light" name="city">Enter City</label>
                                
                                
                                <?php if(isset($_POST['city'])){?>
                                <select name="city" class="form-control" id="city">
                                    <option <?=  $_POST['city'] == '0' ? 'selected=selected' : ''  ?> value="0">Cairo</option>
                                    <option <?=  $_POST['city'] == '30' ? 'selected=selected' : '' ?> value="30">Giza</option>
                                    <option <?=  $_POST['city'] == '50' ? 'selected=selected' : '' ?> value="50">Alex</option>
                                    <option <?=  $_POST['city'] == '100' ? 'selected=selected' : '' ?> value="100">Other</option>

                                </select>
                                <?php } 
                                else{?>
                                <select name="city" class="form-control" id="city">
                                    <option value="0">Cairo</option>
                                    <option value="30">Giza</option>
                                    <option  value="50">Alex</option>
                                    <option  value="100">Other</option>

                                </select>
                                <?php }?>

                            </div>
                            <div class="form-group mt-3 w-50">
                            <div class="form-group-prepend">
                                <label class="input-group-text bg-primary text-light" for="product"> Number of Products </label> 
                                
                            </div>
                                <input name="product" class="form-control " value="<?= $_POST['product'] ?? "" ?>">
                            </div>
                            <br>
                            <div class="form-group text-center">
                                <button name="user_details" class="btn btn-outline-primary mt-3">Enter Products</button>
                            </div>
                           
                            
                            <?php
                            
                            echo $massage; 
                        
                            ?>
                        </form>
                         <?php 
                         if(isset($res_table)){
                         echo $res_table;
                         echo '<br>';
                         echo $check;
                         }
                         ?>
                    </div>


                </div>
               
            
        </div>
    </div> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>