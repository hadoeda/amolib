<?php
    class ApiException extends Exception {
        public function __construct($responseText, $code = null, Exception $previous = null){
            $response = json_decode($responseText, true);
            if ($response){
                parent::__construct(
                    $response['response']['error'],
                    $response['response']['error_code'],
                    $previous
                );
            } else {
                parent::__construct(
                    $responseText,
                    $code,
                    $previous
                );
            }
        }
    }
?>
