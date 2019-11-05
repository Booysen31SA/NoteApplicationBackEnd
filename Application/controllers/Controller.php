<?php

  class Controller{
      protected $f3;
      protected $database;

      function beforeroute(){

      }
      function afterroute(){

      }
      function __construct(){
          try{

            $f3 = Base::instance();
            $this->f3 = $f3;

            $database = new DB\SQL(
                $f3->get('mysql.db'),
                $f3->get('mysql.username'),
                $f3->get('mysql.password'),
                array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
            );
            $this-> database = $database;
            

          }catch(Exception $e){
             header('Content-type:application/json');

             echo json_encode(array(
                 'success' => false,
                 'message' => $e->getMessage()
             ));

             exit;
          }
      }
  }
?>