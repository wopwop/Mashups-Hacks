<?php

     $auth_token="";
     
     // Facebook email
     $email = "";
     
     // Facebook password
     $password = "";
     
     define('POSTURL', 'https://login.facebook.com/login.php?login_attempt=1');
     
     define('POSTVARS', 'charset_test=�,�,�,�,?,?,?&next=http://developers.facebook.com/docs/api&return_session=0&legacy_return=1&display=&session_key_only=0&trynum=1&lsd=Nj7E1&email='.$email.'&pass='.$password.'&persistent=0&login=Login');
     
     $ch = curl_init(POSTURL);
     
     curl_setopt($ch, CURLOPT_POST ,1);
     
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , 0);
     
     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.16) Gecko/20080702 Firefox/2.0.0.16 Paros/3.2.13"); curl_setopt($ch, CURLOPT_COOKIEJAR , "facebookcookies"); curl_setopt($ch, CURLOPT_COOKIEFILE, "facebookcookies");
     
     curl_setopt($ch, CURLOPT_POSTFIELDS ,POSTVARS);
     
     curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
     
     curl_setopt($ch, CURLOPT_HEADER ,0);
     
     // DO NOT RETURN HTTP HEADERS
     curl_setopt($ch, CURLOPT_RETURNTRANSFER ,1);
     
     // RETURN THE CONTENTS OF THE CALL
     $Rec_Data = curl_exec($ch);
     curl_close($ch);
     
     $dom = new DOMDocument();
     
     @$dom->loadHTML($Rec_Data);
     
     $xpath = new DOMXPath($dom);
     
     $hrefs = $xpath->evaluate("/html//body//div//a");
     
     for ($i = 0; $i < $hrefs->length; $i++) {
        $href = $hrefs->item($i);
        $url = $href->getAttribute('href');
        if(strpos($url, "access_token=")) {
            $url = explode("access_token=", $url);
            $authToken = $url[1];
            break;
        }
        }
            echo $auth_token;        
