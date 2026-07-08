<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@umsida.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@umsida.ac.id',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'user',
        ]);

        // 2. Membuat Kategori
        $katAdab = Category::create(['name' => 'Adab', 'slug' => 'adab']);
        $katTafsir = Category::create(['name' => 'Tafsir', 'slug' => 'tafsir']);
        $katBahasa = Category::create(['name' => 'Bahasa Arab', 'slug' => 'bahasa-arab']);
        $katFiqih = Category::create(['name' => 'Fiqih', 'slug' => 'fiqih']);

        // 3. Membuat Kursus dengan Gambar Background
        $courseAdab = Course::create([
            'category_id' => $katAdab->id, 'title' => 'Adab dan Akhlak', 'slug' => 'adab-dan-akhlak',
            'description' => 'Mempelajari tata krama dan etika keseharian seorang muslim.',
            'image' => 'https://images.unsplash.com/photo-1585036156171-384164a8c675?q=80&w=600&auto=format&fit=crop',
        ]);

        $courseTafsir = Course::create([
            'category_id' => $katTafsir->id, 'title' => 'Tafsir Al-Qur\'an', 'slug' => 'tafsir-al-quran',
            'description' => 'Kajian mendalam tentang makna dan kandungan ayat-ayat suci.',
            'image' => 'https://images.unsplash.com/photo-1600174297956-c6d4d9998f14?q=80&w=600&auto=format&fit=crop',
        ]);

        $courseBahasa = Course::create([
            'category_id' => $katBahasa->id, 'title' => 'Bahasa Arab Dasar', 'slug' => 'bahasa-arab-dasar',
            'description' => 'Pengenalan tata bahasa dasar (Nahwu & Shorof) dan kosakata.',
            'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?q=80&w=600&auto=format&fit=crop',
        ]);

        $courseFiqih = Course::create([
            'category_id' => $katFiqih->id, 'title' => 'Fiqih Muamalah', 'slug' => 'fiqih-muamalah',
            'description' => 'Aturan-aturan Allah yang mengatur hubungan antar manusia dalam urusan duniawi.',
            'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=600&auto=format&fit=crop',
        ]);

        // 4. Mengisi Materi Lengkap
        Module::create([
            'course_id' => $courseAdab->id, 'title' => 'Adab Menuntut Ilmu',
            'content' => '<p class="mb-4">Menuntut ilmu adalah kewajiban bagi setiap muslim. Adab yang pertama dan paling utama adalah mengikhlaskan niat semata-mata karena Allah SWT, bukan untuk mencari kedudukan di dunia.</p><h3 class="text-xl font-bold mt-6 mb-2 text-gray-900">Keutamaan Penuntut Ilmu</h3><p class="mb-4">Allah akan meninggikan derajat orang-orang yang berilmu. Bahkan para malaikat membentangkan sayap-sayapnya karena ridha terhadap apa yang dicari oleh para penuntut ilmu.</p>',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'order' => 1
        ]);
        Module::create(['course_id' => $courseAdab->id, 'title' => 'Adab Kepada Orang Tua', 'content' => '<p>Berbakti kepada orang tua (Birrul Walidain) adalah amalan yang sangat dicintai Allah...</p>', 'order' => 2]);
        Module::create(['course_id' => $courseAdab->id, 'title' => 'Adab Berbicara', 'content' => '<p>Seorang muslim diwajibkan untuk berkata yang baik atau diam...</p>', 'order' => 3]);

        Module::create([
            'course_id' => $courseTafsir->id, 'title' => 'Pengantar Ilmu Tafsir',
            'content' => '<p class="mb-4">Ilmu tafsir adalah disiplin ilmu untuk memahami kitab Allah yang diturunkan kepada Nabi Muhammad SAW, menjelaskan makna-maknanya, serta mengeluarkan hukum dan hikmahnya.</p><h3 class="text-xl font-bold mt-6 mb-2 text-gray-900">Tujuan Mempelajari Tafsir</h3><p class="mb-4">Tujuan utamanya adalah untuk mencapai pemahaman yang lurus terhadap ayat suci Al-Qur\'an, sehingga kita dapat mengamalkan petunjuk-Nya dalam kehidupan sehari-hari secara tepat.</p>',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'order' => 1
        ]);
        Module::create(['course_id' => $courseTafsir->id, 'title' => 'Tafsir Surah Al-Fatihah', 'content' => '<p>Al-Fatihah disebut juga Ummul Qur\'an. Surah ini merupakan rukun dalam salat...</p>', 'order' => 2]);
        Module::create(['course_id' => $courseTafsir->id, 'title' => 'Tafsir Ayat Kursi', 'content' => '<p>Ayat Kursi (Al-Baqarah: 255) adalah ayat paling agung di dalam Al-Qur\'an...</p>', 'order' => 3]);

        Module::create([
            'course_id' => $courseBahasa->id, 'title' => 'Pengenalan Huruf & Harakat',
            'content' => '<p class="mb-4">Bahasa Arab adalah bahasa Al-Qur\'an. Langkah pertama dalam mempelajarinya adalah mengenal 28 huruf Hijaiyah beserta tempat keluarnya suara (makharijul huruf) yang benar.</p><h3 class="text-xl font-bold mt-6 mb-2 text-gray-900">Pentingnya Tanda Baca</h3><p class="mb-4">Harakat seperti Fathah, Kasrah, dan Dhammah berfungsi sebagai vokal. Kesalahan kecil dalam membaca harakat dapat mengubah makna sebuah kata secara fatal dalam tata bahasa Arab.</p>',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'order' => 1
        ]);
        Module::create(['course_id' => $courseBahasa->id, 'title' => 'Isim, Fi\'il, dan Huruf', 'content' => '<p>Dalam tata bahasa Arab dasar, kata dibagi menjadi tiga golongan: Isim, Fi\'il, dan Huruf...</p>', 'order' => 2]);
        Module::create(['course_id' => $courseBahasa->id, 'title' => 'Praktek Percakapan', 'content' => '<p>Mari mempraktikkan percakapan dasar seperti menanyakan nama dan kabar...</p>', 'order' => 3]);

        Module::create([
            'course_id' => $courseFiqih->id, 'title' => 'Pengantar Muamalah',
            'content' => '<p class="mb-4">Muamalah secara bahasa bermakna saling bertindak, saling berbuat, atau saling mengamalkan. Dalam konteks syariat Islam, muamalah merujuk pada aturan-aturan Allah yang mengatur hubungan antar manusia dalam urusan duniawi, khususnya dalam bidang ekonomi dan sosial.</p><h3 class="text-xl font-bold mt-6 mb-2 text-gray-900">Pentingnya Memahami Fiqh Muamalah</h3><p class="mb-4">Memahami hukum-hukum muamalah adalah sebuah keharusan bagi setiap muslim yang berinteraksi dalam pasar atau melakukan transaksi keuangan.</p>',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 'order' => 1
        ]);
        Module::create(['course_id' => $courseFiqih->id, 'title' => 'Rukun-rukun Akad', 'content' => '<p>Rukun akad terdiri dari: 1) Pihak yang berakad, 2) Objek akad, 3) Sighat (Ijab Kabul)...</p>', 'order' => 2]);
        Module::create(['course_id' => $courseFiqih->id, 'title' => 'Syarat Sah Transaksi', 'content' => '<p>Syarat sah transaksi meliputi kerelaan kedua belah pihak dan objek yang halal...</p>', 'order' => 3]);

        // 5. Membuat Bank Soal Kuis untuk SEMUA Modul Pertama
        $modAdab = Module::where('title', 'Adab Menuntut Ilmu')->first();
        if ($modAdab) {
            \App\Models\Question::insert([
                ['module_id' => $modAdab->id, 'question_text' => 'Apa niat utama dalam menuntut ilmu?', 'option_a' => 'Mencari kekayaan', 'option_b' => 'Mendapat pujian', 'option_c' => 'Mencari ridha Allah', 'option_d' => 'Menjadi populer', 'correct_answer' => 'c'],
                ['module_id' => $modAdab->id, 'question_text' => 'Bagaimana sikap malaikat terhadap penuntut ilmu?', 'option_a' => 'Biasa saja', 'option_b' => 'Membentangkan sayapnya karena ridha', 'option_c' => 'Menjauhinya', 'option_d' => 'Mencatat sebagai dosa', 'correct_answer' => 'b'],
                ['module_id' => $modAdab->id, 'question_text' => 'Hukum menuntut ilmu bagi seorang muslim adalah...', 'option_a' => 'Sunnah', 'option_b' => 'Wajib', 'option_c' => 'Mubah', 'option_d' => 'Makruh', 'correct_answer' => 'b'],
            ]);
        }

        $modTafsir = Module::where('title', 'Pengantar Ilmu Tafsir')->first();
        if ($modTafsir) {
            \App\Models\Question::insert([
                ['module_id' => $modTafsir->id, 'question_text' => 'Tujuan utama mempelajari ilmu tafsir adalah...', 'option_a' => 'Mendapat gelar', 'option_b' => 'Memahami makna ayat dengan lurus', 'option_c' => 'Bisa membaca dengan cepat', 'option_d' => 'Menghafal tanpa paham', 'correct_answer' => 'b'],
                ['module_id' => $modTafsir->id, 'question_text' => 'Al-Fatihah sering juga disebut sebagai...', 'option_a' => 'Ummul Qur\'an', 'option_b' => 'Ayat Kursi', 'option_c' => 'As-Sunnah', 'option_d' => 'Al-Hadits', 'correct_answer' => 'a'],
                ['module_id' => $modTafsir->id, 'question_text' => 'Ilmu tafsir menjelaskan makna yang diturunkan kepada...', 'option_a' => 'Nabi Musa', 'option_b' => 'Nabi Isa', 'option_c' => 'Nabi Muhammad SAW', 'option_d' => 'Nabi Ibrahim', 'correct_answer' => 'c'],
            ]);
        }

        $modBahasa = Module::where('title', 'Pengenalan Huruf & Harakat')->first();
        if ($modBahasa) {
            \App\Models\Question::insert([
                ['module_id' => $modBahasa->id, 'question_text' => 'Berapa jumlah standar huruf Hijaiyah?', 'option_a' => '26', 'option_b' => '28', 'option_c' => '30', 'option_d' => '25', 'correct_answer' => 'b'],
                ['module_id' => $modBahasa->id, 'question_text' => 'Tanda baca yang menghasilkan bunyi vokal "a" disebut...', 'option_a' => 'Kasrah', 'option_b' => 'Dhammah', 'option_c' => 'Sukun', 'option_d' => 'Fathah', 'correct_answer' => 'd'],
                ['module_id' => $modBahasa->id, 'question_text' => 'Tempat keluarnya suara huruf disebut...', 'option_a' => 'Makharijul Huruf', 'option_b' => 'Tajwid', 'option_c' => 'Nahwu', 'option_d' => 'Shorof', 'correct_answer' => 'a'],
            ]);
        }

        $modFiqih = Module::where('title', 'Pengantar Muamalah')->first();
        if ($modFiqih) {
            \App\Models\Question::insert([
                ['module_id' => $modFiqih->id, 'question_text' => 'Apa makna muamalah secara bahasa?', 'option_a' => 'Beribadah di masjid', 'option_b' => 'Saling bertindak atau berbuat', 'option_c' => 'Menahan hawa nafsu', 'option_d' => 'Mengeluarkan zakat', 'correct_answer' => 'b'],
                ['module_id' => $modFiqih->id, 'question_text' => 'Tujuan utama memahami Fiqih Muamalah adalah...', 'option_a' => 'Mendapat keuntungan besar', 'option_b' => 'Memastikan harta halal dan thayyib', 'option_c' => 'Menjadi pedagang sukses', 'option_d' => 'Menghindari pajak', 'correct_answer' => 'b'],
                ['module_id' => $modFiqih->id, 'question_text' => 'Muamalah secara khusus mengatur hubungan manusia dalam bidang...', 'option_a' => 'Akidah', 'option_b' => 'Akhlak', 'option_c' => 'Ekonomi dan Sosial', 'option_d' => 'Ibadah Mahdhah', 'correct_answer' => 'c'],
            ]);
        }
    }
}