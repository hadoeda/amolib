<?php
    require_once 'iHasGetArray.php';

    class Note implements IHasGetArray{
        private $note;
        
        public function __construct(){
            $this->note = array();
        }

        public function setElementId($id){
            $this->note['element_id'] = $id;
            return $this;
        }

        public function setElementType($type){
            $this->note['element_type'] = $type;
            return $this;
        }
        
        public function setText($text){
            $this->note['text'] = $text;
            return $this;
        }

        public function setNoteType($type){
            $this->note['note_type'] = $type;
            return $this;
        }

        public function setCreatedAt($time){
            $this->note['created_at'] = $time;
            return $this;
        }

        public function setUpdatedAt($time){
            $this->note['updated_at'] = $time;
            return $this;
        }

        public function setParams(array $params){
            $this->note['params'] = $params;
            return $this;
        }

        public function setId($id){
            $this->note['id'] = $id;
            return $this;
        }

        public function setResponsibleUser($userId){
            $this->note['responsible_user_id'] = $userId;
            return $this;
        } 

        public function getArray(){
            return $this->note;
        }
    }
?>