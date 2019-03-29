<?php
namespace App\Services;

use App\Model\Token;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TokenService
{
    public function __construct()
    {
        //
    }

    public function generate ($userId) {
        $token = Arr::get(self::get($userId), 'token', null);
        if ($token == null) {
            $token = self::create($userId);
        }
        return $token;
    }

    public function get ($userId) {

        return Token::where('user_id', $userId)
            ->where('expired_at', '>', Carbon::now()->timestamp)
            ->first();
    }

    public function create ($userId) {
        $token = new Token;
        $token->user_id = $userId;
        $token->token = (string) Str::uuid();
        $token->expired_at = Carbon::now()->addDays(7)->timestamp;
        $token->save();
        return $token->token;
    }

    public function verifyToken ($token) {
        $result = array(
            "isValid" => false,
            "expiredAt" => "",
        );
        $token = Token::where('token', $token)
            ->where('expired_at', '>', Carbon::now()->timestamp)
            ->first();
        $expiredAt = Arr::get($token, 'expired_at', null);

        if ($expiredAt != null) {
            $result["isValid"] = true;
            $result["expiredAt"] = Carbon::createFromTimestamp($expiredAt)->toIso8601String();
        }

        return $result;

    }

}
