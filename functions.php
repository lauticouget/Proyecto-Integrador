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
    return password_verify($data['password'], $foundUser['password']);
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

function uploadAvatar($user)
    {
        
        $errores=[];
        $title=$_POST['title'];

        $id=$user['id'];
        $defaultExt=".jpg";

        /* Capturamos el directorio del proyecto. */
        $dbPath= dirname(__FILE__); 

        /* Cambiamos el directorio por la Base de Imagenes */
        $dbPath=$dbPath . "/images/perfiles/";
        /* Le agregamos la concatenacion de nombre y extensión de cada foto de perfil */
        $dbPath=$dbPath . "perfil" . $id ;

        if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK)
            {   /* Si el archivo se subió correctamente extraemos "imagen.pjg" a una variable */
                $nombre=$_FILES['avatar']['name'];
                /* Capturamos la localización completa de la imagen en el servidor */
                $serverPath=$_FILES['avatar']['tmp_name'];
                
                /* extraemos la extension del nombre */
                $ext=pathinfo($nombre , PATHINFO_EXTENSION);


                if($ext != "jpeg" && $ext != "jpg" && $ext != "png")
                    {/* Si la imagen no es del tipo correcto devolvemos error */
                        $errores['avatar']="Débes subir tu imagen en JPG, PNG o JPEG.";
                        return $errores;
                    }

                $dbPath=$dbPath . "." . $ext;
                /* Movemos el archivo desde el espacio temporal (Server) A la base de datos (Renombrandolo con $dbPath); */
                move_uploaded_file($serverPath, $dbPath);
                     

                            /* SI NO SUBEN FOTO */            
            }
            
        if($_FILES['avatar']['name'] == "" )
            {   $dirH="C:/xampp/htdocs/proyecto-integrador/images/perfilHombre.JPEG";
                $dirM="C:/xampp/htdocs/proyecto-integrador/images/perfilMujer.jpg";
               
                $dbPath=$dbPath . $defaultExt;
               
                

                if($title =="Sr")
                    {
                        copy($dirH, $dbPath);
                    }
                elseif($title =='Sra')
                    {
                        copy($dirM, $dbPath);
                    }
            }
        
        return $errores;
            
    }
    

?>