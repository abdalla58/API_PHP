<?php
require_once "database/database.php";
require_once "api/category.php";
$url = explode("/", $_SERVER['QUERY_STRING']);

header('Access-Control-Allow-Origin: application/json');
header('Content-Type: application/json');
//print_r($url);
if ($url[1] == 'v1') {
    //category
    if ($url[2] == 'category') {
        $category =new category();
        //methods
        if ($url[3] == 'all') {
            $data=$category->all();
            $res = [
                'status'=>200,
                'data'=>$data
            ];
            echo json_encode($res);
        } elseif ($url[3] == 'add') {
            header('Access-Control-Allow-Methods: POST');
            $data = file_get_contents("php://input");
            $data_de=json_decode($data,true);
            //print_r($data_de);die;
           $res= $category->add($data_de);
           if ($res){
               http_response_code(201);
               $res = [
                   'status'=>201,
                   'msg'=>'created'
               ];
           }else{
               http_response_code(400);
               $res = [
                   'status'=>400,
                   'data'=>'error'
               ];
           }
            echo json_encode($res);
        } elseif ($url[3] == 'update') {
            header('Access-Control-Allow-Methods: PUT');
            $data = file_get_contents("php://input");
            $data_de=json_decode($data,true);
            $id = ["id" => $data_de['id']];
            $data = $data_de['category'];
            $res= $category->update($data,$id);
            if ($res){
                http_response_code(201);
                $res = [
                    'status'=>201,
                    'msg'=>'updated'
                ];
            }else{
                http_response_code(400);
                $res = [
                    'status'=>400,
                    'data'=>'error'
                ];
            }
            echo json_encode($res);
        } elseif ($url[3] == 'delete') {
            header('Access-Control-Allow-Methods: DELETE');
            $data = file_get_contents("php://input");
            $data_de=json_decode($data,true);
            $id = ["id" => $data_de['id']];
            //$data = $data_de['category'];
            $res= $category->delete($id);
            if ($res){
                http_response_code(201);
                $res = [
                    'status'=>201,
                    'msg'=>'deleted'
                ];
            }else{
                http_response_code(400);
                $res = [
                    'status'=>400,
                    'data'=>'error'
                ];
            }
            echo json_encode($res);

        }
    }
    //user
    if ($url[2] == 'user') {
        //methods
        if ($url[3] == 'all') {

        } elseif ($url[3] == 'add') {

        } elseif ($url[3] == 'update') {

        } elseif ($url[3] == 'delete') {

        }
    }
}