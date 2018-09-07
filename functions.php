<?php
session_start();
function giveSession(){
    if(session_status()==0)
    {
        return "session disabled";
    }elseif(session_status()==1){
        return "Not Loged";
    }elseif(session_status()==2){
        return "Loged";
    }
}


function dd($var)
    {
        echo"<pre>";
        die(var_dump($var));
        echo "</pre>";
    }




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
    $file= file_get_contents('users.json');

    if($file == ""){
        return 1;
    }

    $users=explode(PHP_EOL , $file);
    array_pop($users);
    $lastUser=$users[count($users)-1];
    $lastUser=json_decode($lastUser, true);
    
    return $lastUser["id"]+1 ;
    
}

function saveUser($user)
{
    $jsonUser=json_encode($user);
    file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
    
}



function decodeUsers()
{
    $jsonFile = file_get_contents('users.json');
    $jsonUsers = explode(PHP_EOL , $jsonFile);
    array_pop($jsonUsers);

    foreach($jsonUsers as $jsonUser)
    {
        
        $users[]=json_decode($jsonUser, true);
    }

    return $users;
    
}

function findUser(array $data)
{
    $users=decodeUsers();

    foreach($users as $user)
    {
        if($user['username'] == $data['username'])
        {    
            return $user;
            exit;
        }
    }
    
}

function checkPassword($data, $foundUser)
{
    if(password_verify($data['password'], $foundUser['password']))
    {
        return true;
    }else{
        return null;
    }
    

}

function Login($foundUser)
{
    $_SESSION['email']=$foundUser['email'];
    setcookie('email', $foundUser['email'], time()+3600);
}

function loginController()
{
    if(isset($_SESSION['email']))
    {
        return true;
    }elseif(isset($_COOKIE['email']))
    {
        $_SESSION['email']=$_COOKIE['email'];
        return true;
    }else{
        return false;
    }

}


function logout()
    {
        session_destroy();
        setcookie('email', "", time()-1);
    }



    

?>