<?php

namespace Database\Seeders;

use App\Models\Association;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        User::factory(1)->create();

        Association::insert([
            'name' => 'Pengarah Urusan Bagan Anika Sdn Bhd',
            'address' => 'Lot 8173 Jalan Selasih 2 Taman Kemas',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Fastulin (M) Sdn Bhd',
            'address' => '53-03 Jalan Susur Larkin Perdana 1 Larkin Perdana',
            'zip' => '80350',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan KCJB Trading Sdn Bhd',
            'address' => 'No 6-01 Jalan Perkasa 2/18 Taman Tampoi Utama',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Konsortium Pengangkutan Johor Melayu Sdn Bhd',
            'address' => '47-02 Susur Larkin Perdana 1 Larkin Perdana',
            'zip' => '80350',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Masan Auto Sdn Bhd',
            'address' => '58 Jalan Sutera Taman Sentosa',
            'zip' => '80150',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Sawari Sdn Bhd',
            'address' => 'No 69-02 Jalan Ros Mekah 213 Taman Johor Jaya',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Superbok Sdn Bhd',
            'address' => '38 Jalan Saksama Larkin Garden',
            'zip' => '80350',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Kebajikan Pemandu-Pemandu Dan Tuan-Tuan Punya Teksi/Kereta Sewa Masai',
            'phone' => '07-2520158',
            'address' => 'Perhentian Teksi/Kereta Sewa, Masai',
            'zip' => '81750',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Kebajikan Pemandu-Pemandu Kereta Sewa Sinar Larkin',
            'phone' => '07-2234494',
            'address' => 'TT 01-02 Aras Bawah Terminal Pengangkutan Awam Larkin, Jalan Geroda',
            'zip' => '80350',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Kebajikan Pengusaha Teksi Bumiputera Bandaraya Johor Bahru',
            'phone' => '07-3342227',
            'address' => 'No 8 Jalan Kemboja, Kampong Dato’ Suleiman Menteri',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Pemandu Dan Tuan Punya Kereta Sewa Dan Teksi Felda Ulu Tebrau Dan Ladang Ulu Tiram',
            'phone' => '07-8613350',
            'address' => 'No A3 Tingkat Bawah, Terminal Bas Dan Kereta Sewa, Jalan Duku',
            'zip' => '81800',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Pemandu-Pemandu Kenderaan Johor Bahru',
            'address' => 'No 30A Jalan Segget',
            'zip' => '8000',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Pemilik Dan Pemandu Teksi Cab Majlis Bandaraya Johor Bahru Dan Ke Singapura',
            'address' => 'No 42-01 Jalan Padi Ria 13, Bandar Baru Uda',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Teksi Dan Kereta Sewa India Johor',
            'address' => 'No 10 Jalan Cendana 21, Taman Rinting, Masai',
            'zip' => '81750',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Tuan Punya Dan Pemandu Teksi Perbandaran Johor Bahru Tengah',
            'phone' => '07-5563835',
            'address' => 'No 4 Jalan Bayan, Perhentian Teksi Bandar Masai',
            'zip' => '81750',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Perstuan Tuan-Tuan Punya Teksi & Kereta Sewa Perjalanan Jauh Antara Bandar Ke Bandar Johor Bahru',
            'address' => 'No 10 Tingkat 9, Blok C, Jalan Lumba Kuda',
            'zip' => '803300',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Tuan Punya Dan Pemandu-Pemandu Teksi Bandar Baru Tampoi',
            'address' => 'No 74A Jalan Sri Bahagia 5, Taman Sri Bahagia',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Tuan-Tuan Punya Kereta Sewa & Teksi Johor Bahru',
            'address' => 'No 11 Jalan Kenangan Majidee',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Tuan punya Dan Pemandu Kereta Sewa Daerah Kulai',
            'address' => 'No 192 Jalan Serunai Satu, Taman Sri Kulai Baru Dua, Kulai',
            'zip' => '81000',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Tuan Punya Dan Pemandu Teksi/Kereta Sewa Kulai',
            'phone' => '07-5999517',
            'address' => 'Kaunter Teksi, Jalan Belimbing Senai',
            'zip' => '81400',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Pemandu-Pemandu Teksi Pasir Gudang',
            'phone' => '07-2515218',
            'address' => 'No 33 Jalan 9/15, Perumahan Narrow Width, Pasir Gudang',
            'zip' => '81700',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Teksi, Kereta Sewa Dan Radio Teksi Johor (Johor Taxi, Hire Car & Radio Taxi Association)',
            'phone' => '07-3543995',
            'address' => 'No 54 Jalan Pinang 23, Taman Daya',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Pengusaha Teksi Bandaraya Johor Bahru',
            'address' => 'No 6-01, Jalan Perkasa 2/18, Taman Tampoi Utama',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Pemandu-Pemandu Kereta Sewa & Teksi Kawasan Majlis Daerah Johor Bahru Tengah Bandaraya Johor Bahru',
            'phone' => '07-5563835',
            'address' => 'No 26B Bangunan Rafeah, Batu 6, Jalan Skudai',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
//            'contact_person' => 'En. Omar B. Hj Din',
//            'contact_mobile' => '0167539611',
        ]);

        Association::insert([
            'name' => 'Persatuan Pemandu Teksi Syarikat-Syarikat Teksi Berdaftar Bandaraya Johor Bahru',
            'address' => '703 Lorong 1/2, Taman Saujana Masai',
            'zip' => '81750',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Persatuan Kebajikan Tuan Punya Dan Pemandu Teksi Dan Kereta Sewa Lapangan Terbang Sultan Ismail',
            'phone' => '07-5982437',
            'address' => 'Tingkat 1, Bangunan Jabatan Penerbangan Awam, Lapangan Terbang Sultan Ismail, Senai',
            'zip' => '81400',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
//            'fax' => '07-5982437',
        ]);

        Association::insert([
            'name' => 'Persatuan Kebajikan Pemandu Teksi Taman Daya Zon Timur, Johor Bahru',
            'address' => '115 Jalan Pinang 3, Taman Daya',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Syarikat Roda Tambak Berhad',
            'address' => 'No 10-03 Susur Larkin Perdana',
            'zip' => '80350',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Sunlight City Radio Cab Sdn Bhd',
            'address' => 'No 2A Jalan Lembah 2 Taman Desa Jaya',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Perkhidmatan Teksi JB-Singapura Berhad',
            'address' => '45-01 Jalan Persiaran Tanjung Susur 1 Taman Bukit Alif',
            'zip' => '81200',
            'city' => 'Tampoi Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Lombok Group Sdn Bhd',
            'address' => '230 Bangunan Kerjasama Jalan Dhobi',
            'zip' => '80000',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan KCM Nominees Sdn Bhd',
            'address' => 'No 2A Jalan Lembah 2 Taman Desa Jaya',
            'zip' => '81100',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Intan Nirwana Sdn Bhd',
            'address' => 'No 42-01 Jln Padi Ria, 13 Bandar Baru Uda',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Farajaya Sdn Bhd',
            'address' => 'No 6-01 Jalan Perkasa 2/18 Taman Tampoi Utama',
            'zip' => '81200',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

        Association::insert([
            'name' => 'Pengarah Urusan Aman Cab Sdn Bhd',
            'address' => '3A Jalan Sagu 3, Taman Daya',
            'zip' => '81000',
            'city' => 'Johor Bahru',
            'country' => 'Malaysia',
        ]);

    }
}
