<?php
    class Contact {
        private $contact;

        public function __construct(){
            $this->contact = array();
        }

        public function setName($name){
            $this->contact['name'] = $name;
            return $this;
        }

        public function setLinkedLeads($leads){
            if(!is_array($leads)) $leads = array($leads);

            $this->constact['linked_leads_id'] = $leads;
            return $this;
        }

        public function addLinkedLeads($addLeads){
            $leads = $this->contact['linked_leads_id'];
            if(!$leads) $leads = array();

            if(!is_array($addLeads)) $leads[] = $addLeads;
            else $leads = array_merge($leads, $addLeads);

            $this->contact['linked_leads_id'] = $leads;

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

        public function getArray(){
            return $this->contact;
        }
    }
?>
