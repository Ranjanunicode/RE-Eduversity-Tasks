<?php
header('Access-Control-Allow-Origin:*');
header('Control-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With');

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include('db.php');
// print_r($data);      ---> helps in printing data
// echo '{"msg":"success"}';    ---> helps in getting msg 
// echo $data->product_name;

if($data->discount==''){
    echo json_encode(['status'=>'Failed','msg'=>'Discount not provided!']);
}elseif($data->product_name==''){
    echo json_encode(['status'=>'Failed','msg'=>'name not provided!']);
}elseif($data->product_price==''){
    echo json_encode(['status'=>'Failed','msg'=>'Product price not provided!']);
}elseif($data->stock==''){
    echo json_encode(['status'=>'Failed','msg'=>'stock not provided!']);
}else{
    $query="INSERT INTO Products(product_name,product_price,stock,discount)";
    $query.="VALUES('$data->product_name',$data->product_price,$data->stock,$data->discount)";
    $run=mysqli_query($db,$query);

    if($run){
        echo json_encode(['status'=>'success','msg'=>'Product Added !']);
    }else{
        echo json_encode(['status'=>'Failed','msg'=>'Product Not Added !']);
    }
}


// http://localhost/api/create.php ---> POST request

// ************* Sample request **********
// {
//     "product_name":"Espoir Watch",
//     "product_price":800,
//     "stock":800,
//     "discount":20
// }
