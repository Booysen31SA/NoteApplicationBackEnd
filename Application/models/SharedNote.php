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
    }
?>