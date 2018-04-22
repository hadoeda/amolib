<?php
    require_once dirname(__FILE__).'/iHookHandlers.php';
    require_once dirname(__FILE__).'/../constants.php';
    require_once dirname(__FILE__).'/../iService.php';

    class HookService implements IService {
        // массив из обработчиков событий хука
        private $hooks = array(
            LEAD => array(),
            CONTACT => array(),
            CUSTOMER => array(),
            COMPANY => array()
        );

        public function run(array $data){
            $hooks = null; $hookData = null;
            if(!$this->getHooksAndData($data, $hooks, $hookData)) {
                throw new Exception("Hook handlers and hook data not defined");
            }
            
            $hookEvent = $this->getHookEvent($hookData);
            if(is_null($hookEvent)) {
                throw new Exception('Hook event not defined');
            } 
            
            if(is_null($hookData[$hookEvent])){
                throw new Exception('Hook data is empty');
            }
            
            $this->executeHook($hookEvent, $hooks, $hookData[$hookEvent]);
        }

        private function getHooksAndData(array $data, &$hooks, &$hookData){
            if(array_key_exists(LEADS, $data)){
                $hooks = $this->hooks[LEAD];
                $hookData = $data[LEADS];
                return true;
            } 
            if(array_key_exists(CONTACTS, $data)){
                $hooks = $this->hooks[CONTACT];
                $hookData = $data[CONTACTS];
                return true;
            } 
            if(array_key_exists(CUSTOMERS, $data)){
                $hooks = $this->hooks[CUSTOMER];
                $hookData = $data[CUSTOMERS];
                return true;
            } 
            if(array_key_exists(COMPANIES, $data)){
                $hooks = $this->hooks[COMPANY];
                $hookData = $data[COMPANIES];
                return true;
            }

            return false;
        }

        private function getHookEvent($hookData){
            if(array_key_exists(RESPONSIBLE, $hookData)) return RESPONSIBLE;
            if(array_key_exists(RESTORE, $hookData)) return RESTORE;
            if(array_key_exists(ADD, $hookData)) return ADD;
            if(array_key_exists(UPDATE, $hookData)) return UPDATE;
            if(array_key_exists(DELETE, $hookData)) return DELETE;
            if(array_key_exists(STATUS, $hookData)) return STATUS;
            if(array_key_exists(NOTE, $hookData)) return NOTE;

            return null;
        }

        private function executeHook($event, array $hookHandlers, array $data){
            if(count($hookHandlers) === 0) return;
            
            foreach($hookHandlers as $handler){
                foreach($data as $dt){
                    $this->executeHandlerMethod(ALL, $handler, $dt);
                    $this->executeHandlerMethod($event, $handler, $dt);
                }
            }
        }

        private function executeHandlerMethod($event, IHookHandlers $handler, array $data){
            if($event === ALL) $handler->all($data);
            elseif($event === RESPONSIBLE) $handler->responsible($data);
            elseif($event === RESTORE) $handler->restore($data);
            elseif($event === ADD) $handler->add($data);
            elseif($event === UPDATE) $handler->update($data);
            elseif($event === DELETE) $handler->delete($data);
            elseif($event === STATUS) $handler->status($data);
            elseif($event === NOTE) $handler->note($data);
        }

        public function addLeadHook(IHookHandlers $clb){
            $this->addHook(LEAD, $clb);
            return $this;
        }

        public function delLeadHook(IHookHandlers $clb){
            $this->delHook(LEAD, $clb);
            return $this;
        }
        
        public function addContactHook(IHookHandlers $clb){
            $this->addHook(CONTACT, $clb);
            return $this;
        } 

        public function delContactHook(IHookHandlers $clb){
            $this->delHook(CONTACT, $clb);
            return $this;
        }       
        
        public function addCustomerHook(IHookHandlers $clb){
            $this->addHook(CUSTOMER, $clb);
            return $this;
        }

        public function delCustomerHook(IHookHandlers $clb){
            $this->delHook(CUSTOMER, $clb);
            return $this;
        }
                
        public function addCompanyHook(IHookHandlers $clb){
            $this->addHook(COMPANY, $clb);
            return $this;
        }

        public function delCompanyHook(IHookHandlers $clb){
            $this->delHook(COMPANY, $clb);
            return $this;
        }
                                
        private function addHook($entity, IHookHandlers $clb){
            $this->hooks[$entity][] = $clb;
        }

        private function delHook($entity, IHookEvents $clb){
            $key = array_search($clb, $this->hooks[$entity], true);
            array_splice($this->hooks[$entity], $key, 1);
        }
    }
?>