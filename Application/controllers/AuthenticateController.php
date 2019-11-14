<?php
  class AuthenticateController extends Controller{

    function userAuthenicate($f3, $params){
       header('Content-type:application/json');

       try{

        $data = json_decode($f3->get('BODY'), true);
        $user = new User($this->db);

        $result = $user->getById($data['userId'])[0];

        if($result['disabled'] == 1 || $result['userGroup'] == 1 || $result == null){
            echo json_encode(array(
                'success' => false,
                'message' => 'Incorrect details entered'
            ));
            return;
        }
        if(md5($data['password']) == $result['password']){
            $userToken = new UserToken($this->db);

            $data['password'] = '';
            $data['expiryDate'] = date('Y-m-d H:i:s', strtotime('+5 hour', strtotime(date('Y-m-d H:i:s'))));
            $data['created'] = date('Y-m-d H:i:s');
            $data['disabled'] = 0;

            $token['token'] = $userToken->generateToken($data);

            echo json_encode(array(
                'success' => true,
                'message' => $token
            ));
            return;
        }
        else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Incorrect username or password'
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

    function getToken($f3, $params){
      try{

        $data = json_decode($f3->get('BODY'), true);
        $user = new User($this->db);

        $result = $user->getToken($data['userId'])[0];
       if($result == null){
        echo json_encode(array(
          'success' => false,
          'message' => 'Please login again'
      ));
      return;
       }

       echo json_encode(array(
        'success' => true,
        'message' => $result
    ));
    return;

       }catch(Exception $e){
         echo json_encode(array(
           'success' => false,
           'message' => $e->getMessage()
         ));
       }
    }
  }
?>