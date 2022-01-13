<?php
namespace Orange;

class Auth
{
    public function base64Url(string $string):string{
        return str_replace(['+','/','='],['-','_',''],base64_encode($string));
    }

    /**
     * Create token
     * */
    public function token(array $data):string{
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        $data['expires'] = time()+30*60;
        $payload = json_encode($data);

        $base64UrlHeader = $this->base64Url($header);
        $base64UrlPayload = $this->base64Url($payload);
        $signature = hash_hmac('sha256',$base64UrlHeader.'.'.$base64UrlPayload,SECRET_ID,true);
        $base64UrlSignature = $this->base64Url($signature);

        return $base64UrlHeader.'.'.$base64UrlPayload.'.'.$base64UrlSignature;
    }

    /**
     * Get header Authorization
     * */
    public function getAuthorizationHeader(): ?string
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * get access token from header
     * */
    public function getBearerToken(): ?string
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * Verify JWT
     * */
    public function verifyJwt(string $jwt, string $secret):bool{
        if(!empty($jwt)) {
            $tokenParts = explode('.', $jwt);
            $header = base64_decode($tokenParts[0]);
            $payload = base64_decode($tokenParts[1]);
            $signatureProvided = $tokenParts[2];
            $expiration = json_decode($payload)->expires;

            if ($expiration > time()) { // if not expired
                $base64UrlHeader = $this->base64Url($header);
                $base64UrlPayload = $this->base64Url($payload);
                $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $secret, true);
                $base64UrlSignature = $this->base64Url($signature);

                if ($base64UrlSignature === $signatureProvided) { // if signatures matched
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Will return the information on the payload
     */
    public function getJwtPayloadInfo(string $jwt, string $secret): mixed{
        if(!empty($jwt)) {
            $tokenParts = explode('.', $jwt);
            return json_decode(base64_decode($tokenParts[1]));
        }
    }

    /**
     * Authenticate the user
     */
    public function Auth(): bool{
        /* if using bearer token in header */
        //$token = $user->getBearerToken();

        /* if using cookies */
        $token = isset($_COOKIE['archives_token']) ? htmlspecialchars($_COOKIE["archives_token"]) : '';
        return $this->verifyJwt($token, SECRET_ID);
    }
}