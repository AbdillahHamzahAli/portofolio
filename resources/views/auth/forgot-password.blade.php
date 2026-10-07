<x-auth.panel title="Lupa kata sandi?" description="Masukkan email admin untuk menerima tautan reset kata sandi.">
    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
        @csrf
        <x-auth.input name="email" label="Email" type="email" :value="old('email')" autocomplete="username" required autofocus />
        <x-auth.submit>Kirim tautan reset</x-auth.submit>
        <a href="{{ route('login') }}" class="text-center text-sm underline underline-offset-4">Kembali ke halaman masuk</a>
    </form>
</x-auth.panel>
