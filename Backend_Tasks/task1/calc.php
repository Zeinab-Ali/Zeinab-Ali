               
<!doctype html>
<html lang="en">
  <head>
    <title>Task1</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="contianer">
        <div class="row">
            <div class="col-12 text-center text-danger mt-5">
                <h1> Simple Calculate </h1>
            </div>
            <div class="col-4 offset-4 mt-5">
                <form  method="post">
                    <div class="form-group ">
                      <label for="text">First Number</label>
                      <input type="number" name="first_number" id="number" class="form-control" placeholder="" aria-describedby="helpId">
                    </div> 
                    <div class="form-group">
                      <label for="text">Second Number</label>
                      <input type="number" name="second_number" id="number" class="form-control" placeholder="" aria-describedby="helpId"> 
                    </div>  
                    <div class="form-group text-center mt-5 mb-5"> 
                    <input name="calculate" class="btn btn-outline-danger mr-3 " type="submit" value="+" > 
                    <input name="calculate" class="btn btn-outline-danger mr-3" type="submit" value="-" > 
                    <input name="calculate" class="btn btn-outline-danger mr-3" type="submit" value="*"> 
                    <input name="calculate" class="btn btn-outline-danger mr-3" type="submit" value="%"> 
                    <input name="calculate" class="btn btn-outline-danger" type="submit" value="/">
                    </div>
                   

                </form>

                <?php  
   
    $sign="";
    
   if(isset($_POST['calculate'])){
    $firstnumber=$_POST['first_number'] ;
    $secondnumber=$_POST['second_number'] ;  
    $sign=$_POST['calculate'] ;
   
   if( $sign =="+"){ 
        $result = $firstnumber+ $secondnumber  ; 
        $message="<div class='alert alert-success'>".$result."</div>";
        echo $message;
    }
    elseif( $sign =="-"){
        $result =  $firstnumber- $secondnumber; 
        $message="<div class='alert alert-success'>".$result."</div>";
        echo $message;
    } 
    elseif( $sign =="*"){
        $result =  $firstnumber* $secondnumber; 
        $message="<div class='alert alert-success'>".$result."</div>";
        echo $message;
    }  
    elseif( $sign =="/"){
        $result =  $firstnumber/ $secondnumber;  
        $message="<div class='alert alert-success'>".$result."</div>";
        echo $message;
    }  
    elseif( $sign =="%"){
        $result =  $firstnumber% $secondnumber; 
        $message="<div class='alert alert-success'>".$result."</div>";
        echo $message;
    }  
    else{ 
        " ERROR....NOT FOUND";
    }
     

   }
  ?>
               
            </div>
        </div>
      </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>