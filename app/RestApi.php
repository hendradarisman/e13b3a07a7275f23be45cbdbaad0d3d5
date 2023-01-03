<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


    class Api{
        
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findBySql($query){
            $this->db->query($query);
            $set = $this->db->resultSet();
            return $set;
        }

        public function getAllQueueSentNull(){
            $query = "SELECT * FROM queue where sent IS NULL";
            return $this->findBySql($query);
        }

        public function addQueue($to, $from, $subject, $body){
            $this->db->query('INSERT into queue(mail_to, mail_from, subject, body, created) VALUES (:to,:from,:subject,:body, now())');
            $this->db->bind(':to',$to);
            $this->db->bind(':from',$from);
            $this->db->bind(':subject',$subject);
            $this->db->bind(':body',$body);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function updateQueue($id){
            $queue = $this->getQueueById($id);
            if($queue){

                foreach($queue as $value){

                    $mail_to = $value->mail_to;
                    $mail_from = $value->mail_from;
                    $subject = $value->subject;
                    $body   = $value->body;
                }
                    $mail = new PHPMailer; 
                    $mail->IsSMTP();
                    $mail->SMTPSecure = 'none'; 
                    $mail->Host = $_ENV['MAIL_HOST'];
                    $mail->SMTPDebug = 2;
                    $mail->Port =  $_ENV['MAIL_PORT'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV['MAIL_USERNAME']; 
                    $mail->Password =  $_ENV['MAIL_PASSWORD']; ; 
                    $mail->SetFrom( $_ENV['MAIL_FROM_ADDRESS'],$mail_from); 
                    $mail->Subject = $subject; 
                    $mail->AddAddress($mail_to, $mail_to);  
                    $mail->MsgHTML($body);

                    if($mail->Send()){
                        $this->db->query('UPDATE queue SET sent = now() WHERE id = :id');
                        $this->db->bind(':id',$id);
                        if($this->db->execute()){
                            return true;
                        }
                    }
            }
            return false;
        }
    }
?>