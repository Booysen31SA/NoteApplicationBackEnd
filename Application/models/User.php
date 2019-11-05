<?php
class User extends DB\SQL\Mapper{
    
    public function __construct(DB\SQL $db) {
        parent::__construct($db, 'user');
    }

    public function create($data){
       
        try{
            $this->load(array('userId = ?', $data['userId']));

            $this->copyFrom($data);
            $this->save();
        }catch(Exception $e){
            throw new Exception($e);
        }
    }

    public function getById($userId){
        try{

            $query = "SELECT * FROM user WHERE userId = '$userId' AND disabled = 0";
            $result = $this->db->exec($query);
            return $result;
        }catch(Exception $e){
          throw new Exception($e);
        }
    }
}
?>