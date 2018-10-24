<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelperRestCall
{
    
    public function __construct()
    {
    }
    
    /* MAKE THE GET REQUEST */
    
    
    public function buildRequest($base, $params=[]){
        
        if(!empty($params)){
            foreach($params as $key => $value){
                reset($params);
                if ($key === key($params)){
                    $base.= "?".$key."=".$value;
                } else {
                    $base.= "&".$key."=".$value;
                }
            }
        }
        
        return $base;
    }
    
    public function getRequest($request){
        $curl = curl_init();

        
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $request,
            CURLOPT_USERAGENT => 'HodlerCompany',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'nethash: 5e67037fd290ba7ab378e84a591d251c46eb9770eb134983771fd602233bf193',
                'version: 0.3.0',
                'os: qae-dashboard',
                'port: 4100'],
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);
    }
    
    
    public function getPeers(){
        $base = $this->buildRequest("http://api.qredit.cloud/peer/list");
        return $this->getRequest($base);
    }
    
    public function createTransaction($transaction, $peer=""){        
        $curl = curl_init();
        
        $url = [];        
        //$url = [];
        $url["transactions"] = [];
        if(is_array($transaction)){
            for($i = 0; $i < count($transaction); $i++){
                $url["transactions"][] = $transaction[$i];
            }
        } else {
            $url["transactions"][] = $transaction;
        }
        
        $params = json_encode($url);
        
        if($peer != ""){
            $peer_address = $peer;
        } else {
            $peer_address = "api.qredit.cloud";
        }
        
        // http://".$ip->ip.":".$ip->port."/peer/transactions
        // CURLOPT_URL => "http://api.qredit.cloud/peer/transactions",
        
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "http://".$peer_address."/peer/transactions",
            CURLOPT_USERAGENT => 'HodlerCompany',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'nethash: 5e67037fd290ba7ab378e84a591d251c46eb9770eb134983771fd602233bf193',
                'version: 0.0.1',
                'os: qae-dashboard',
                'port: 1'],
        ));
        
        $resp = curl_exec($curl);
        curl_close($curl);
        

        return json_decode($resp);
    }
    
    

}