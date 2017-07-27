<?php
    require_once(dirname(__FILE__).'/utils.php');
    final class Searchable{
        private $array;
        private $indexes;

        public function __construct(&$array, $key){
            $this->array = &$array;
            $this->indexes = array_column($array, $key);
        }

        public function get($val){
            $ind = array_search($val, $this->indexes);
            return $this->array[$ind];
        }

        public function &getArray(){
            return $this->array;
        }
    }
?>
