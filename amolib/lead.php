<?php
    require_once 'iHasGetArray.php';
    
    class Lead implements IHasGetArray {
        private $lead;

        public function __construct(array $arr = array()){
            $this->lead = $arr;
        }

        public function setId($id){
            $this->lead['id'] = $id;
            return $this;
        }

        public function getId(){
            return $this->lead['id'];
        }

        public function setName($name){
            $this->lead['name'] = $name;
            return $this;
        }

        public function getName(){
            return $this->lead['name'];
        }

        public function setCreatedAt($time){
            $this->lead['created_at'] = $time;
            return $this;
        }

        public function getCreatedAt(){
            return $this->lead['created_at'];
        }

        public function setUpdatedAt($time){
            $this->lead['updated_at'] = $time;
            return $this;
        }

        public function getUpdatedAt(){
            return $this->lead['updated_at'];
        }

        public function setStatusId($statusId){
            $this->lead['status_id'] = $statusId;
            return $this;
        }

        public function getStatusId(){
            return $this->lead['status_id'];
        }

        public function setPipelineId(){
            $this->lead['pipeline_id'] = $statusId;
            return $this;
        }

        public function setResponsibleUser($userId){
            $this->lead['responsible_user_id'] = $userId;
            return $this;
        }

        public function getResponsibleUser(){
            return $this->lead['responsible_user_id'];
        }

        public function setSale($price){
            $this->lead['sale'] = $price;
            return $this;
        }

        public function getSale(){
            return $this->lead['sale'];
        }

        public function setTags($tags){
            if(is_array($tags)) $tags = implode(",", $tags);
            $this->lead['tags'] = $tags;
            return $this;
        }

        public function getTags(){
            return $this->lead['tags'];
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

        public function setContactsId($contacts){
            if(!is_array($contacts)) return $this;
            $this->lead['contacts_id'] = $contacts;
            return $this;
        }

        public function addContactId($id){
            $contacts = null; 
            if(array_key_exists('contacts_id', $this->lead)) $contacts = $this->lead['contacts_id'];
            if(is_null($contacts)) $contacts = array();
            
            $contacts[] = $id;
            $this->lead['contacts_id'] = $contacts;
            return $this;
        }

        public function setCompanyId($companyId){
            $this->lead['company_id'] = $companyId;
            return $this;
        }

        public function setCustomFields($fields){
            if(!is_array($fields)) return $this;
            $this->lead['custom_fields'] = $fields;
            return $this;
        }

        public function getCustomFields(){
            return $this->lead['custom_fields'];
        }

        public function addCustomField($id, $value, $enum = null){
            $field = array('id' => $id);
            if(is_array($value)) $field['values'][] = $value;
            else {
                $value = array('value' => $value);
                if($enum) $value['enum'] = $enum;
            }
            $field['values'][] = $value;

            $custom = array_key_exists('custom_fields', $this->lead) ? 
                $this->lead['custom_fields'] : array();

            $custom[] = $field;
            $this->lead['custom_fields'] = $custom;

            return $this;
        }

        public function getCustomField($id){
            if(!array_key_exists('custom_fields', $this->lead)) return null; 
            
            $fields = $this->lead['custom_fields'];
            if(!$fields || !count($fields)) return null;
            
            $result = null;
            foreach($fields as $fld){
                if($fld['id'] == $id) {
                    $result = $fld;
                    break; 
                }
            }
            return $result;
        }

        public function getCreatedBy(){
            return $this->lead['created_by'];
        }

        public function setAccountId(){
            return $this->lead['account_id'];
        }

        public function getIsDeleted(){
            return $this->lead['is_deleted'];
        }

        public function getMainContact(){
            return $this->lead['main_contact'];
        }

        public function getGroupId(){
            return $this->lead['group_id'];
        }
        
        public function getCompany(){
            return $this->lead['company'];
        }

        public function getClosestTaskAt(){
            return $this->lead['closest_task_at'];
        }

        public function getContacts(){
            return $this->lead['contacts'];
        }

        public function getPipeline(){
            return $this->lead['pipeline'];
        }

        public function getArray(){
            return $this->lead;
        }
    }
?>
