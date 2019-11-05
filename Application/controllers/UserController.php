  
<?php
class UserController extends Controller {
    function beforeroute() {
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
    }
    
    function getUser($f3, $params) {
        
        header('Content-type:application/json');
        try {
            $userId = $params['userId'];
            if(empty($userId)) {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                return;
            }
            $user = new User($this->db);
            $result = $user->getById($userId);
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
