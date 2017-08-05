<?php
    class Lead {
        private $lead;
        private $custom;

        public function __construct(){
            $this->lead = array();
            $this->lead['custom_fields'] = array();
            $this->custom = &$this->lead['custom_fields'];
        }

        public function setName($name){
            $this->lead['name'] = $name;
            return $this;
        }

        public function setStatusId($statusId){
            $this->lead['status_id'] = $statusId;
            return $this;
        }

        public function setTags($tags){
            if(is_array($tags)) $tags = implode(",", $tags);
            $this->lead['tags'] = $tags;
            return $this;
        }

        public function addTags($addTags){
            $tags = $this->lead['tags'];
            if(!$tags) {
                $this->lead['tags'] = (!is_array($addTags)) ?
                                $addTags : implode(',', $addTags);
            } else {
                $tags = explode(",", $tags);
                if(is_array($addTags)) $addTags = explode(',', $addTags);
                $this->lead['tags'] = implode(',', array_merge($tags, $addTags));
            }

            return $this;
        }

        public function setResponsibleUser($userId){
            $this->lead['responsible_user_id'] = $userId;
            return $this;
        }

        public function setPrice($price){
            $this->lead['price'] = $price;
            return $this;
        }

        public function setCustomFields($fields){
            if(!is_array($fields)) return $this;
            foreach ($fields as $key => $field) {
                $this->custom[]=$field;
            }

            return $this;
        }

        public function setCustomField($id, $value, $enum = null){
            $field = array('id' => $id);
            $field['values'] = is_array($value) ? $value :
                    array('value' => $value, 'enum' => $enum);
            $this->custom[] = $field;
            return $this;
        }

        public getLeadArray(){
            return $this->lead;
        }
    }
?>
