<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RegistrationToken extends Model
{
    protected $fillable = [
        'email',
    ];

    public function isValid()
    {
        return $this->created_at->addWeeks(1)->lt(Carbon::now());
    }

    protected function generateToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function save(array $options = [])
    {
        if (!$this->exists) {
            $this->token = $this->generateToken();
        }

        return parent::save($options);
    }
}
