<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use App\Notifications\AccountCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DonorRegistrationController extends Controller
{
    public function create()
    {
        return view('pages.donor-register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'unique:users,email'],
            'phone'             => ['required', 'string', 'max:20'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'donor_type'        => ['required', 'in:Individual,Corporate,NGO'],
            'country'           => ['required', 'string', 'max:100'],
            'address'           => ['required', 'string', 'max:255'],
        ]);

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'phone'     => $data['phone'],
                'password'  => Hash::make($data['password']),
                'is_active' => true,
            ]);

            $user->assignRole('donor');

            Donor::create([
                'user_id'           => $user->id,
                'organization_name' => $data['organization_name'] ?? null,
                'phone'             => $data['phone'],
                'address'           => $data['address'],
                'country'           => $data['country'],
                'donor_type'        => $data['donor_type'],
            ]);

            return $user;
        });

        $user->notify(new AccountCreatedNotification('donor'));

        Auth::guard('web')->login($user);

        return redirect('/donor');
    }
}
