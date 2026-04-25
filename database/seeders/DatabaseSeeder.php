<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(EmailSeeder::class);

        $articles = [
            [
                'title' => 'Keamanan System Selama Libur',
                'category' => 'Keamanan',
                'excerpt' => 'Mari bersama menjaga keamanan data & sistem perusahaan. Pastikan perangkat kerja tetap aman sebelum meninggalkan kantor atau saat dibawa mudik.',
                'content' => "Mari bersama menjaga keamanan data & sistem perusahaan.\n\nPastikan perangkat kerja tetap aman sebelum meninggalkan kantor atau saat dibawa mudik.\n\n**Langkah-langkah yang perlu dilakukan:**\n\n- Aktifkan password & lock screen otomatis\n- Update sistem operasi dan aplikasi ke versi terbaru\n- Matikan perangkat kerja yang tidak digunakan\n- Backup data penting sebelum libur panjang\n- Jangan tinggalkan laptop atau perangkat di tempat umum\n\nKeamanan sistem adalah tanggung jawab bersama. Dengan menjaga keamanan perangkat, kita melindungi data perusahaan dan memastikan operasional berjalan lancar setelah kembali dari libur.",
                'published_at' => now()->subMonths(1),
            ],
            [
                'title' => 'Aplikasi Abal-Abal: Jangan Sampai Jadi Korban Digital',
                'category' => 'Tips & Trik',
                'excerpt' => 'Di era digital kayak sekarang, hampir semua orang nggak bisa lepas dari aplikasi dan media sosial. Tapi, tidak semua aplikasi itu aman digunakan.',
                'content' => "Jangan Sampai Jadi Korban Digital!\n\nDi era digital kayak sekarang, hampir semua orang nggak bisa lepas dari aplikasi dan media sosial. Mulai dari hiburan, kerjaan, sampai urusan belanja — semua ada di genggaman tangan.\n\nTapi, nggak semua aplikasi itu aman!\n\n**Ciri-ciri Aplikasi Abal-Abal:**\n\n- Minta izin akses yang berlebihan (kontak, kamera, mikrofon)\n- Tidak tersedia di toko resmi (Play Store / App Store)\n- Developer tidak jelas atau tidak bisa diverifikasi\n- Tampilan mirip aplikasi resmi tapi ada perbedaan kecil\n- Menjanjikan fitur premium gratis\n\n**Cara Melindungi Diri:**\n\n- Selalu download aplikasi dari sumber resmi\n- Baca review dan cek rating aplikasi\n- Perhatikan izin yang diminta saat instalasi\n- Update aplikasi secara rutin\n- Gunakan antivirus di perangkat Anda\n\nIngat, keamanan digital dimulai dari kebiasaan kita sehari-hari.",
                'published_at' => now()->subMonths(6),
            ],
            [
                'title' => 'Tips Menjaga Performa Laptop Kantor',
                'category' => 'Tips & Trik',
                'excerpt' => 'Laptop kantor yang lambat bisa menghambat produktivitas kerja. Berikut beberapa tips untuk menjaga performa laptop tetap optimal.',
                'content' => "Laptop kantor yang lambat bisa menghambat produktivitas kerja. Berikut beberapa tips untuk menjaga performa laptop tetap optimal.\n\n**1. Rutin Restart Perangkat**\nJangan biasakan untuk hanya menutup laptop tanpa mematikannya. Restart secara berkala membantu membersihkan memori sementara.\n\n**2. Hapus File Temporary**\nFile temporary bisa memenuhi storage dan memperlambat sistem. Gunakan Disk Cleanup secara rutin.\n\n**3. Nonaktifkan Program yang Berjalan di Background**\nBanyak program yang berjalan otomatis saat startup. Nonaktifkan yang tidak diperlukan melalui Task Manager.\n\n**4. Update Driver dan OS**\nPastikan driver dan sistem operasi selalu dalam versi terbaru untuk stabilitas dan keamanan.\n\n**5. Jaga Kebersihan Fisik**\nDebu yang menumpuk bisa menyebabkan overheating. Bersihkan ventilasi laptop secara berkala.",
                'published_at' => now()->subMonths(3),
            ],
            [
                'title' => 'Mengenal Phishing: Ancaman Siber yang Wajib Diwaspadai',
                'category' => 'Keamanan',
                'excerpt' => 'Phishing adalah salah satu teknik penipuan siber paling umum. Pelajari cara mengenali dan menghindarinya.',
                'content' => "Phishing adalah salah satu teknik penipuan siber paling umum yang sering memakan korban dari berbagai kalangan.\n\n**Apa itu Phishing?**\n\nPhishing adalah upaya penipuan untuk mencuri informasi sensitif (seperti password, data kartu kredit) dengan cara menyamar sebagai pihak yang terpercaya.\n\n**Bentuk-bentuk Phishing:**\n\n- Email palsu yang tampak seperti dari bank atau perusahaan resmi\n- Link website palsu yang mirip dengan website asli\n- SMS berisi link mencurigakan\n- Pesan WhatsApp dari nomor tidak dikenal\n\n**Cara Menghindari Phishing:**\n\n- Selalu verifikasi alamat email pengirim\n- Jangan klik link dari sumber yang tidak dikenal\n- Periksa URL website sebelum memasukkan data sensitif\n- Aktifkan autentikasi dua faktor (2FA)\n- Laporkan ke tim IT jika menerima email mencurigakan\n\nJika ragu, jangan klik — hubungi tim IT terlebih dahulu.",
                'published_at' => now()->subWeeks(2),
            ],
            [
                'title' => 'Panduan Backup Data yang Baik dan Benar',
                'category' => 'Panduan',
                'excerpt' => 'Kehilangan data bisa terjadi kapan saja akibat kerusakan hardware, malware, atau kesalahan manusia. Pelajari cara backup data yang efektif.',
                'content' => "Kehilangan data bisa terjadi kapan saja — akibat kerusakan hardware, serangan malware, atau bahkan kesalahan manusia. Itulah mengapa backup data sangat penting.\n\n**Strategi Backup 3-2-1:**\n\n- **3** salinan data\n- Simpan di **2** media berbeda\n- Dengan **1** salinan di lokasi yang berbeda (offsite/cloud)\n\n**Jenis-jenis Backup:**\n\n1. **Full Backup** - Backup semua data secara lengkap\n2. **Incremental Backup** - Backup hanya data yang berubah sejak backup terakhir\n3. **Differential Backup** - Backup data yang berubah sejak full backup terakhir\n\n**Tools Backup yang Direkomendasikan:**\n\n- Windows Backup & Restore\n- Google Drive / OneDrive untuk dokumen\n- External HDD untuk backup lokal\n\nLakukan backup secara rutin dan selalu test restore untuk memastikan data bisa dipulihkan.",
                'published_at' => now()->subWeeks(1),
            ],
            [
                'title' => 'Mengenal Jaringan WiFi: Tips Aman Bekerja dari Mana Saja',
                'category' => 'Jaringan',
                'excerpt' => 'Bekerja dari kafe atau tempat umum menggunakan WiFi publik? Ketahui risiko dan cara melindungi data Anda.',
                'content' => "Bekerja dari kafe atau tempat umum menggunakan WiFi publik sudah menjadi hal biasa. Namun, ada risiko keamanan yang perlu Anda ketahui.\n\n**Risiko WiFi Publik:**\n\n- Man-in-the-Middle Attack — penyerang bisa menyadap komunikasi Anda\n- Fake Hotspot — WiFi palsu yang dibuat untuk mencuri data\n- Packet Sniffing — menangkap data yang tidak terenkripsi\n\n**Tips Aman Menggunakan WiFi Publik:**\n\n- Gunakan VPN perusahaan saat bekerja dari jaringan publik\n- Hindari mengakses sistem sensitif dari WiFi publik\n- Pastikan website menggunakan HTTPS (ada ikon gembok)\n- Matikan sharing file & printer saat di jaringan publik\n- Logout dari akun setelah selesai\n\n**Untuk Karyawan Tangcity:**\n\nJika perlu mengakses sistem internal dari luar kantor, gunakan VPN yang telah disediakan oleh tim IT. Hubungi kami untuk info lebih lanjut.",
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($articles as $data) {
            Article::create(array_merge($data, [
                'slug' => Str::slug($data['title']),
            ]));
        }
    }
}
