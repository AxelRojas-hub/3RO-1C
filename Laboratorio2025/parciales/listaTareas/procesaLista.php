<?php

    require_once('usuario.class.php');
    session_start();
    echo'        <link rel="stylesheet" href="estilo.css">
';
if(isset($_GET['btnCerrar'])){
    $usuario =  $_SESSION['usuario'];
    $usuario->borrarSesion();
    echo '<div class="divInit">';
    echo 'Sesion finalizada.';
    echo '<a href="index.php">volver</a>';
    echo '</div>';
} else {

    if(isset($_GET['btnFinalizar'])){
        $datos =  $_SESSION['usuario'];
        $datos->setTareasPendientes([]);
        $datos->setTareasFinalizadas([]);
        $_SESSION['usuario']=$datos;
        
    }
    else if(isset($_GET['btnGuardar'])){
        $usuario =  $_SESSION['usuario'];
        $usuario->actualizarListaCookie();
        header('Location: procesaLista.php');
  exit;
    }
    if(isset($_GET['fin'])){
        if(isset($_GET['check'])){
            $checks = $_GET['check'] ?? [];
            if (!is_array($checks)) {
            $checks = [$checks];
            }
            $datos =  $_SESSION['usuario'];
            $pendientes = $datos->getTareasPendientes();
            $longChecks=count($checks);
            $finalizadas = $datos->getTareasFinalizadas();
            for ($i=0;  $i<$longChecks;$i++){
                array_push($finalizadas,$pendientes[$checks[$i]]);
                unset($pendientes[$checks[$i]]);
            }
            $pendientes = array_values($pendientes);
            $datos->setTareasPendientes($pendientes);
            $datos->setTareasFinalizadas($finalizadas);
            $_SESSION['usuario']=$datos;
            
        }
        //Siempre que preceso, redirecciono la pagina, van a quedar los parametros
        //guardados en get
        header('Location: procesaLista.php');
    exit;  
    }
    if(isset($_GET['inputTarea'])&& ($_GET['inputTarea'] !="")){
        $datos =  $_SESSION['usuario'];
        $tarea=htmlspecialchars($_GET['inputTarea']);
        $arreglo = $datos->getTareasPendientes();
        array_push($arreglo,$tarea);
        $datos->setTareasPendientes($arreglo);
        $_SESSION['usuario']=$datos;
                //Siempre que preceso, redirecciono la pagina, van a quedar los parametros
        //guardados en get
        header('Location: procesaLista.php');
    exit;
    }
    ?>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="procesaLista.php" method="get">
            <h2>Ingrese una tarea</h2>
            <input type="text" name="inputTarea" class="inp">
            <button class="btn" type="submit">Ingresar tarea</button>
        </form>
        <form action="procesaLista.php" method="get">
            <button class="btn" type="submit" name="btnFinalizar">Limpiar tareas</button>
            <button class="btn" type="submit" name="btnGuardar">Guardar cambios</button>
            <button class="btn" type="submit" name="btnCerrar">Cerrar sesion</button>
        </form>   
        <?php


        $datos =  $_SESSION['usuario'];
        echo '<div class="conjuntoTareas">';
        echo "<div class='divTareas'><div>
        Tareas pendietes
        </div>";
        echo  '<form method="get" action="procesaLista.php">';
        echo '<button type="submit" name="fin">Finalizar Tareas</button>';

        if(count($datos->getTareasPendientes())>0){
            $contTareas = 0;
            foreach($datos->getTareasPendientes() as $tarea){
                echo '<div>';
                echo "<input type='checkbox' name='check[]' value=".$contTareas.">";
                echo $tarea;
                
                echo '</div>';
                $contTareas +=1;
            }
        }
        echo "</div>";
        echo'<form>';
        echo "<div class='divTareas'><div>
        Tareas finalizadas
        </div>";
        if(count($datos->getTareasFinalizadas())>0){
            foreach($datos->getTareasFinalizadas() as $tarea){
                echo '<div>';
                echo $tarea;
                echo '</div>';
                
            }
        }
        echo "</div>";
        echo'</div>';
        ?>
    </body>
    </html>
    <?php
}
    ?>