<?php

if(!function_exists("pre"))
{
    function pre($data=null)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

if(!function_exists("page_alert"))
{
    function page_alert($type=null,$message=NULL)
    { 
        $_SESSION["page_alert"]=array("type"=>$type,"message"=>$message);
        
    }
}

if(!function_exists("return_data"))
{
    function return_data($status,$message,$data)
    { 
        $return = array(
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        );
        echo json_encode($return);
        die;
    }
}