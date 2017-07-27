<?php
    require_once(dirname(__FILE__).'/searchable.php');
    define('ACCOUNT_OPTIONS_FILE', $_SERVER['DOCUMENT_ROOT'].'/'.'options.txt');

    final class AccountOptions{
        private $statuses;
        private $contactFields;
        private $leadFields;

        public function __construct($api){
            if(file_exists(ACCOUNT_OPTIONS_FILE)){
                $this->prepareOptions($this->getFromFile());
            } else {
                $options = $api->getOptions();
                $this->saveToFile($options);
                $this->prepareOptions($options);
            }
        }

        private function prepareOptions($options){
            $this->statuses = $options['response']['account']['leads_statuses'];

            $contactsCustom = $options['response']['account']['custom_fields']['contacts'];
            $this->contantFiels = array();
            foreach ($contactsCustom as $cont) {
                if($cont['code'] == 'PHONE'){
                    $this->contantFiels['phone'] = array(
                        'id' => $cont['id'],
                        'type' => 'MOB'
                    );
                } else if($cont['code'] == 'EMAIL'){
                    $this->contantFiels['email'] = array(
                        'id' => $cont['id'],
                        'type' => 'WORK'
                    );
                }
            }

            $this->leadFields = new Searchable(
                $options['response']['account']['custom_fields']['leads'],
                'name'
            );
        }

        public function getStatus($ind){
            return $this->statuses[$ind];
        }

        public function getContactFields(){
            return $this->contantFiels;
        }

        public function getLeadFields(){
            return $this->leadFields;
        }

        private function getFromFile(){
            return json_decode(
                file_get_contents(ACCOUNT_OPTIONS_FILE, true),
                true
            );
        }

        private function saveToFile($options){
            $file = fopen(ACCOUNT_OPTIONS_FILE, 'w');
            fwrite($file, json_encode($options));
            fclose($file);
        }
    }
?>
