<?php


require_once __DIR__.'/includes/app.php';


//insert data
$data = [
    'name' => 'Ezz',
    'email' => "F7TlD@example.com",
    'password' => 12345678,
    'created_at' =>date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
];
//db_create('users',$data);
//echo '<pre>';
//var_dump($data);



//update data
$data2 = [
    'name'=>'soliman',
    'email' => 'soliman@gmail.com',
//    'password' => 12345678,
//    'created_at' =>date('Y-m-d H:i:s'),
//    'updated_at' => date('Y-m-d H:i:s')
];


//db_update('users' , $data2 ,  28);
//echo '<pre>';
//var_dump($data2);


//delete_data
//db_delete('users' , 2);


//find row
//echo "<pre>";
//var_dump(db_find('users' , 39));



//search query
//$search = db_first('users' , " where name = 'Ezz';");
//echo "<pre>";
//var_dump($search);


//$users = db_get('users' , "");
//if($users['num'] > 0){
//    while($row = mysqli_fetch_assoc($users['query'])){
//        echo $row['name'] . "<br>";
//    }
//}


//if(!empty($GLOBALS['query'])){
//    mysqli_free_result($GLOBALS['query']);
//
//}
//
//
//
//



$users = db_paginate('users' , '' , 10);
while($row = mysqli_fetch_assoc($users['query'])){
        echo $row['email'] . "<br>";
}

echo "<ul>";
for($i =1;$i <= $users['total_page'];$i++){
    echo '<li><a href="?page='.$i.'">'. $i . '</a></li>';
}
echo "<ul>";


















mysqli_close($GLOBALS['connect']);