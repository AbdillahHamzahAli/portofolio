<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create an administrator using securely prompted credentials';

    public function handle(): int
    {
        if (! $this->input->isInteractive()) {
            $this->error('Jalankan perintah secara interaktif untuk memasukkan kata sandi dengan aman.');

            return self::FAILURE;
        }

        $name = $this->ask('Nama admin');
        $email = $this->ask('Email admin');
        $password = $this->secret('Kata sandi (minimal 12 karakter)');
        $confirmation = $this->secret('Konfirmasi kata sandi');

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password, 'password_confirmation' => $confirmation],
            ['name' => ['required', 'string', 'max:255'], 'email' => ['required', 'email', 'max:255', 'unique:users,email'], 'password' => ['required', 'confirmed', Password::min(12)]],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = new User;
        $user->fill(['name' => $name, 'email' => $email, 'password' => $password]);
        $user->is_admin = true;
        $user->save();

        $this->info('Akun admin berhasil dibuat.');

        return self::SUCCESS;
    }
}
