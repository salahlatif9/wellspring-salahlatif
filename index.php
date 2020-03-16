<?php
include 'functions.php';
$message = '';
creatDB();
$result = displyLimitWithCol(1, 'TRAIN_LINE');
$numOfRow = countRows();


// colNumber is to save the # of the cureent table page and colName is to save the value that the table will be sorted based on
$colNumber = 1;
$colName = 'RUN_NUMBER';

//retrieve data and sort it by a column and within the limit
if(isset($_GET['rowN'])){
  list($value1,$value2) = explode('|', $_GET['rowN']);
  $colNumber = $value1;
  $colName = $value2;

  $result = displyLimitWithCol($colNumber, $colName);
  $message = '<label class="text-success"> Data Has Been Sorted by : ';
  $message .= $colName;
  $message .= ' </label>';
}
//display data sorted by TRAIN_LINE column
if(isset($_POST['train'])){
  $result = displyLimitWithCol(1, 'TRAIN_LINE');
  $colName = 'TRAIN_LINE';
  $message = '<label class="text-success"> Please Check The Table ordered by RUN_NUMBER </label>';
}
//display data sorted by ROUTE_NAME column
else if(isset($_POST['route'])){
  $result = displyLimitWithCol(1,'ROUTE_NAME');
  $colName = 'ROUTE_NAME';
  $message = '<label class="text-success"> Please Check The Table ordered by ROUTE_NAME </label>';
}
//display data sorted by RUN_NUMBER column
else if(isset($_POST['run'])){
  $result = displyLimitWithCol(1,'RUN_NUMBER');
  $colName = 'RUN_NUMBER';
  $message = '<label class="text-success"> Please Check The Table ordered by RUN_NUMBER </label>';
}
//display data sorted by OPERATOR_ID column
else if(isset($_POST['operator'])){
  $result = displyLimitWithCol(1,'OPERATOR_ID');
  $colName = 'OPERATOR_ID';
  $message = '<label class="text-success"> Please Check The Table ordered by OPERATOR_ID </label>';
}
//display data sorted by RUN_NUMBER column
if(isset($_POST['show'])){
  $result = displyLimitWithCol(1,'RUN_NUMBER');
  $colName = 'RUN_NUMBER';
  $message = '<label class="text-success"> Please Check The Table </label>';
}
//Read the uploaded file and add the data to the database
else if(isset($_POST["upload"])){
  $connect = mysqli_connect("localhost", "root", "", "wellspring");
  if($_FILES['file']['name']){
    $filename = explode(".", $_FILES['file']['name']);
    if(end($filename) == "csv"){
      $handle = fopen($_FILES['file']['tmp_name'], "r");
      while($data = fgetcsv($handle)){
        $data[0] = trim($data[0]);
        $data[1] = trim($data[1]);
        $data[2] = trim($data[2]);
        $data[3] = trim($data[3]);
        $TRAIN_LINE = mysqli_real_escape_string($connect, $data[0]);
        $ROUTE_NAME = mysqli_real_escape_string($connect, $data[1]);
        $RUN_NUMBER = mysqli_real_escape_string($connect, $data[2]);
        $OPERATOR_ID = mysqli_real_escape_string($connect, $data[3]);
        $message = updateData($TRAIN_LINE, $ROUTE_NAME, $RUN_NUMBER, $OPERATOR_ID);
      }
      fclose($handle);
      // header("location: index.php?updation=1");
    }
    else{
      $message = '<label class="text-danger">Please Select CSV File only</label>';
    }
  }
  else{
   $message = '<label class="text-danger">Please Select File</label>';
  }
}
//Read the uploaded file and delete the data from the database
else if(isset($_POST['delete'])){
  $connect = mysqli_connect("localhost", "root", "", "wellspring");
  if($_FILES['file']['name']){
    $filename = explode(".", $_FILES['file']['name']);
    if(end($filename) == "csv"){
      $handle = fopen($_FILES['file']['tmp_name'], "r");
      while($data = fgetcsv($handle)){
        $data[0] = trim($data[0]);
        $data[1] = trim($data[1]);
        $data[2] = trim($data[2]);
        $data[3] = trim($data[3]);
        $TRAIN_LINE = mysqli_real_escape_string($connect, $data[0]);
        $ROUTE_NAME = mysqli_real_escape_string($connect, $data[1]);
        $RUN_NUMBER = mysqli_real_escape_string($connect, $data[2]);
        $OPERATOR_ID = mysqli_real_escape_string($connect, $data[3]);
        $message = deleteData($RUN_NUMBER);
      }

      fclose($handle);
    //   header("location: index.php?updation=1");
    }
    else{
      $message = '<label class="text-danger">Please Select CSV File only</label>';
    }
  }
  else{
    $message = '<label class="text-danger">Please Select File</label>';
  }
}
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Wellspring Train Exercise</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   </head>
 <body>
    <div class="container">
      <br><br>
      <form method="post" enctype='multipart/form-data'>
        <div class="form-group">
        <p align="center">
          <label class="text-danger">
            Please Select A File(Only CSV Format) and ONE OF THE OPTIONS
          </label>
        </p>
        <input type="file" name="file" />
        <br/>
        <br/>
        <input type="submit" name="show" class="btn btn-info" value="Show Data">
        <input type="submit" name="upload" class="btn btn-info" value="Upload"/>
        <input type="submit" name="delete" class="btn btn-info" value="delete"/>
        </div>
      </form>
      <br />
      <br />
      <?php echo $message;?>
        <h3 align="center">All Trains Informations </h3>
        <br />
        <h3>Sort the Table By: </h3>
        <br />
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
           <thead>
            <tr>
              <form method="post"  enctype='multipart/form-data'>
              <th scope="col">
                <input type="submit" name="train" class="btn btn-info" value="TRAIN_LINE"/>
              </th>
              <th scope="col">
                <input type="submit" name="route" class="btn btn-info" value="ROUTE_NAME"/>
              </th>
              <th scope="col">
                <input type="submit" name="run" class="btn btn-info" value="RUN_NUMBER"/>
              </th>
              <th scope="col">
                <input type="submit" name="operator" class="btn btn-info" value="OPERATOR_ID"/>
              </th>
              </form>
            </tr>
           </thead>
           <tbody>
            <?php
             while($row = mysqli_fetch_array($result)){
              echo '
              <tr>
               <td>'.$row["TRAIN_LINE"].'</td>
               <td>'.$row["ROUTE_NAME"].'</td>
               <td>'.$row["RUN_NUMBER"].'</td>
               <td>'.$row["OPERATOR_ID"].'</td>
              </tr>
              ';
             }
             ?>
           </tbody>
          </table>
        </div>
        <?php
        $pagN;
        if($numOfRow%5 > 0){
          $pagN = ($numOfRow/5) + 1;
        }
        else{
            $pagN = ($numOfRow/5);
        }
        echo "<form method='get' >";
        for ($x = 1; $x <= $pagN; $x++) {
          echo'
          <input type="submit" name = "rowN" class="btn btn-info" value="'; echo$x; echo'|'; echo $colName; echo'"/>
          ';
        }
        echo"</form>";
        ?>
   </div>
   <br />
    <br />
 </body>
</html>
