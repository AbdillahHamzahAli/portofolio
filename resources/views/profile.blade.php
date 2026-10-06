<x-layout>
    <section aria-labelledby="profile-title" class="grid items-center gap-12 py-12 lg:grid-cols-12 lg:py-section">
        <div class="lg:col-span-8">
            <p class="mb-6 text-xs font-medium tracking-widest text-body uppercase">Profil / Backend Developer</p>
            <h1 id="profile-title" class="text-[32px] leading-[1.1] font-normal tracking-tight sm:text-[56px] lg:text-hero">Hamzah Ali<br>Abdillah<span class="text-muted">.</span></h1>
            <p class="mt-6 text-lg text-ink">Mahasiswa Informatika ITS.<br>Membangun API, belajar, dan berkolaborasi.</p>
            <p class="mt-5 max-w-xl text-base leading-relaxed text-body">Antusias untuk belajar dan berkembang, dengan kemampuan berpikir kritis dan pemecahan masalah. Terbuka terhadap ide baru, senang bekerja dalam tim, dan berkomitmen memberikan kontribusi positif untuk mencapai tujuan bersama.</p>
            <div class="mt-8 flex flex-wrap items-center gap-4">
                <a href="mailto:abdillahhamzahali@gmail.com" class="inline-flex min-h-11 items-center gap-6 rounded-control bg-primary px-5 py-3 text-sm font-medium text-on-primary active:bg-primary-active">Hubungi saya <span aria-hidden="true">↗</span></a>
                <a href="{{ asset('hamzah-ali-abdillah-resume.pdf') }}" download class="inline-flex min-h-11 items-center gap-6 rounded-control border border-hairline-strong bg-surface-card px-5 py-3 text-sm font-medium hover:bg-canvas-soft">Unduh resume <span aria-hidden="true">↓</span></a>
            </div>
        </div>
        <figure class="mx-auto w-full max-w-xs lg:col-span-4 lg:ml-auto">
            <div class="overflow-hidden rounded-card border border-hairline bg-surface-card p-3">
                <img src="{{ asset('hamzah-portrait.png') }}" alt="Foto Hamzah Ali Abdillah" width="1414" height="1414" fetchpriority="high" class="aspect-square w-full rounded-control object-cover">
                <figcaption class="flex items-center justify-between gap-4 px-2 pt-5 pb-3 text-xs text-body"><span>Informatika · ITS</span><span>Surabaya, Indonesia</span></figcaption>
            </div>
            <p class="mt-4 text-center text-xs text-muted">Backend development · Robotics · Teamwork</p>
        </figure>
    </section>

    <x-resume.section id="pengalaman" number="01" title="Pengalaman kerja" description="Mengembangkan sistem backend untuk kebutuhan nyata, dari API hingga integrasi AI.">
        <x-resume.experience company="REXTRA TECHNOLOGY" role="Part Time — Backend Developer" period="Okt 2025 — Sekarang" location="Surabaya, Indonesia" description="Startup teknologi pendidikan yang menyediakan layanan rekomendasi dan perencanaan karier di bidang digital.">
            <li>Mengembangkan REST API dan melakukan integrasi dengan AI.</li>
            <li>Memperbaiki error atau bug ringan yang ditemukan oleh tim QA maupun pengguna.</li>
        </x-resume.experience>
    </x-resume.section>

    <x-resume.section id="organisasi" number="02" title="Organisasi & kolaborasi" description="Bertumbuh bersama tim di bidang teknologi, riset, dan kegiatan mahasiswa.">
        <div class="flex flex-col gap-4">
            <x-resume.experience company="Bayucaraka" role="Software Engineer" period="Feb 2026 — Sekarang" location="Surabaya, Indonesia" description="Tim riset yang berfokus pada Unmanned Aerial Vehicle (UAV).">
                <li>Mengembangkan software Ground Control Station.</li>
                <li>Melakukan konfigurasi UAV.</li>
            </x-resume.experience>
            <x-resume.experience company="IEEE BIG ITS" role="Manager Web Development" period="Des 2025 — Sekarang" location="Surabaya, Indonesia" description="Acara tahunan yang menghubungkan mahasiswa, akademisi, dan praktisi industri melalui kompetisi serta kolaborasi teknologi.">
                <li>Menyusun timeline kerja, melakukan sprint planning, dan mengawasi deadline.</li>
                <li>Menjaga kualitas kode melalui code review dan pengujian otomatis.</li>
            </x-resume.experience>
            <x-resume.experience company="Society of Renewable Energy ITS (SRE ITS SC)" role="Backend Developer" period="Agu 2025 — Sekarang" description="Organisasi energi terbarukan yang mendorong inovasi, ide, dan pembelajaran interaktif di kalangan mahasiswa.">
                <li>Merancang, membangun, dan mengelola service API berbasis Go (Golang) untuk sistem informasi internal organisasi.</li>
                <li>Menulis dokumentasi API yang komprehensif untuk mempermudah kolaborasi antartim.</li>
            </x-resume.experience>
            <x-resume.experience company="Surabaya MUN Club" role="Backend Developer" period="Mei 2025 — Okt 2025" location="Surabaya, Indonesia" description="Kompetisi Model United Nations oleh ITS MUN Club, sebagai wadah kolaborasi, negosiasi, dan diskusi isu global.">
                <li>Mendesain dan mengimplementasikan arsitektur RESTful API sesuai kebutuhan aplikasi.</li>
                <li>Berkoordinasi dengan tim frontend dan product untuk memastikan integrasi yang mulus.</li>
            </x-resume.experience>
            <x-resume.experience company="Schematics 2025" role="Backend Developer" period="Mar 2025 — Nov 2025" location="Surabaya, Indonesia" description="Kegiatan Departemen Teknik Informatika ITS yang berfokus pada perlombaan dan pelatihan teknologi.">
                <li>Merancang dan mengembangkan API website Schematics.</li>
                <li>Berkolaborasi dengan tim untuk mencapai target pengembangan website.</li>
                <li>Mendokumentasikan desain sistem dan alur kerja backend.</li>
            </x-resume.experience>
            <x-resume.experience company="SUBMITS × IMJ Jombang" role="Data Management" period="Des 2024 — Jan 2025" location="Jombang, Indonesia" description="Kegiatan tryout dan SUBMITS hasil kolaborasi IniLhoITS dan Forda Jombang.">
                <li>Melaksanakan sosialisasi mengenai ITS kepada siswa SMA di wilayah Jombang.</li>
                <li>Mengelola data dan memberikan panduan kepada peserta tryout SUBMITS.</li>
                <li>Mengoordinasikan pelaksanaan tryout sebagai penanggung jawab peserta.</li>
            </x-resume.experience>
            <x-resume.experience company="RIVAL ITS" role="Intern Programming Division" period="Agu 2024 — Nov 2024" location="Surabaya, Indonesia" description="Seleksi magang divisi programming pada tim riset robotika ITS yang berfokus pada robot tematik.">
                <li>Pemrograman C++ dan computer vision dengan modul OpenCV.</li>
                <li>Pemrograman robot menggunakan Robot Operating System (ROS).</li>
                <li>Membuat autonomous robot transporter.</li>
            </x-resume.experience>
        </div>
    </x-resume.section>

    <x-resume.section id="pendidikan" number="03" title="Pendidikan" description="Fondasi akademik dalam informatika dan ilmu pengetahuan alam.">
        <div class="flex flex-col gap-6">
            <article class="rounded-card border border-hairline bg-surface-card p-6">
                <p class="mb-4 text-xs text-body">Jun 2024</p>
                <h3 class="text-lg font-semibold">Institut Teknologi Sepuluh Nopember</h3>
                <p class="mt-2 text-sm text-body">Bachelor of Informatics</p>
                <p class="mt-4 text-xs text-muted">Surabaya, Indonesia</p>
            </article>
            <article class="rounded-card border border-hairline bg-surface-card p-6">
                <p class="mb-4 text-xs text-body">Jun 2021 — Jun 2024</p>
                <h3 class="text-lg font-semibold">SMA 3 Jombang</h3>
                <p class="mt-2 text-sm text-body">Senior High School · IPA</p>
                <p class="mt-4 text-xs text-muted">Jombang, Indonesia</p>
            </article>
        </div>
    </x-resume.section>

    <x-resume.section id="keahlian" number="04" title="Keahlian & pengembangan" description="Teknologi dan keterampilan yang digunakan dalam pengalaman kerja serta organisasi.">
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <h3 class="mb-4 text-base font-semibold">Backend & API</h3>
                <ul class="flex flex-wrap gap-2">
                    @foreach (['Go (Golang)', 'RESTful API', 'Integrasi AI', 'Dokumentasi API', 'Debugging'] as $skill)
                        <li class="rounded-full border border-hairline px-3 py-1.5 text-xs text-body">{{ $skill }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="mb-4 text-base font-semibold">Robotika & computer vision</h3>
                <ul class="flex flex-wrap gap-2">
                    @foreach (['C++', 'OpenCV', 'ROS', 'Ground Control Station', 'Konfigurasi UAV'] as $skill)
                        <li class="rounded-full border border-hairline px-3 py-1.5 text-xs text-body">{{ $skill }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="sm:col-span-2">
                <h3 class="mb-4 text-base font-semibold">Kolaborasi & manajemen</h3>
                <ul class="flex flex-wrap gap-2">
                    @foreach (['Sprint planning', 'Code review', 'Pengujian otomatis', 'Pengelolaan data', 'Kerja tim'] as $skill)
                        <li class="rounded-full border border-hairline px-3 py-1.5 text-xs text-body">{{ $skill }}</li>
                    @endforeach
                </ul>
            </div>
            <article class="mt-2 rounded-card border border-hairline bg-surface-card p-6 sm:col-span-2">
                <p class="text-xs text-muted">PELATIHAN · 2025</p>
                <h3 class="mt-3 text-lg font-semibold">LKMM TD</h3>
                <p class="mt-3 text-sm leading-relaxed text-body">Latihan Keterampilan Manajemen Mahasiswa Tingkat Dasar. Pelatihan keterampilan organisasi, kepemimpinan, dan manajemen kegiatan melalui perencanaan yang sistematis.</p>
            </article>
        </div>
    </x-resume.section>

    <section id="kontak" aria-labelledby="contact-title" class="scroll-mt-8 border-t border-hairline py-16 lg:py-24">
        <p class="mb-5 text-xs font-medium tracking-widest text-body uppercase">Mari terhubung</p>
        <h2 id="contact-title" class="text-section font-normal">Ide baru dimulai<br>dari sebuah percakapan.</h2>
        <div class="mt-8 flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-end">
            <a href="mailto:abdillahhamzahali@gmail.com" class="max-w-full break-all text-lg underline decoration-hairline-strong underline-offset-8 sm:text-2xl">abdillahhamzahali@gmail.com ↗</a>
            <div class="flex flex-wrap gap-x-6 gap-y-4 text-sm text-body">
                <a href="tel:+685546718596" class="hover:underline">+685546718596</a>
                <a href="https://www.linkedin.com/in/abdillahhamzahali" class="hover:underline">LinkedIn ↗</a>
                <a href="https://hamzah-dev.netlify.app" class="hover:underline">Portfolio ↗</a>
            </div>
        </div>
    </section>
</x-layout>
