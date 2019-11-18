<?php
   class NotesController extends Controller{

    /*function beforeroute() {
        //Check to make sure token passed is valid
        try {
            $userToken = new UserToken($this->db);
            $token = $this->f3->get('HEADERS.Token');
    
            $result = $userToken->verifyToken($token);
    
            if(empty($result) || $result['expiryDate'] < date('Y-m-d H:i:s')) {
                $this->f3->error(403);
            }
        }
        catch(Exception $e) {
            header('Content-type:application/json');
            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));
            
            exit;
        }
    }*/

    function getNotes($f3, $params){
 
        header('Content-type:application/json');

        try{

            $disabled = $params['disabled'];

            if($disabled < 0){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;
            }

            
        }catch(Exception $e){
            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));
        }
    }

    function create($f3, $params){
        
        header('Content-type:application/json');

        try{

            $data = json_decode($f3->get('BODY'), true);
            $id = $params['Title'];

            if(empty($data['Title'])){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                return;
            }
            if(empty($data['message'])){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Are you sure you want a empty Note?'
                ));
                return;
            }
            if(empty($data['Title'])){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                return;
            }

            $notes = new Notes($this->db);

            if(!empty($id)){

                $result = $notes->readById($id);

                if(empty($result)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Note does not exist'
                    ));
        
                    return; 
                }

                $data['Title'] = $data['Title'];
                $data['message'] = $data['message'];
                $data['dateModified'] = date('Y-m-d H:i:s');
        
                $notes->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'note successfully updated'
                ));
    
                return;
            }else{
                $result = $notes->readById($id);
    
                if(!empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Note already exist'
                    ));
        
                    return;
        
                }
    
                $data['dateCreated'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
    
                $notes->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Note successfully created'
                ));
            }

        }catch(Exception $e){
            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));
        }
    }
    function readbyID($f3, $params){

        header('Content-type:application/json');

        try{

            $id = $params['Title'];

            if(empty($id)) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;
            }

            $notes = new Notes($this->db);
            $result = $notes->readById($id);

            if(empty($result) || $result['disabled'] > 0) {
                
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Note does not exist'
                ));
    
                return;
            }
            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));

        }catch(Exception $e){
            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

        }
    }

    function delete($f3, $params){

        header('Content-type:application/json');

        try{

            $Title = $params['Title'];

            if(empty('Title')){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                
                return;
            }

            $notes = new Notes($this->db);

            $result = $notes->readById($Title);

            if(empty($result)){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Note does not exist'
                ));

                return;
            }

            $data['dateModified'] = date('Y-m-d H:i:s');
            $data['Title'] = $Title;
            $data['disabled'] = 1;

            $notes->delete($data);

            echo json_encode(array(
                'success' => true,
                'message' => 'Note successfully deactivated'
            ));
        }catch(Exception $e){

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));
        }
    }
    function getAll($f3, $params) {

        header('Content-type:application/json');

        try {

            $disabled = $params['disabled'];
            $userId = $params['userId'];

            if($disabled < 0) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            $notes = new Notes($this->db);

            $result = $notes->getAll($disabled, $userId);

            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

        }

    }
   }
?>