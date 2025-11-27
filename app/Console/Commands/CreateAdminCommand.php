<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new administrator account';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating a new administrator account...');

        $nom = $this->ask('Nom (Last Name)');
        $prenom = $this->ask('Prenom (First Name)');
        $email = $this->ask('Email Address');
        $password = $this->secret('Password');
        $confirmPassword = $this->secret('Confirm Password');

        if ($password !== $confirmPassword) {
            $this->error('Passwords do not match!');
            return 1;
        }

        $validator = Validator::make([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
        ], [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:administrateurs'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        Administrateur::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => Hash::make($password),
            'role' => 'admin', // Default role
        ]);

        $this->info("Administrator {$prenom} {$nom} created successfully!");

        return 0;
    }
}
