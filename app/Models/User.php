<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $guarded = [];

    public  function createUser($userData, $userType = '1')
    {
        $formattedData['first_name'] = $userData['firstname'];
        $formattedData['last_name'] = $userData['lastname'];
        $formattedData['email'] = $userData['email'];
        $formattedData['password'] = $userData['password'];
        $formattedData['user_type'] = $userType;


        $result = $this->create($formattedData);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getUserDetails($email, $password)
    {
        $result = $this->where('email', $email)->where('password', $password)->first();
        if ($result) {
            $result = $result->toArray();
            return $result;
        }
    }
}
