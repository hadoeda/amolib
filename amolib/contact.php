<?php
    require_once 'iHasGetArray.php';

    class Contact implements IHasGetArray {
        private $contact;

        public function __construct(array $arr = array()){
            $this->contact = $arr;
        }

        public function setName($name){
            $this->contact['name'] = $name;
            return $this;
        }

        public function setCreatedAt($createdAt){
            $this->contact['created_at'] = $createdAt;
            return $this;
        }

        public function setUpdatedAt($updatedAt){
            $this->contact['updated_at'] = $updatedAt;
            return $this;
        }

        public function setResponsibleUserId($respId){
            $this->contact['responsible_user_id'] = $respId;
            return $this;
        }

        public function setCreatedBy($createdBy){
            $this->contact['created_by'] = $createdBy;
            return $this;
        }

        public function setCompanyName($companyName){
            $this->contact['company_name'] = $companyName;
            return $this;
        }

        public function setTags($tags){
            if(is_array($tags)) $tags = implode(",", $tags);
            $this->contact['tags'] = $tags;
            return $this;
        }

        public function addTags($addTags){
            $tags = $this->contact['tags'];
            if(!$tags) {
                $this->contact['tags'] = (!is_array($addTags)) ?
                                $addTags : implode(',', $addTags);
            } else {
                $tags = explode(",", $tags);
                if(is_array($addTags)) $addTags = explode(',', $addTags);
                $this->contact['tags'] = implode(',', array_merge($tags, $addTags));
            }

            return $this;
        }

        public function setLeadsId($leadsId){
            if(is_array($leadsId)) $leadsId = implode(",", $leadsId);
            $this->contact['leads_id'] = $leadsId;
            return $this;
        }

        public function addLeadsId($addLeadsId){
            $leadsId = $this->contact['leads_id'];
            if(!$leadsId) {
                $this->contact['leads_id'] = (!is_array($addLeadsId)) ?
                                $addLeadsId : implode(',', $addLeadsId);
            } else {
                $leadsId = explode(",", $leadsId);
                if(is_array($addLeadsId)) $addLeadsId = explode(',', $addLeadsId);
                $this->contact['leads_id'] = implode(',', array_merge($leadsId, $addLeadsId));
            }

            return $this;
        }

        public function setCompanyId($companyId){
            if(is_array($companyId)) $companyId = implode(",", $companyId);
            $this->contact['company_id'] = $companyId;
            return $this;
        }

        public function addCompanyId($addCompanyId){
            $companyId = $this->contact['company_id'];
            if(!$companyId) {
                $this->contact['company_id'] = (!is_array($addCompanyId)) ?
                                    $addCompanyId : implode(',', $addCompanyId);
            } else {
                $companyId = explode(",", $companyId);
                if(is_array($addCompanyId)) $addCompanyId = explode(',', $addCompanyId);
                $this->contact['company_id'] = implode(',', array_merge($companyId, $addCompanyId));
            }

            return $this;
        }

        public function setCustomFields($fields){
            if(!is_array($fields)) return $this;
            $this->contact['custom_fields'] = $fields;

            return $this;
        }

        public function addCustomField($id, $value, $enum = null){
            $field = array('id' => $id);
            $field['values'][] = is_array($value) ? $value :
                    array('value' => $value, 'enum' => $enum);

            $custom = $this->contact['custom_fields'];
            if(!$custom) $custom = array();

            $custom[] = $field;
            $this->contact['custom_fields'] = $custom;

            return $this;
        }

        public function getCustomField($id){
            if(!array_key_exists('custom_fields', $this->contact)) return null; 
            
            $fields = $this->contact['custom_fields'];
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

        public function setId($id){
            $this->contact['id'] = $id;
            return $this;
        }

        public function getId(){
            return $this->contact['id'];
        }

        public function getName(){
            return $this->contact['name'];
        }

        public function getResponsibleUserId(){
            return $this->contact['responsible_user_id'];
        }

        public function getCreatedBy(){
            return $this->contact['created_by'];
        }

        public function getCreatedAt(){
            return $this->contact['created_at'];
        }

        public function getUpdatedAt(){
            return $this->contact['updated_at'];
        }

        public function getAccountId(){
            return $this->contact['account_id'];
        }

        public function getUpdatedBy(){
            return $this->contact['updated_by'];
        }

        public function getGroupId(){
            return $this->contact['group_id'];
        }

        public function getCompany(){
            return $this->contact['company'];
        }

        public function getLeads(){
            return $this->contact['leads'];
        }

        public function getTags(){
            return $this->contact['tags'];
        }

        public function getCustomFields(){
            return $this->company['custom_fields'];
        }

        public function getCustomers(){
            return $this->contact['customers'];
        }

        public function getArray(){
            return $this->contact;
        }
    }
?>
