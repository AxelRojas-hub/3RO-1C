<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">

</head>
<body>
    <header></header>
    <?php
 function checkIngreso(string $nombre)
 {
     $cadena = $nombre ?? '';
     $valor = trim($cadena);
     if ($valor === '') {
         return false;
     }
     if (!preg_match('/^[A-Za-z0-9]+$/', $valor)) {
         return false;
     }
     return true;
 }
if(isset($_POST["nombre"])){



    require_once("usuario.class.php");    
    $nombre = $_POST["nombre"];
    if(checkIngreso($nombre)){
        if(isset($_POST["crear"])){
            $usuario =new usuario($nombre);
            $flag =$usuario->crearUsuario();
            if($flag){
                echo '<div class="dinInit">Bienvenido
                <p>Numero de visita '.$usuario->getVisitas().'</p>
                <p>Ultima visita '.$usuario->getUltimaVisita().'</p>
                <a href="index.php">volver</a>
                <a href="procesaLista.php">Ingresar a la lista de tareas</a>
                </div>
                ';
            }
            else{
                echo '<div clas="divInit">Este usuario ya existe.
                    <a href="index.php">volver</a></div>';
            }
            
        }
        else{
            //CUANDO CREA EL USUARIO, TAMBIEN SE CREA UN ELEMENTO DENTRO DE SESSION
            //CON ESE USUARIO, AL CUAL PUEDO ACCEDER A TRAVES DEL NOMBRE
            //POR SI NECESITO VOLVER A ACCEDER AL OBJETO USUARIO
            $usuario =new usuario($nombre);
            $flag = $usuario->iniciarSesion();
            if ($flag){
                echo '<div class="divInit">Bienvenido
                <p>Numero de visita '.$usuario->getVisitas().'</p>
                <p>Ultima visita '.$usuario->getUltimaVisita().'</p>
                <a href="index.php">volver</a>
                <a href="procesaLista.php">Ingresar a la lista de tareas</a>
                </div>
                ';
                //esto lo hago por fuera de la clase.  Por que?
                //porque si no siempre voy a 
            }
            else{
                echo '<div class="divInit">Este usuario no existe, debe crearlo.
                <a href="index.php">volver</a></div>';
            }
        }
    }
    else{
        echo '<div class="divInit">
        No puede contener caracteres especiales, ni estar vacio.
        </div>';
    }
}

else{
?>

        <div class="divInit" >
            <div>
                <h2>Bienvenido</h2>
            </div>
            <div>
                <form action="index.php" method="post" class="formu">
                         <p>Ingrese su nombre</p>
                        <input type="text" name="nombre" class="inp">
                    <div>
                        <!-- Tengo dos botones, para saber si el usuario inicia o crea usuario -->
                        <button type="submit" name="inicio" class="btn">Iniciar sesion.</button>
                        <button type="submit" name="crear" class="btn">Crear usuario</button>
                    </div>
                </form>
            </div>
        </div>
    <footer>
        <p>P&aacute;gina creada por: Facundo Vidal.</p>
    </footer>
    <?php 
    }
    ?>
</body>
</html>