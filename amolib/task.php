<?php
    require_once 'iHasGetArray.php';

    class Task implements IHasGetArray {
        private $task;

        public function __construct($arr = array()){
            $this->task = $arr;        
        }

        public function setId($id){
            $this->task['id'] = $id;
            return $this;
        }

        public function getId(){
            return $this->task['id'];
        }

        public function setElementId($id){
            $this->task['element_id'] = $id;
            return $this;
        }

        public function getElementId($id){
            return $this->task['element_id'];
        }

        public function setElementType($type){
            $this->task['element_type'] = $type;
            return $this;
        }

        public function getElementType(){
            return $this->task['element_type'];
        }

        public function setDateCreate($date){
            $this->task['date_create'] = $date;
            return $this;
        }

        public function getDateCreate(){
            return $this->task['date_create'];
        }

        public function setLastModified($date){ 
            $this->task['last_modified'] = $date;
            return $this;
        }

        public function getLastModified(){
            return $this->task['last_modified'];
        }

        public function setStatus($status){
            $this->task['status'] = $status;
            return $this;
        }

        public function getStatus(){
            return $this->task['status'];
        }

        public function setRequestId($id){
            $this->task['request_id'] = $id;
            return $this;
        }

        public function getRequestId(){
            return $this->task['request_id'];
        }

        public function setTaskType($type){
            $this->task['task_type'] = $type;
            return $this;
        }

        public function getTaskType(){
            return $this->task['task_type'];
        }

        public function setText($text){
            $this->task['text'] = $text;
            return $this;
        }

        public function getText(){
            return $this->task['text'];
        }

        public function setRespUserId($id){
            $this->task['responsible_user_id'] = $id;
            return $this;
        }

        public function getRespUserId(){
            return $this->task['responsible_user_id'];
        }

        public function setCreatedUserId($id){
            $this->task['created_user_id'] = $id;
            return $this;
        }

        public function getCreatedUserId(){
            return $this->task['created_user_id'];
        }

        public function setCompleteTill($date){
            $this->task['complete_till'] = $date;
            return $this;
        }

        public function getCompleteTill(){
            return $this->task['complete_till'];
        }

        public function getArray(){
            return $this->task;
        }
    }
?>