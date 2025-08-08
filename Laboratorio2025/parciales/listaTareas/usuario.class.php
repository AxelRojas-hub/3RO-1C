<?php class usuario{
    private $nombre;
    private $visitas;
    private $ultimaVisita;
    private $tareasPendientes;
    private $tareasFinalizadas;

    public function __construct(string $nombre){
        $this->nombre = $nombre;
        $this->visitas = 1;
        $this->tareasPendientes = [];
        $this->tareasFinalizadas = [];
    }



    public function crearUsuario(){
        $nombre = $this->getNombre();
        if(!(isset($_COOKIE[$nombre]))){
           $fecha = date('d/m/Y') ;
           $this->setUltimaVisita($fecha);
            $expira = time() + 2* 24 * 60 * 60;
            //vuelvo a asignarle 1, solo por las dudas. Ignorar esta linea
            $this->setVisitas(1);
            $this->tareasPendientes = [];
            $this->tareasFinalizadas = [];
            $datos = [
            "visitas" => 1,
            "ultimaVisita" => $fecha,
            "tareasPendientes" => [],
            "tareasFinalizadas" => []
            ];
            setcookie($nombre, json_encode($datos), $expira);
            $this->guardarEnSesion();
        return true;
        }
        else{
            return false;
        }
    }
    public function iniciarSesion(){
        $nombre = $this->getNombre();
    if (!isset($_COOKIE[$nombre])) {
        return false;
    }
        $datos = json_decode($_COOKIE[$nombre], true);
        $datos['visitas'] = ((int)$datos['visitas']) + 1;
        $fechaAnterior    = $datos['ultimaVisita'] ?? '';
        $fechaHoy         = date('d/m/Y');
        $datos['ultimaVisita'] = $fechaHoy;
        $expira = time() + 2*24*60*60;
        $this->tareasPendientes  = $datos['tareasPendientes'];
        $this->tareasFinalizadas = $datos['tareasFinalizadas'];

        setcookie($nombre, json_encode($datos), $expira);
        $this->setVisitas($datos['visitas']);
        $this->setUltimaVisita($fechaAnterior);
        $this->guardarEnSesion();
        return true;
    }
    
    public function borrarSesion() {
        session_destroy();
    }
    
    public function getVisitas(){
        return $this->visitas;
    }
    public function setVisitas(int $numVisitas){
        $this->visitas = $numVisitas;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }
    public function getUltimaVisita(){
        $ultimaVisita = $this->ultimaVisita;
        $this->ultimaVisita = date('d/m/Y');
        return $ultimaVisita;
        
    }
    public function setUltimaVisita(string $ultimaVisita){
        $this->ultimaVisita = $ultimaVisita;
    }
    public function guardarEnSesion() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['usuario'] = $this;
    }
    public function getTareasPendientes(): array{
        if($this->tareasPendientes == null)
        {
            return  [];
        }
        else{
        return $this->tareasPendientes;
        }
    }
    public function setTareasPendientes(array $tareasPendientes){
        $this->tareasPendientes = $tareasPendientes;
    }
    
    public function getTareasFinalizadas(): array{
        if($this->tareasFinalizadas == null)
        {
            return  [];
        }
        else{
        return $this->tareasFinalizadas;
        }
    }
    public function setTareasFinalizadas(array $tareasFinalizadas){
        $this->tareasFinalizadas = $tareasFinalizadas;
    }
    public function actualizarListaCookie (){
        $datos = json_decode($_COOKIE[$this->nombre], true);
        $datos['tareasPendientes'] = $this->getTareasPendientes();
        $datos['tareasFinalizadas'] = $this->getTareasFinalizadas();
        $expira = time() + 2*24*60*60;
        setcookie($this->nombre, json_encode($datos), $expira);
    }

}
?>