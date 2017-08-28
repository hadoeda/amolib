<?php
    class Lead {
        private $lead;

        public function __construct(){
            $this->lead = array();
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
            $this->lead['custom_fields'] = $fields;
            return $this;
        }

        public function addCustomField($id, $value, $enum = null){
            $field = array('id' => $id);
            if(is_array($value)) $field['values'][] = $value;
            else {
                $value = array('value' => $value);
                if($enum) $value['enum'] = $enum;
            }
            $field['values'][] = $value;

            $custom = $this->lead['custom_fields'];
            if(!$custom) $custom = array();

            $custom[] = $field;
            $this->lead['custom_fields'] = $custom;

            return $this;
        }

        public function getArray(){
            return $this->lead;
        }
    }
?>
