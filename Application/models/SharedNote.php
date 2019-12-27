<?php

   class SharedNote extends DB\SQL\Mapper{
       public function __construct(DB\SQL $db)
       {
           parent::__construct($db, 'shared_notes');
       }

       public function create($data){
           
        try{
           $this->load(array('ID = ?', $data['ID']));

           $this->copyFrom($data);

           $this->save();

        }catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function getAll($disabled, $userId){
        try{

            $query = "SELECT * FROM shared_notes WHERE disabled = '$disabled' AND userId = '$userId' ORDER BY created DESC";

            $result = $this->db->exec($query);

            return $result;

            }catch(Exception $e){
               throw new Exception($e);
            }
    }
    }
?>