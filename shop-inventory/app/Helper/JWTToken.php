<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTToken
{
    public static function CreateToken($userEmail, $userID):string
    {
        $key=env('JWT_KEY');
        $payload=[
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*60, // 60 minute
            'userEmail'=>$userEmail,
            'userID'=>$userID,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function CreateTokenForSetPassword($userEmail):string
    {
        $key=env('JWT_KEY');
        $payload=[
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*20, // 20 minute
            'userEmail'=>$userEmail,
            'userID'=>'0'

        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToken($token):string|object
    {
        try {
            if($token==null){
                return 'unauthorized';
            }
            else{
                $key=env('JWT_KEY');
                $decode = JWT::decode($token, new Key($key,'HS256'));
                return $decode;
            }
        }

        catch (Exception $exception){
            return 'unauthorized';
        }
    }
}
