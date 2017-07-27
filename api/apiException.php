<?php
    class ApiException extends Exception {
        public function __construct($responseText, Exception $previous = null){
            $response = json_decode($responseText, true);
            parent::__construct(
                $response['response']['error'],
                $response['response']['error_code'],
                $previous
            );
        }
    }
?>
