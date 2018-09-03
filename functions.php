<?php

function keepValue($userInput)
{
    if(isset($_POST[$userInput]))
    {
        return $_POST[$userInput];
    }
}

function validate($data)
{
    $errors=[];

    if($data)
    {
        $name=$data['name'];
        $username= trim($data['username']);
        $email=trim($data['email']);
        $password=$data['password'];
        $cpassword=$data['cpassword'];

        if(!$name)
        {
            $errors['name']='Completar Nombre.';
        }

        if (!$username)
        {
            $errors['username']='completar Nombre de Usuario.';
            
        }elseif(strlen($username)<5){
                $errors['username']='El nombre de Usuario Debe ser más largo.';
        }

        if(!$email)
        {
            $errors['email']='Completar Email.';
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors['email']='El Email es incompatible.';
            }
        }

        if(!$password)
        {
            $errors['password']='Completar contraseña.';
        }elseif(strlen($password)<6){
            $errors['password']='La contraseña Debe ser más larga.';
        }

        if(!isset($errors['password']))
        {
            if($cpassword!=$password)
            {
                $errors['cpassword']='La Confirmación de contraseña debe ser identica a la contraseña ingresada.';
            }
        }
        return $errors;


            
}

function createUser($data)
{
    $user=[
        'name'=> $_POST['name'],
        'username'=> $_POST['username'],
        'password'=> password_hash($_POST['password'], PASSWORD_DEFAULT),
        'email'=> $_POST['email'],
        
    ];
    $user['id']=generateId();
    return $user;
}
function generateId()
{
    $file=file_get_contents('users,json');

    if($file=="")
    {
        return 1;
    }else{
    $users=explode($file);
    array_pop($users);
    $lastUser=$users[count($users)-1];
    $lastUser=json_decode($lastUser, true);
    
    return $lastUser['id']+1 ;
    }
}
function saveUser($user)
{
    $jsonUser=json_encode($user);
    file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
    
}




?>