<?php


namespace App\Repositories;


use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    private static $instances = [];

    protected function __construct() { }

    public static function getInstance(): AuthRepository
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

/*    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => ['required', 'string', 'max:255','unique:user,user_name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user,email'],
            'password' => ['required', 'string','confirmed'],
            'password_confirmation' => ['required'],
            'arabic_fullName' => ['required', 'string'],
            'english_fullName' => ['nullable', 'string'],
            'user_type_id' => ['nullable', 'string'],
            'mobile' => ['required', 'string','unique:user,mobile'],
            'expiry_date' => ['nullable', 'string'],
            'active' => ['nullable', 'string'],
            'last_login' => ['nullable'],
        ]);
        if ($validator->fails()) {
            return $this->jsonResponseError(true, $validator->errors(), 400);
        }
        $user =  User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'arabic_fullName' => $request->arabic_fullName,
            'english_fullName' => $request->english_fullName,
            'user_type_id' => $request->user_type_id,
            'mobile' => $request->mobile,
            'expiry_date' => $request->expiry_date,
            'active' => $request->active,
            'last_login' => $request->last_login,
        ]);
        $success['token'] = $user->createToken('sanctumAuth')->plainTextToken;
        $success['user'] = new UserResource($user);
        return $this->jsonResponse($success, false, 'You have registered successfully.', 200);
    }*/
}
