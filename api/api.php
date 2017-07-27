<?php
    require_once(dirname(__FILE__).'/apiException.php');

    define('COOKIE_FILE', $_SERVER['DOCUMENT_ROOT'].'/'.'cookie.txt');

    final class ApiService {
        private $domain;
        private $account;

        public function __construct($domain, $account){
            $this->domain = $domain;
            $this->account = $account;
        }

        private function execute($link, $method = null, $data = null){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
            curl_setopt($curl, CURLOPT_URL, $link);
            if($method) curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            if($data){
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_COOKIEFILE, COOKIE_FILE);
            curl_setopt($curl, CURLOPT_COOKIEJAR, COOKIE_FILE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

            $out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE); #Получим HTTP-код ответа сервера
            curl_close($curl); #Завершаем сеанс cURL
            $code = (int)$code;
            if($code!=200 && $code!=204) throw new ApiException($out);

            return json_decode($out, true);
        }

        public function auth(){
            return $this->execute(
                'https://'.$this->domain.'.amocrm.ru/private/api/auth.php?type=json',
                'POST',
                $this->account
            );
        }

        public function getOptions(){
            return $this->execute(
                'https://'.$this->domain.'.amocrm.ru/private/api/v2/json/accounts/current'
            );
        }

        public function setLeads($dealsDesc){
            return $this->execute(
                'https://'.$this->domain.'.amocrm.ru/private/api/v2/json/leads/set',
                'POST',
                $dealsDesc
            );
        }

        public function setContacts($contactsDesc){
            return $this->execute(
                'https://'.$this->domain.'.amocrm.ru/private/api/v2/json/contacts/set',
                'POST',
                $contactsDesc
            );
        }
    }
?>
