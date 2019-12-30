<?php

   class AccessRight extends DB\SQL\Mapper{
       public function __construct(DB\SQL $db)
       {
           parent::__construct($db, 'shareaccessrights');
       }

       public function getAccessRights($access){
           try{

            $query = "SELECT * FROM shareaccessrights WHERE AccessRights LIKE '$access'";

            $result = $this->db->exec($query);

            return $result;

            }catch(Exception $e){
               throw new Exception($e);
            }
       }

       //remove users
       //delete shared note
       //get All
       //get specifric one note
    }
?>