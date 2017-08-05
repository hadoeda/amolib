<?php
    class Contact {
        private $contact;
        private $custom;

        public function __construct(){
            $this->contact = array();

            $this->contact['custom_fields'] = array();
            $this->custom = &$this->contact['custom_fields'];
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
            $leads = $this->constact['linked_leads_id'];
            if(!is_array($addLeads)) $leads[] = $addLeads;
            else $leads = array_merge($leads, $addLeads);

            $this->constact['linked_leads_id'] = $leads;
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

        public getContactArray(){
            return $this->lead;
        }
    }
?>
