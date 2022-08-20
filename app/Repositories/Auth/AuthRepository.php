<?php


namespace App\Repositories\Auth;


use App\Http\Requests\UserAuthenticationRequest;
use App\Models\User;
use App\Repositories\Base\BaisRepository;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaisRepository implements AuthRepositoryInterface
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function createOrLogin(UserAuthenticationRequest $request)
    {
        $user = $this->model->wherePhone($request->phone)->first();
        if ($user)
        {
            $success['token'] = $user->createToken('sanctumAuth')->plainTextToken;
            $success['user'] = $user;
            return $success;
        }
        else {
            $user = $this->model::create([
                'phone' => $request->phone,
                'password' => Hash::make('708090000')
            ]);
            $success['token'] = $user->createToken('sanctumAuth')->plainTextToken;
            $success['user'] = $user;
            return $success;
        }
    }
}
