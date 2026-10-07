<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::query()->orderBy('id')->first() ?? User::factory()->create([
            'name' => 'Penulis Demo',
            'email' => 'author@example.com',
        ]);

        $articles = [
            [
                'title' => 'Membangun REST API yang Mudah Dipelihara',
                'excerpt' => 'Catatan tentang struktur endpoint, validasi, dan respons API yang konsisten.',
                'body' => '<h2>Mulai dari kebutuhan pengguna</h2><p>API yang baik memiliki tanggung jawab yang jelas. Tentukan resource dan operasi yang diperlukan sebelum menulis controller.</p><h2>Jaga konsistensi</h2><ul><li>Gunakan penamaan resource yang konsisten.</li><li>Validasi input pada batas masuk aplikasi.</li><li>Kembalikan kode status HTTP yang sesuai.</li></ul><p>Dokumentasi dan pengujian membantu tim frontend memahami kontrak API serta mencegah regresi.</p>',
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'Belajar Go melalui Service Backend Sederhana',
                'excerpt' => 'Memahami handler, pemisahan tanggung jawab, dan penanganan error di Go.',
                'body' => '<h2>Satu service, satu tujuan</h2><p>Mulailah dari service kecil untuk mengelola data artikel. Pisahkan handler HTTP dari logika aplikasi agar setiap bagian mudah diuji.</p><h2>Tangani error secara eksplisit</h2><p>Jangan mengabaikan error dari operasi database atau pembacaan request. Berikan respons yang aman bagi pengguna dan simpan detail teknis pada log.</p><blockquote>Struktur sederhana yang dipahami seluruh tim lebih berguna daripada abstraksi yang terlalu dini.</blockquote>',
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Mengenal Ground Control Station dan UAV',
                'excerpt' => 'Gambaran awal peran software darat dalam pemantauan wahana tanpa awak.',
                'body' => '<h2>Apa itu Ground Control Station?</h2><p>Ground Control Station membantu operator memantau telemetri dan memahami kondisi UAV selama pengoperasian.</p><h2>Informasi yang perlu terlihat</h2><ul><li>Status koneksi dan waktu pembaruan data.</li><li>Posisi serta kondisi wahana.</li><li>Peringatan yang mudah dipahami operator.</li></ul><p>Pengujian melalui simulasi menjadi langkah penting sebelum mencoba perubahan pada perangkat nyata.</p>',
                'status' => PostStatus::Published,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Catatan Integrasi AI pada Aplikasi Backend',
                'excerpt' => 'Draft tentang timeout, validasi respons, dan pengelolaan kegagalan layanan AI.',
                'body' => '<h2>Integrasi bukan sekadar memanggil API</h2><p>Layanan eksternal dapat lambat atau tidak tersedia. Tentukan batas waktu request dan validasi struktur respons sebelum menggunakannya.</p><h2>Rencana pembahasan</h2><ol><li>Menentukan kontrak input dan output.</li><li>Mengatur timeout dan retry terbatas.</li><li>Mencatat kegagalan tanpa menyimpan data sensitif.</li></ol><p><em>Artikel ini masih berupa draft untuk dikembangkan.</em></p>',
                'status' => PostStatus::Draft,
                'published_at' => null,
            ],
            [
                'title' => 'Menyusun Sprint untuk Tim Web Mahasiswa',
                'excerpt' => 'Draft panduan membagi pekerjaan, melakukan review, dan menjaga komunikasi tim.',
                'body' => '<h2>Tentukan hasil yang ingin dicapai</h2><p>Setiap sprint sebaiknya memiliki tujuan yang dapat diperiksa bersama. Pecah pekerjaan besar menjadi tugas dengan kriteria selesai yang jelas.</p><h2>Bangun kebiasaan review</h2><p>Sediakan waktu untuk code review dan pengujian, bukan hanya implementasi fitur.</p><p><em>Berikutnya: contoh pembagian tugas dan agenda evaluasi sprint.</em></p>',
                'status' => PostStatus::Draft,
                'published_at' => null,
            ],
            [
                'title' => 'Langkah Awal Computer Vision dengan OpenCV',
                'excerpt' => 'Artikel terjadwal tentang alur membaca, memproses, dan mengevaluasi citra.',
                'body' => '<h2>Mulai dengan gambar statis</h2><p>Sebelum menggunakan kamera secara langsung, pelajari alur pemrosesan pada beberapa gambar contoh.</p><h2>Alur eksperimen</h2><ol><li>Baca gambar dan periksa ukurannya.</li><li>Ubah ruang warna sesuai kebutuhan.</li><li>Terapkan threshold atau deteksi tepi.</li><li>Bandingkan hasil pada pencahayaan yang berbeda.</li></ol><p>Simpan parameter eksperimen agar hasil dapat direproduksi dan dibandingkan.</p>',
                'status' => PostStatus::Published,
                'published_at' => now()->addWeek(),
            ],
        ];

        foreach ($articles as $article) {
            Post::query()->firstOrCreate(
                ['slug' => Str::slug($article['title'])],
                [...$article, 'user_id' => $author->id],
            );
        }
    }
}
