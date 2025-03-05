<?php
/**
 * insert data into database
 * @param string $table
 * @param array $data
 * @return array as assoc
 */

if(!function_exists('db_create')){
    function db_create(string $table,array $data) : array
    {
        $sql  = "INSERT INTO ".$table;
        $columns = '';
        $values = '';

        foreach($data as $key => $value){
            $columns .= $key.',';
            $values .=" '".$value."' ,";
        }

        $columns = rtrim($columns,',');
        $values = rtrim($values,',');

        $sql .= " (".$columns.") VALUES (".$values.")";
//        echo $sql;
        $query = mysqli_query($GLOBALS['connect'] , $sql); //add data to database
        $id = mysqli_insert_id($GLOBALS['connect']); //get last id
       $first = mysqli_query($GLOBALS['connect'] ,"SELECT * FROM $table WHERE id = $id"); //get data from database
        $data = mysqli_fetch_assoc($first);  //return data as assoc

        return $data;
    }
}


/**
 * update data in database
 * @param string $table
 * @param array $data
 * @param int $id
 * @return array as assoc
 */

if(!function_exists('db_update')) {
    function db_update($table, array $data , int $id):array
    {
        $sql  = "UPDATE ".$table." Set ";
        $column_value = '';

        foreach($data as $key => $value){
            $column_value .= $key."='".$value."', ";
        }

        $column_value = rtrim($column_value,", ");
        $sql .= $column_value . " where id =".$id;
//echo $sql;
        mysqli_query($GLOBALS['connect'] , $sql); //update data in database
        $first = mysqli_query($GLOBALS['connect'] ,"SELECT * FROM $table WHERE id = $id"); //get data from database
        $data = mysqli_fetch_assoc($first);  //return data as assoc
        $GLOBALS['query'] = $first;

        return $data;
    }
}


/**
 * delete user from DB
 * @param int $id
 * @param string $table
 */

if(!function_exists('db_delete')){
    function db_delete(string $table ,int $id) : string{
        $query = "DELETE FROM " . $table . " Where id = " . $id ;
//    echo $query;
        mysqli_query($GLOBALS['connect'] , $query);
        $GLOBALS['query'] = $query;


        return "successfully deleted " . $id;
    }
}


/**
 * find user in DB
 * @param int $id
 * @param string $table
 */

if(!function_exists('db_find')){
    function db_find(string $table ,int $id) : array{
        $query = "SELECT * FROM " . $table . " Where id = " . $id ;
//    echo $query;
        $row = mysqli_query($GLOBALS['connect'] ,$query); //get data from database
        $data = mysqli_fetch_assoc($row);  //return data as assoc
        $GLOBALS['query'] = $query;

        return $data;
    }
}


/**
 * search for a single row data from db
 * @param int $id
 * @param string $table
 */

if(!function_exists('db_first')){
    function db_first(string $table ,string $query) : array{
        $sql = "SELECT * FROM ".$table.' '.$query ;
//    echo $query;
        $row = mysqli_query($GLOBALS['connect'] ,$sql); //get data from database
        $data = mysqli_fetch_assoc($row);  //return data as assoc
        $GLOBALS['query'] = $query;

        return $data;
    }
}

/**
 * search for a multiple rows data from db
 * @param string $query
 * @param string $table
 */

if(!function_exists('db_get')){
    function db_get(string $table ,string $query_str) : array{
        $query = mysqli_query($GLOBALS['connect'] ,"select * from ".$table." ".$query_str);
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query' => $query,
            'num' => $num
        ];
    }
}



/**
 * pagination to retrieve multiple rows
 * @param string $query
 * @param string $table
 * @param string $query_str
 * @param int $limit
 * @return array
 */

if(!function_exists('db_paginate')){
    function db_paginate(string $table ,string $query_str , int $limit=15 , string $orderby='asc') : array{

        if(isset($_GET['page']) && is_numeric($_GET['page']) &&  $_GET['page'] > 0){
            $current_page = $_GET['page'] - 1;
        }else{
            $current_page = 0;
        }

        $query_count = mysqli_query($GLOBALS['connect'] ,"select count(id) from ".$table." ".$query_str);
        $count= mysqli_fetch_row($query_count);
        $total_records = $count[0];

        $start = $current_page * $limit;
        $total_page = ceil($total_records / $limit);


        $query = mysqli_query($GLOBALS['connect'] ,"select * from ".$table." ".$query_str . " ORDER BY id " .$orderby. " LIMIT ".$start.",".$limit);
        $num = mysqli_num_rows($query);
        $GLOBALS['query'] = $query;
        return [
            'query' => $query,
            'num' => $num ,
            'total_records' => $total_records,
            'total_page' => $total_page,
        ];
    }
}


















