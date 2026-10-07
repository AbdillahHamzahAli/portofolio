<x-auth.panel title="Masuk" description="Masuk dengan akun admin untuk mengelola blog. Registrasi publik tidak tersedia.">
    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
        @csrf
        <x-auth.input name="email" label="Email" type="email" :value="old('email')" autocomplete="username" required autofocus />
        <x-auth.input name="password" label="Kata sandi" type="password" autocomplete="current-password" required />
        <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
            <label class="flex min-h-11 cursor-pointer items-center gap-2"><input type="checkbox" name="remember" value="1" class="size-4 accent-ink"> Ingat saya</label>
            <a href="{{ route('password.request') }}" class="underline underline-offset-4">Lupa kata sandi?</a>
        </div>
        <x-auth.submit>Masuk</x-auth.submit>
    </form>
</x-auth.panel>
