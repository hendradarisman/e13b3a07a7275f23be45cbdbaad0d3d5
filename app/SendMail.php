<?php
require_once __DIR__.'/RestApi.php';
require_once __DIR__.'/../src/server.php';

header('Content-Type: application/json; charset=UTF-8');

// Handle a request to a resource and authenticate the access token
if (!$server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
    echo json_encode(array('success' => false, 'code' => '401','message' => 'Unauthorize'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'message' => 'Method not allowed!'));
    exit;
}


try {
        if(isset($_POST['mail_to']) && isset($_POST['mail_from']) && isset($_POST['subject']) && isset($_POST['body'])){
            $data = [ 
                'to'      => $_POST['mail_to'],
                'from'    => $_POST['mail_from'],
                'subject' => $_POST['subject'],
                'body'    => $_POST['body']
                ];
          
            $result = $api->addQueue($data);
        
            if($result){
                echo json_encode(array('success' => true, 'message' => 'Send Email Success'));
            }else{
                echo json_encode(array('success' => false, 'message' => 'Oops Something went wrong'));
            }
        }else{
            echo json_encode(array('success' => false, 'message' => 'Oops Something went wrong'));
        }
} catch (Exception $e) {
         echo json_encode(array('success' => false, 'message' => json_encode($e->getMessage())));
}

?>