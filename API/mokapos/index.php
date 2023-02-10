<?php
class oauth2
{
    private function db()
    {
        include_once("../db/index.php");
        $mokapos = new db;
        return $mokapos;
    }

    /* @param mengambil token baru dengan mengisi token acc dri mokapos */
    public function getmokatoken($type,$acc_token)
    {
        $db = $this->db()->api();
        $url = 'https://api.mokapos.com/oauth/token';
        $redirect_uri = "http://papepu.rf.gd";
        $data = array(
            'client_id' => $db["client_id"] ,
            'client_secret' => $db["client_secret"],
            'redirect_uri' => $redirect_uri
        );
        if ($type === "1") {
            $data["grant_type"] = "refresh_token";
            $data["refresh_token"] = $db['token'];
        } else {
            $data["grant_type"] = "authorization_code";
            $data['code'] = $acc_token;
        }
        // ? POST menggunakan php
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            return false;
        }
        $result = json_decode($result);
        $result = (array) $result;
        $update = $this->db()->updatetoken("mokapos", $result["access_token"]);
        return $update;
    }
    public function mokapos()
    {
        $db = $this->db()->api();
        $url = $db['host'];
        $data = array("none");
        $db = $this->db()->api();
        $prefix = $db['prefix']." ";
        $token = $db['token'];
        function getsummary($perpage,$start,$end)
        {
         $url = "https://api.mokapos.com/v2/outlets/{outlet_id}/reports/sales_summary";
         $data = array(
            "perpage" => $perpage,
            "start" => $start,
            "end" => $end
         );
        }
        if (!empty($url)) {
           // ? POST menggunakan php
           $options = array(
               'http' => array(
                   'header' => "Content-type: application/x-www-form-urlencoded\r\n".
                               "Authorization: ".$prefix.$token."\r\n",
                   'method' => 'POST',
                   'content' => http_build_query($data)
               )
           );
           $context = stream_context_create($options);
           $result = file_get_contents($url, false, $context);
           if ($result === FALSE) {
               return false;
           }
           $result = json_decode($result);
           $result = (array) $result;
        }else{
         return false;
        }
    }
}

?>