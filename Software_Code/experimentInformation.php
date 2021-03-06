<?php

include 'Includes/header.php';
include "Includes/db.inc.php";
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
//   header("location: login.php");
//   exit;
// }

//make sure correct user is logged in for the experiment they are accessing

//get expeirment id
$experimentID = $_SESSION["experimentID"];
$experimentName = $_SESSION["experimentName"];

if(isset($_POST['edit'])){

  $newInfo = $_POST['addedinfo'];
  if (empty($newInfo)) {
    echo "The experiment must have a description!";

  } else {
  //send to db sql here
  $sql = $conn->prepare("UPDATE experiments SET experimentInformation='{$newInfo}' WHERE experimentid={$experimentID}");
  $sql->bind_param('s', $newInfo);

  if ($sql->execute() === TRUE) {
    echo "New description added successfully!";
  }
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }}
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Experiment Information</title> <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header style="height:150px;">
    <a href="Includes/redirect.inc.php"><img class="img-fluid" src="University-of-Dundee-logo.png" width="300px" style="padding:20px; float: left"></a>
    <button onclick="location.href='Includes/logout.inc.php';" type='button' class='btn btn-secondary' style="float: right; margin:20px">Logout</button>
  </header>

  <div class="jumbotron text-center">
    <?php
    echo "<h1 class='text-center'>".$experimentName."</h1>";
    ?>
  </div>
  <div class="container-fluid" style="padding:0">
    <div class="jumbotron" style="margin-bottom:1px;">
          <p> <b> Experiment description: </b> </p>
          <?php
          //get information from experiment list page to display the selected experiment
          $query = "SELECT experimentInformation FROM experiments WHERE experimentid={$experimentID}";
          $result = mysqli_query($conn, $query);

          // foreach( $result as $row ) {
          while($row = mysqli_fetch_array($result)){
            echo $row['experimentInformation'];
          }
          ?>
          <br><br>
            <a href="videoPage.php"> <button class='btn btn-outline-success' type='button'>View Videos</button> </a>
            <a href="questionnaireList.php"> <button class='btn btn-outline-success' type='button'>View Questionnaires</button> </a>
            <?php
              if(ISSET($_SESSION['experimentID']) && ISSET($_SESSION['USER_role']) && $_SESSION['USER_role'] == 'Principal Researcher'){
                echo "<button class='btn btn-outline-success' type='button' onclick='location.href=\"UserManagement/ManageCoResearchers.php?eid=".$experimentID."\"'>Manage Co-Researchers</button>";
              }
            ?>
            <br><br>
            <p> <b> Update experiment information: </b> </p>
        <form method="POST">
            <input type="text" value "Add a new description here" name="addedinfo">
            <input type="submit" class='btn btn-outline-success' value="Edit Information" name="edit">
        </form>
        <br>
        <form action="experimentList.php">
            <input type="submit" class='btn btn-outline-success' value="Return to Experiments List" />
    </form>
    </div>
    </div>


  <footer>
        <img class="img-fluid mx-auto d-block" src="University-of-Dundee-logo-small.png" width="100px" style="padding:20px">
  </footer>
</body>

</html>
