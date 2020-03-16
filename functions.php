<?php
include 'con-db.php';

// countRows function to find out how many rows are there in the database

function countRows(){
  $conn = OpenCon();
  $sql = "SELECT COUNT(*) FROM csv";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);
  $conn->close();
  $rowNum = $row[0];
  return $rowNum;
}

// creatDB function is to create the table csv in the database if not exists

function creatDB(){
  $conn = OpenCon();
  $sql = "CREATE TABLE IF NOT EXISTS `csv` (
  `TRAIN_LINE` varchar(100) NOT NULL,
  `ROUTE_NAME` varchar(100) NOT NULL,
  `RUN_NUMBER` varchar(100) NOT NULL,
  `OPERATOR_ID` varchar(100) NOT NULL,
  PRIMARY KEY (`RUN_NUMBER`)
  )";

  if ($conn->query($sql) === TRUE) {
    return " <label class='text-success'>Table was created successfully <label>";
  } else {
    return " <label class='text-success'> Table is already exists </label>" . $conn->error;
  }
  $conn->close();
}

// deleteData function is to delete data in the database

function deleteData($RUN_NUMBER){
  $conn = OpenCon();
  $sql = "DELETE FROM csv WHERE RUN_NUMBER = '$RUN_NUMBER'";
  if ($conn->query($sql) === TRUE) {
    return "Record deleted successfully";
  } else {
    return "Error deleting record: " . $conn->error;
  }
  $conn->close();
}

// updateData function is to add more data into the database

function updateData($TRAIN_LINE, $ROUTE_NAME, $RUN_NUMBER, $OPERATOR_ID){
  $conn = OpenCon();
  if(strpos($TRAIN_LINE, "TRAIN_LINE") !== false ||$TRAIN_LINE == "" || $ROUTE_NAME == "" || $RUN_NUMBER == "" || $OPERATOR_ID == ""){
  }
  else{
    $sql = "INSERT INTO csv (TRAIN_LINE, ROUTE_NAME, RUN_NUMBER, OPERATOR_ID) VALUES
    ('$TRAIN_LINE', '$ROUTE_NAME', '$RUN_NUMBER', '$OPERATOR_ID')";

    if ($conn->query($sql) === TRUE) {
      return "Record updated successfully";
    } else {
      return "Error updating record: " . $conn->error;
    }
  }
  CloseCon($conn);
}

// displayLimitWithCol function is to retrieve data from database with specific sort By (column) and limit or rows to display
function displyLimitWithCol($limit, $orderB){
  $limit = $limit * 5;
  $limitM = $limit-5;
  $conn = OpenCon();
  $sql = "SELECT * FROM csv order by $orderB
    LIMIT $limitM, 5";
  $result = $conn->query($sql);
  CloseCon($conn);
  return $result;
}

?>
