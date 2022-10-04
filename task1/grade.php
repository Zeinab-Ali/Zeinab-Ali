 
  <?php  
   define('MAX_GRADE',100);
   $totalgrades = 500;  
 
    
   if($_POST){
    $grades=$_POST[ 'Physics_grade'] + $_POST['chemistry_grade']+ $_POST['biology_grade']+ $_POST['math_grade']+$_POST['computer_grade'] ;
    $persentage = ($grades / $totalgrades)*100; 
     
     
    

   if($persentage>=90 &&$persentage<=100){
        $message = "<div class='alert alert-success'>
                           Percentage : $persentage% ,Grade :A
                        </div>"; 
    }  
    elseif($persentage>=80 &&$persentage<90){
      $message = "<div class='alert alert-success'>
                         Percentage : $persentage% ,Grade :B
                      </div>"; 
  }  
  elseif($persentage>=70 &&$persentage<80){
    $message = "<div class='alert alert-success'>
                       Percentage : $persentage% ,Grade :C
                    </div>"; 
}  
elseif($persentage>=60 &&$persentage<70){
  $message = "<div class='alert alert-success'>
                     Percentage : $persentage% ,Grade D
                  </div>"; 
}  
elseif($persentage>=40 &&$persentage<60){
  $message = "<div class='alert alert-success'>
                     Percentage : $persentage% ,Grade E
                  </div>"; 
}  
elseif($persentage<40 &&$persentage>0){
  $message = "<div class='alert alert-success'>
                     Percentage : $persentage% ,Grade F
                  </div>"; 
}  
else{ 
  $message = "<div class='alert alert-success'>
  ERROR....Enter correct degres
  </div>" ; 
}
  } 

  ?>
   
               
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
                <h1> Grades </h1>
            </div>
            <div class="col-4 offset-4 mt-5">
                <form  method="post">
                    <div class="form-group ">
                      <label for="text">Physics Grade</label>
                      <input type="number" name="Physics_grade" id="number" class="form-control" placeholder="" aria-describedby="helpId">
                    </div> 
                    <div class="form-group">
                      <label for="text">Chemistry Grade</label>
                      <input type="number" name="chemistry_grade" id="number" class="form-control" placeholder="" aria-describedby="helpId">
                    </div> 
                    <div class="form-group">
                      <label for="text">Biology Grade</label>
                      <input type="number" name="biology_grade" id="number" class="form-control" placeholder="" aria-describedby="helpId">
                    </div> 
                    <div class="form-group">
                      <label for="text">Math Grade</label>
                      <input type="number" name="math_grade" id="number" class="form-control" placeholder="" aria-describedby="helpId">
                    </div> 
                    <div class="form-group">
                      <label for="text">Computer Grade</label>
                      <input type="number" name="computer_grade" id="number" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger rounded form-control"> Submit </button>
                    </div>
                </form>
                <?php 
                    if($_POST){
                    echo $message;
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