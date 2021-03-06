<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\ActionLog;
use App\Providers\RouteServiceProvider;
use App\Model\User;
use App\Model\Shop;


use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ShopOwnerRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |clear

    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('shopOwnerGuest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
    	return view('auth.shopOwnerSignUp');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        $shop = $this->createShop($data);
        $data['ownerShopId'] = $shop->id;
        $user = $this->createShopOwner($data);
        event($shop);
        event(new Registered($user));
        $actionLog = new ActionLog();
        $actionLog->shop_id = $shop->id;
        ActionLog::shopRegister($shop->id, $user->id);
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::SHOPOWNERHOME;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->where(function ($query) use ($data) {
                    return $query->where('email', $data['email'])
                        ->where('type', User::SHOPOWNERTYPE);
                }),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'shopName' => [
                'required', 'string',
                Rule::unique('shops', 'name'),
                function ($attribute, $value, $fail) {
                    if (array_search($value, ['admin','bjoe','test']) !== false) {
                        $fail('The shop name has already been taken.');
                    }
                },
            ],
        ]);
    }

    /**
     * Create a new shop instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createShop(array $data)
    {
        return Shop::create([
            'name' => $data['shopName'],
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createShopOwner(array $data)
    {
        return User::createShopOwner([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'owner_shop_id' => $data['ownerShopId'],
            'customer_shop_id' => 0,
        ]);
    }
}
