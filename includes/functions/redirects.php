<?php

session_start();

function redirect($page)
{
    header('location:' . $page . '');
    exit;
}

function logged_in($user_type,$type)
{
    if($_SESSION["logged_in"])
    {
        
        if($user_type != $type){ 
            redirect("../login");
        }

    }
    else
    {
        redirect("../login");
    }  
}


function isAuth($role){
    if(isset($_SESSION['user_id'])){

        $user = User::find_by_id($_SESSION['user_id']);
        logged_in($user->role_id, $role);
        return $user;
    }else{
        redirect("../login");
    }
}

function type_redirect($type)
{
    
    if($_SESSION["logged_in"])
    {
        switch($type)
        {
            case 0:
                redirect("superadmin/index");
            case 1:
                redirect("projectmanager/index");
            case 2:
                redirect("sitemanager/index");
        }
    }
   
}


