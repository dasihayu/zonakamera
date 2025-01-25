<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    // Tampilkan form registrasi
    public function showRegistrationForm()
    {
        $brandLogo = DB::table('settings')->where('name', 'brand_logo')->value('payload');
        $brandLogo = trim($brandLogo, '"');
        return view('auth.register', compact('brandLogo'));
    }

    // Tangani registrasi pengguna
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        Auth::login($user);
        return redirect()->route('home');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:9', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Buat pengguna
        $user = User::create([
            'firstname' => $data['firstName'],
            'lastname' => $data['lastName'],
            'username' => Str::slug($data['firstName'] . ' ' . $data['lastName']),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);

        // Ambil role_id untuk role 'customer'
        $customerRole = Role::where('name', 'customer')->first();

        if ($customerRole) {
            // Tambahkan role customer ke pengguna
            DB::table('model_has_roles')->insert([
                'role_id' => $customerRole->id,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id,
            ]);
        }

        return $user;
    }
}
