<?php
   class ShareController extends Controller{

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

    function create($f3, $params){
        header('Content-type:application/json');

        try{

            $data = json_decode($f3->get('BODY'), true);
            $id = $params['shared_Note_ID'];

            if(empty($data['userId'])){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                return;
            }
            if(empty($data['ID'])){
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                return;
            }
            $note = new Notes($this->db);
            $user = new User($this->db);
            $share = new SharedNote($this->db);
            $rights = new AccessRight($this->db);

            if(empty($id)){//create
                $noteResult = $note->getId($data['ID']);
                $userResult = $user->getById($data['userId']);
                $rightsResults = $rights->getAccessRights($data['accessRight']);

                if(empty($noteResult)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Note does not exist'
                    ));
        
                    return; 
                }

                if(empty($userResult)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Note does not exist'
                    ));
        
                    return; 
                }
                if(empty($rightsResults)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Access type does not exist'
                    ));
        
                    return; 
                }

                $data['userId'] = $userResult[0]['userId'];
                $data['ID'] = $noteResult[0]['ID'];
                $data['created'] =  date('Y-m-d H:i:s');
                $data['disabled'] = 0;
                $data['admin'] = $userResult[0]['userId'];
                $data['accessRight'] = $rightsResults[0]['ID'];

                $share->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'note successfully created'
                ));
    
                return;

            }else{
                //update
                $noteResult = $note->getId($data['ID']);
                $userResult = $user->getById($data['userId']);
                $rightsResults = $rights->getAccessRights($data['accessRight']);

                if(empty($noteResult)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Note does not exist'
                    ));
        
                    return; 
                }

                if(empty($userResult)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Note does not exist'
                    ));
        
                    return; 
                }

                if(empty($rightsResults)){
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Access type does not exist'
                    ));
        
                    return; 
                }

                $data['modified'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
                $data['accessRight'] = $rightsResults[0]['ID'];

                $share->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'note successfully updated'
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
   }
?>