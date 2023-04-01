<?php
header('Access-Control-Allow-Origin:*');
header('Control-Type:application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include('db.php');

if($data->id){
    $query2 = "SELECT * FROM products WHERE id=".$data->id;
    $run2=mysqli_query($db,$query2);
    $product=mysqli_fetch_assoc($run2);
    $product_name=$product['product_name'];
    $product_price=$product['product_price'];
    $stock=$product['stock'];
    $discount=$product['discount'];


    if($data->discount!=''){
        $discount=$data->discount;
    }

    if($data->product_name!=''){
        $product_name=$data->product_name;
    }

    if($data->product_price!=''){
        $product_price=$data->product_price;
    }

    if($data->stock!=''){
        $stock=$data->stock;
    }


    echo $product_name."<br>";
    echo $product_price."<br>";
    echo $stock."<br>";
    echo $discount."<br>";


    $query="UPDATE products SET ";
    $query.="product_name='$product_name',";
    $query.="product_price=$product_price,";
    $query.="stock=$stock,";
    $query.="discount=$discount WHERE id=".$data->id;


    $run=mysqli_query($db,$query);

    if($run){
        echo json_encode(['status'=>'success','msg'=>'Product Updated !']);
    }else{
        echo json_encode(['status'=>'Failed','msg'=>'Product Not Updated !']);
    }
    
}else{
    echo json_encode(['status'=>'Failed','msg'=>'Product id not provided']);
}


// http://localhost/api/update.php ---> PUT request


// ************* Sample request **********
// {
//    "id":2,
//    "product_name":"Sonata NextGen Watch"
// }