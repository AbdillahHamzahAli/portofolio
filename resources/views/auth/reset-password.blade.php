<x-auth.panel title="Reset kata sandi" description="Gunakan kata sandi baru dengan minimal 12 karakter.">
    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-6">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-auth.input name="email" label="Email" type="email" :value="old('email', $request->email)" autocomplete="username" required />
        <x-auth.input name="password" label="Kata sandi baru" type="password" autocomplete="new-password" minlength="12" required autofocus />
        <x-auth.input name="password_confirmation" label="Konfirmasi kata sandi" type="password" autocomplete="new-password" minlength="12" required />
        <x-auth.submit>Simpan kata sandi</x-auth.submit>
    </form>
</x-auth.panel>
