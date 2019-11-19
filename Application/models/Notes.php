<?php

   class Notes extends DB\SQL\Mapper{
       public function __construct(DB\SQL $db)
       {
           parent::__construct($db, 'notes');
       }

       public function getAll($disabled, $userId){
           try{

            $query = "SELECT * FROM notes WHERE disabled = '$disabled' AND userId = '$userId'";

            $result = $this->db->exec($query);

            return $result;

            }catch(Exception $e){
               throw new Exception($e);
            }
       }

       public function create($data){
           
           try{
              $this->load(array('Title = ?', $data['Title']));

              $this->copyFrom($data);

              $this->save();

           }catch(Exception $e){
               throw new Exception($e);
           }
       }

       public function readById($id){
          try{
 
            $query = "SELECT * FROM notes WHERE Title = '$id' AND disabled = 0";

            $result = $this->db->exec($query);

            return $result;
          }catch(Exception $e){
 
            throw new Exception($e);
          }
       }

       public function getIdOnly($id){
        try{

          $query = "SELECT Title FROM notes WHERE Title = '$id' AND disabled = 0";

          $result = $this->db->exec($query);

          return $result;
        }catch(Exception $e){

          throw new Exception($e);
        }
     }

     public function delete($data){
      try{

          $this->load(array('Title = ?', $data['Title']));

           $this->copyFrom($data);
   
           $this->save();
      }catch(Exception $e){

       throw new Exception($e);

      }
   }

   public function getLatestCreated($userId){
      try{

         $query = "SELECT * FROM notes 
                   Where userId = '$userId'
                   AND disabled = 0
                   ORDER BY dateCreated DESC
                   LIMIT 5";

         $result = $this->db->exec($query);

         return $result;
       }catch(Exception $e){

         throw new Exception($e);
       }
   }
   }
?>