<?php
header('Access-Control-Allow-Origin:*');
header('Control-Type:application/json');
header('Access-Control-Allow-Methods:GET');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include('db.php');
$query="SELECT * FROM Products";

if(isset($_GET['id'])){
    $query="SELECT * FROM Products WHERE id=".$_GET['id'];
}
    $run=mysqli_query($db,$query);
    $products=mysqli_fetch_all($run);
    echo json_encode($products);



// http://localhost/api/read.php?id=3  ---> GET request