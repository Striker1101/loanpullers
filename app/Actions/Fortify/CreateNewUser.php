<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */

    public function create(array $input): User
    {
        // Validate the input data
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);


        // Create wallet for the user
        $this->createWalletForUser($user);

        // Flash success message
        Session::flash('success', 'User created successfully.');

        // Redirect to dashboard
        return $user;

    }

    protected function createWalletForUser(User $user)
    {
        // Create wallets for the user
        $walletsData = [
            ['name' => 'Loan', 'slug' => 'Rapid Loan', 'des' => 'Loan Account'],
            ['name' => $user->name, 'slug' => 'General', 'des' => 'General Account'],
        ];

        foreach ($walletsData as $walletData) {
            try {
                $uuid = Str::uuid();
                Wallet::create([
                    'holder_id' => $user->id,
                    'holder_type' => get_class($user),
                    'slug' => $walletData['slug'],
                    'uuid' => $uuid,
                    'name' => $walletData['name'],
                    'meta' => '{"currency":"AED"}',
                    'description' => $walletData['des'],
                    // Add other attributes as needed
                ]);
            } catch (QueryException $e) {
                // Handle duplicate UUID error
                if ($e->errorInfo[1] === 1062) { // MySQL error code for duplicate entry
                    // Regenerate UUID and try again
                    continue; // Skip to the next iteration of the loop
                } else {
                    // Handle other database errors
                    throw $e; // Rethrow the exception
                }
            }
        }
    }


}


