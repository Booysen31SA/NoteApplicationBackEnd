<?php

   class Notes extends DB\SQL\Mapper{
       public function __construct(DB\SQL $db)
       {
           parent::__construct($db, 'notes');
       }

       public function getAll($disabled){
           try{

            $query = "SELECT * FROM notes WHERE disabled = $disabled";

            $result = $this->db->exec($query);

            return $result;

            }catch(Exception $e){
               throw new Exception($e);
            }
       }

       public function create($data){
           
           try{
              $this->load(array('titleID = ?', $data['titleID']));

              $this->copyFrom($data);

              $this->save();

           }catch(Exception $e){
               throw new Exception($e);
           }
       }

       public function readById($id){
          try{
 
            $query = "SELECT * FROM notes WHERE titleID = '$id' AND disabled = 0";

            $result = $this->db->exec($query);

            return $result;
          }catch(Exception $e){
 
            throw new Exception($e);
          }
       }

       public function getIdOnly($id){
        try{

          $query = "SELECT titleID FROM notes WHERE titleID = '$id' AND disabled = 0";

          $result = $this->db->exec($query);

          return $result;
        }catch(Exception $e){

          throw new Exception($e);
        }
     }

     public function delete($data){
      try{

          $this->load(array('titleID = ?', $data['titleID']));

           $this->copyFrom($data);
   
           $this->save();
      }catch(Exception $e){

       throw new Exception($e);

      }
   }
   }
?>