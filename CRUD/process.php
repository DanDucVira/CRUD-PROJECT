<?php

session_start();

$id = 0;
$update = false;
$name = "";
$location = "";

//connection to the database
$mysqli = new mysqli("localhost", "root", "root", "crud") or die(mysqli_error($mysqli));

//checks to see if the save button is pressed
if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $location = $_POST["location"];

    $_SESSION['message'] = "record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:index.php"); //redirects to the homepage

    //insert data to database
    $mysqli->query("INSERT INTO data (name,location) VALUES('$name','$location')") or
    die($mysqli->error);
}
//delete data from database
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:index.php"); //redirects to the homepage

}
//edit data from database
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    if (count($result) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }

}
//update data to database
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location:index.php"); //redirects to the homepage

}
