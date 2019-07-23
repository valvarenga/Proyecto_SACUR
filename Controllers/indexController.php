<?php
class indexController extends Controller
{

    private $_login;
 public function __construct()
 {
 parent::__construct();
 $this->_login=$this->loadModel('inicio');
 }

public function index()
    {
         $this->_view->titulo = 'SACUR';
         $this->_view->setJs(array('validar'));
        $this->_view->setJs(array("validarLogin"));
        $this->_view->render('index');

        if(Session::get('autenticado'))
        {
        $this->_view->usuario=Session::get('usuario');
        $this->_view->renderizar('usuario');
        }
        
// registrar estudiante
        if($this->getInt('enviarRegisEst')==1){
            $this->_view->datos=$_POST;
              $this->_login->insertarestudiante(
                   
                    $this->getsql('carnetReg'),
                    $this->getsql('Name'),
                    $this->getsql('apellido'), 
                    $this->getsql('genero'),
                    $this->getsql('number'),
                    $this->getsql('departamento'),
                    $this->getsql('ciud'),
                    $this->getPostParam('EMAIL'),
                    $this->getsql('carrera'),
                    $this->getsql('pass2'),
                    $this->getsql('fnac') 
                    );
              } //fin del if enviarRegisEst
      
    
                // Registro Profesor
     if($this->getInt('env_regist_prof')==1){
        $this->_view->datos=$_POST;
         

        $this->_login->insertarProfesor(
               
                $this->getsql('nameProf'),
                $this->getsql('apellidoProf'),
                $this->getsql('user'), 
                $this->getsql('pass2'),
                $this->getsql('genero'),
                $this->getPostParam('EMAIL'),
                $this->getsql('carrera')
               
                );
              } 
           
            
             
  
    } 
      //fin de la funcion index
           //login estudiante
    
public function cerrar()
     {
         Session::destroy();
        $this->render('index');
     }
  
public function verificarCarnet()
     {
         if($this->_login->verificarCarnet($this->getsql('carnetReg')))
             echo "El carnet ya existe";
         else
             echo '0';
     }

     
     
public function verificarEmail()
     {
         if($this->_login->verificarEmail($this->getsql('EMAIL')))
             echo "El Correo ya existe";
         else
             echo '0'; 
            
     }
public function verificaruser()
     {
         if($this->_login-> verificaruser($this->getsql('user')))
             echo "El usuario ya existe";
         else
             echo '0';
     }
     
public function verificarEmailp()
     {
         if($this->_login->verificarEmailp($this->getPostParam('EMAIL')))
             echo "El Correo ya existe";
         else
             echo '0';
     }
  
     //verificar si el estudiante esta activo
    public function verificarEstado()
    {
        if($this->_login->EstadoEst($this->getsql('carnet'),$this->getsql('password')))
               echo 'Este usuario no esta habilitado';
               else
               echo '0';
        
    }
     
    
 //funcion login de estudiante
 public function logEst(){
     if  ($this->_login->getEstudiante(
        $this->getsql('carnet'),
        $this->getSql('password')))   
         {
            echo '0';
         }
       else
        echo 'Carnet y/o Contraseña Incorrecta';
    }

    //funcion login de Profesor
 public function loginProf(){
    if  ($this->_login->getprof(
       $this->getsql('users'),
       $this->getSql('password')))   
        {
           echo '0';
        }
      else
       echo 'Usuario y/o Contraseña Incorrecta';
    }
  

}

//fin de la clase indexController
?>
 