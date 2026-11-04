<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\SalesProfile;
use App\Models\HeroSlider;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Promo;
use App\Models\NewsArticle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@byd-sales.com'],
            [
                'name' => 'Admin BYD Sales',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Default Settings (Logo, Favicon, OG Graph, Contact, Map, Socials)
        $settings = [
            'site_title' => 'BYD Sales Indonesia | Dealer Resmi Mobil Listrik BYD',
            'meta_description' => 'Website Resmi Sales Mobil Listrik BYD Indonesia. Informasi spesifikasi, harga OTR terbaru, promo DP ringan, bunga 0%, dan booking test drive BYD Seal, Atto 3, Dolphin & M6.',
            'meta_keywords' => 'BYD, BYD Indonesia, Mobil Listrik BYD, Harga BYD Seal, BYD M6, BYD Atto 3, BYD Dolphin, Sales BYD Jakarta, Promo Mobil Listrik',
            'logo_path' => 'images/byd-logo.svg',
            'favicon_path' => 'images/favicon.svg',
            'og_image_path' => 'images/og-image.svg',
            'dealer_name' => 'BYD Arista BSD City & Jabodetabek',
            'dealer_tagline' => 'Official Authorized BYD EV Experience Center',
            'dealer_address' => 'Jl. BSD Grand Boulevard No. 8, BSD City, Tangerang Selatan, Banten 15339',
            'dealer_city' => 'Jabodetabek & Seluruh Indonesia',
            'dealer_phone' => '+62 812-8899-7722',
            'dealer_whatsapp' => '6281288997722',
            'dealer_email' => 'sales@byd-arista.co.id',
            'opening_hours' => 'Senin - Minggu: 08.30 - 20.00 WIB (Showroom & Test Drive)',
            'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.736691456187!2d106.643322!3d-6.301389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb7a28e93231%3A0xa615f8d68962ffaa!2sBSD%20City!5e0!3m2!1sid!2sid!4v1700000000000',
            'maps_link' => 'https://maps.google.com/?q=BSD+City+Tangerang',
            'social_instagram' => 'https://instagram.com/byd.sales.official',
            'social_facebook' => 'https://facebook.com/byd.indonesia',
            'social_tiktok' => 'https://tiktok.com/@byd.indonesia',
            'social_youtube' => 'https://youtube.com/@bydindonesia',
            'free_service_years' => '4 Tahun / 60.000 KM Free Jasa & Spareparts',
            'battery_warranty' => '8 Tahun / 160.000 KM Garansi Resmi Blade Battery',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 3. Sales Profile
        SalesProfile::updateOrCreate(
            ['phone' => '+62 812-8899-7722'],
            [
                'name' => 'Dimas Arya Pratama, S.T.',
                'title' => 'Senior EV Consultant & Certified Master Sales',
                'branch' => 'BYD Arista BSD Experience Center',
                'photo' => 'images/sales/sales-consultant.svg',
                'whatsapp' => '6281288997722',
                'email' => 'dimas.byd@gmail.com',
                'bio' => 'Senang membantu Anda memilih mobil listrik BYD terbaik yang sesuai dengan gaya hidup dan kebutuhan keluarga Anda. Berpengalaman 6+ tahun dalam otomotif premium dan siap melayani test drive langsung ke rumah atau kantor Anda di Jabodetabek & sekitarnya.',
                'experience_years' => 6,
                'units_sold' => 240,
                'rating' => '4.9/5.0',
                'badge' => 'Top 1 Sales BYD Jabodetabek 2024',
                'is_active' => true,
            ]
        );

        // 4. Hero Sliders
        $sliders = [
            [
                'title' => 'THE POWER OF OCEAN AESTHETICS',
                'subtitle' => 'Rasakan sensasi akselerasi 0-100 km/h dalam 3.8 detik dengan BYD SEAL. Sedan sport listrik mewah dengan teknologi Cell-to-Body (CTB) terdepan.',
                'badge' => 'FLAGSHIP PERFORMANCE SEDAN',
                'image' => 'images/sliders/slider-seal.svg',
                'button_text' => 'Eksplorasi BYD SEAL',
                'button_link' => '#cars',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'BYD M6 ELEKTRIK 7-SEATER RESMI HADIR',
                'subtitle' => 'MPV listrik keluarga paling dinantikan di Indonesia. Kabin super lapang, baterai Blade 530 km, dan kenyamanan Captain Seat premium.',
                'badge' => 'THE FIRST ELECTRIC FAMILY MPV',
                'image' => 'images/sliders/slider-m6.svg',
                'button_text' => 'Lihat Tipe & Harga M6',
                'button_link' => '#cars',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'PROMO SPESIAL DEALER RESMI BULAN INI',
                'subtitle' => 'Dapatkan penawaran istimewa DP mulai 10%, Bunga Ringan 0%, Free 7kW Wallbox Charger + Instalasi PLN resmi ke rumah.',
                'badge' => 'LIMITED TIME OFFER 2025',
                'image' => 'images/sliders/slider-promo.svg',
                'button_text' => 'Klaim Promo Sekarang',
                'button_link' => '#promos',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $sliderData) {
            HeroSlider::updateOrCreate(['title' => $sliderData['title']], $sliderData);
        }

        // 5. Car Models and Child Types
        $models = [
            [
                'name' => 'BYD Seal',
                'slug' => 'byd-seal',
                'category' => 'Sedan',
                'tagline' => 'Luxury High-Performance Ocean EV Sedan',
                'starting_price' => 629000000,
                'image' => 'images/cars/byd-seal.svg',
                'brochure_file' => 'brochures/brochure-byd-seal.pdf',
                'range_km' => '570 - 650 km',
                'acceleration' => '3.8 detik (0-100 km/h)',
                'battery_type' => 'BYD Blade Battery (Cell-to-Body)',
                'battery_capacity' => '82.56 kWh',
                'max_power' => '530 PS (AWD) / 670 Nm',
                'charging_time' => 'DC 150kW (30-80% dlm 26 menit)',
                'description' => 'BYD Seal menggabungkan aerodinamika kelas dunia (Cd 0.219) dengan performa brutal dua motor listrik AWD. Dilengkapi panoramic glass roof, 15.6 inch rotating touchscreen, head-up display, dan interior kulit premium.',
                'features' => [
                    'Cell-to-Body (CTB) Structural Technology',
                    'Akselerasi 0-100 km/h hanya 3.8 Detik',
                    'Dynaudio 12-Speaker High Fidelity Audio',
                    'Rotatable 15.6" Intelligent Touchscreen',
                    'Advanced Driver Assistance System (ADAS) Level 2',
                    'Crystal Gearshift Knob & Ventilated Seats',
                ],
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
                'types' => [
                    [
                        'name' => 'Premium Extended Range (RWD)',
                        'price' => 629000000,
                        'range_km' => '650 km (NEDC)',
                        'battery_capacity' => '82.56 kWh',
                        'drivetrain' => 'RWD (Rear-Wheel Drive)',
                        'power' => '313 PS / 360 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Jarak tempuh terjauh 650 km, akselerasi 0-100 km/h dalam 5.9s, interior kulit premium, panoramic roof.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Performance AWD (Dual Motor)',
                        'price' => 719000000,
                        'range_km' => '580 km (NEDC)',
                        'battery_capacity' => '82.56 kWh',
                        'drivetrain' => 'Dual Motor AWD (All-Wheel Drive)',
                        'power' => '530 PS / 670 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Akselerasi super car 3.8s, Intelligent Torque Adaption Control (iTAC), suspensi adaptif frekuensi.',
                        'order' => 2,
                    ],
                ]
            ],
            [
                'name' => 'BYD Atto 3',
                'slug' => 'byd-atto-3',
                'category' => 'SUV',
                'tagline' => 'Energetic & Versatile All-Electric SUV',
                'starting_price' => 515000000,
                'image' => 'images/cars/byd-atto3.svg',
                'brochure_file' => 'brochures/brochure-byd-atto3.pdf',
                'range_km' => '410 - 480 km',
                'acceleration' => '7.3 detik (0-100 km/h)',
                'battery_type' => 'BYD Blade Battery Ultra Safe',
                'battery_capacity' => '60.48 kWh',
                'max_power' => '204 PS / 310 Nm',
                'charging_time' => 'DC 88kW (30-80% dlm 29 menit)',
                'description' => 'BYD Atto 3 menghadirkan desain SUV futuristik bertema gym & kebugaran dengan door string ala senar gitar bass, ventilasi AC treadmill, serta kabin ergonomis yang lapang untuk keluarga aktif.',
                'features' => [
                    'e-Platform 3.0 Platform Khusus EV Murni',
                    'Electric Sunroof Panoramic Otomatis',
                    'Kamera 360 Derajat Holographic Transparent',
                    'V2L (Vehicle-to-Load) 2.2kW Power Generator',
                    'Wireless Phone Charging & Apple CarPlay / Android Auto',
                    '7 Airbags & 5-Star Euro NCAP Safety Rating',
                ],
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
                'types' => [
                    [
                        'name' => 'Advanced Standard Range',
                        'price' => 465000000,
                        'range_km' => '410 km (NEDC)',
                        'battery_capacity' => '49.92 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '204 PS / 310 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Pilihan cerdas dan ekonomis untuk penggunaan dalam kota & komuter harian.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Superior Extended Range',
                        'price' => 515000000,
                        'range_km' => '480 km (NEDC)',
                        'battery_capacity' => '60.48 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '204 PS / 310 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Baterai kapasitas besar 60.48 kWh, panoramic sunroof, power tailgate, audio 8 speaker.',
                        'order' => 2,
                    ],
                ]
            ],
            [
                'name' => 'BYD Dolphin',
                'slug' => 'byd-dolphin',
                'category' => 'Hatchback',
                'tagline' => 'Fun, Agile & Smart Urban Hatchback',
                'starting_price' => 365000000,
                'image' => 'images/cars/byd-dolphin.svg',
                'brochure_file' => 'brochures/brochure-byd-dolphin.pdf',
                'range_km' => '410 - 490 km',
                'acceleration' => '7.0 detik (0-100 km/h)',
                'battery_type' => 'BYD Blade Battery LFP',
                'battery_capacity' => '60.48 kWh',
                'max_power' => '204 PS / 310 Nm',
                'charging_time' => 'DC 80kW (30-80% dlm 30 menit)',
                'description' => 'Hatchback listrik kompak paling lincah dan berfitur lengkap di kelasnya. Desain aerodinamis terinspirasi gerakan lumba-lumba di lautan, ruang kaki belakang datar super lega, dan konsumsi energi sangat irit.',
                'features' => [
                    'Kabin Luas dengan Flat Floor Technology',
                    'Layar Sentuh 12.8" Elektrik Berputar',
                    'NFC Card Keyless Entry & Start',
                    'ADAS Lengkap (ACC, AEB, LKA, BSD)',
                    'Suspensi Belakang Multi-Link (Tipe Extended)',
                    'Garansi Komponen EV hingga 8 Tahun',
                ],
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
                'types' => [
                    [
                        'name' => 'Dynamic Standard Range',
                        'price' => 365000000,
                        'range_km' => '410 km (NEDC)',
                        'battery_capacity' => '44.9 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '95 PS / 180 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Paling terjangkau, akselerasi mulus, sempurna untuk mobilitas perkotaan.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Premium Extended Range',
                        'price' => 425000000,
                        'range_km' => '490 km (NEDC)',
                        'battery_capacity' => '60.48 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '204 PS / 310 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Tenaga dahsyat 204 PS, 0-100 km/h dlm 7 detik, panoramic roof kaca, velg 17 inch.',
                        'order' => 2,
                    ],
                ]
            ],
            [
                'name' => 'BYD M6',
                'slug' => 'byd-m6',
                'category' => 'MPV',
                'tagline' => 'Spacious & Sophisticated Electric Family MPV',
                'starting_price' => 379000000,
                'image' => 'images/cars/byd-m6.svg',
                'brochure_file' => 'brochures/brochure-byd-m6.pdf',
                'range_km' => '420 - 530 km',
                'acceleration' => '8.6 detik (0-100 km/h)',
                'battery_type' => 'BYD Blade Battery Long Life',
                'battery_capacity' => '71.8 kWh',
                'max_power' => '204 PS / 310 Nm',
                'charging_time' => 'DC 115kW (30-80% dlm 30 menit)',
                'description' => 'Jawaban bagi keluarga Indonesia yang menginginkan MPV listrik murni sejati. Pilihan kapasitas 7-penumpang atau 6-penumpang Captain Seat super nyaman, bagasi luas, dan jarak tempuh Jakarta-Semarang tanpa perlu cas.',
                'features' => [
                    'Kapasitas 7-Seater / 6-Seater Captain Seat',
                    'Baterai Blade 71.8 kWh Jarak Tempuh 530 km',
                    'Panoramic Sunroof dengan Electric Shade',
                    'AC Digital Dual Zone dengan Kisi AC Tiap Baris',
                    'Fitur Vehicle-to-Load (V2L) untuk Berkemah / Listrik Rumah',
                    'Kamera 360 HD & Sensor Parkir Depan Belakang',
                ],
                'order' => 4,
                'is_featured' => true,
                'is_active' => true,
                'types' => [
                    [
                        'name' => 'Standard 7-Seater',
                        'price' => 379000000,
                        'range_km' => '420 km (NEDC)',
                        'battery_capacity' => '55.4 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '163 PS / 310 Nm',
                        'seats' => '7-Seater Bench',
                        'highlights' => 'Paling terjangkau untuk keluarga, kabin 3 baris lega, efisiensi energi jempolan.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Superior 7-Seater',
                        'price' => 419000000,
                        'range_km' => '530 km (NEDC)',
                        'battery_capacity' => '71.8 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '204 PS / 310 Nm',
                        'seats' => '7-Seater Bench',
                        'highlights' => 'Baterai 71.8 kWh tembus 530 km, tenaga 204 PS, panoramic sunroof, power tailgate.',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Superior Captain 6-Seater',
                        'price' => 429000000,
                        'range_km' => '530 km (NEDC)',
                        'battery_capacity' => '71.8 kWh',
                        'drivetrain' => 'FWD',
                        'power' => '204 PS / 310 Nm',
                        'seats' => '6-Seater (Captain Seat)',
                        'highlights' => 'Kemewahan kursi baris kedua Captain Seat dengan armrest individu dan lorong tengah luas.',
                        'order' => 3,
                    ],
                ]
            ],
            [
                'name' => 'BYD Sealion 7',
                'slug' => 'byd-sealion-7',
                'category' => 'SUV',
                'tagline' => 'Next-Gen Fastback Performance Electric SUV',
                'starting_price' => 649000000,
                'image' => 'images/cars/byd-sealion7.svg',
                'brochure_file' => 'brochures/brochure-byd-sealion7.pdf',
                'range_km' => '502 - 550 km',
                'acceleration' => '4.5 detik (0-100 km/h)',
                'battery_type' => 'BYD Blade Battery 82.5 kWh',
                'battery_capacity' => '82.5 kWh',
                'max_power' => '530 PS / 690 Nm',
                'charging_time' => 'DC 230kW Ultra Fast Charging (10-80% dlm 25 menit)',
                'description' => 'SUV Coupé listrik berteknologi termutakhir dengan platform e-Platform 3.0 Evo. Menawarkan pengisian daya super cepat hingga 230 kW dan akselerasi instan bertenaga 530 PS.',
                'features' => [
                    'e-Platform 3.0 Evo dengan Arsitektur 800V',
                    'Ultra Fast DC Charging hingga 230 kW',
                    'Akselerasi 0-100 km/h dlm 4.5 Detik',
                    'Desain Sport Coupé Aerodinamis Modern',
                    'DiPilot 100 Intelligent Driving Assistance',
                    'Kapasitas Bagasi Fleksibel hingga 1.769 Liter',
                ],
                'order' => 5,
                'is_featured' => true,
                'is_active' => true,
                'types' => [
                    [
                        'name' => 'Premium RWD',
                        'price' => 649000000,
                        'range_km' => '550 km (WLTP)',
                        'battery_capacity' => '82.5 kWh',
                        'drivetrain' => 'RWD',
                        'power' => '313 PS / 380 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Jarak tempuh optimal 550 km, arsitektur kelistrikan 800V super cepat.',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Performance AWD',
                        'price' => 739000000,
                        'range_km' => '502 km (WLTP)',
                        'battery_capacity' => '82.5 kWh',
                        'drivetrain' => 'Dual Motor AWD',
                        'power' => '530 PS / 690 Nm',
                        'seats' => '5-Seater',
                        'highlights' => 'Tenaga buas 530 PS, suspensi adaptif pintar FSD, interior Nappa leather.',
                        'order' => 2,
                    ],
                ]
            ],
        ];

        foreach ($models as $modelData) {
            $types = $modelData['types'];
            unset($modelData['types']);

            $carModel = CarModel::updateOrCreate(
                ['slug' => $modelData['slug']],
                $modelData
            );

            foreach ($types as $typeData) {
                CarType::updateOrCreate(
                    [
                        'car_model_id' => $carModel->id,
                        'name' => $typeData['name'],
                    ],
                    $typeData
                );
            }
        }

        // 6. Promos
        $promos = [
            [
                'title' => 'Program Bunga 0% & DP Ringan Mulai 10%',
                'slug' => 'promo-bunga-0-persen',
                'badge' => 'SPECIAL FINANCING',
                'image' => 'images/promos/promo-bunga-nol.svg',
                'summary' => 'Dapatkan kemudahan kepemilikan mobil listrik BYD dengan opsi DP ringan 10% atau paket bunga 0% hingga 2 tahun melalui leasing rekanan resmi terpercaya.',
                'terms' => "1. Berlaku untuk pemesanan (SPK) selama bulan ini.\n2. Berlaku untuk seluruh tipe BYD Seal, Atto 3, Dolphin, dan M6.\n3. Syarat dan ketentuan kredit disetujui oleh leasing rekanan (Maybank, BCA Finance, Mandiri Tunas Finance, dll).\n4. Bebas biaya provisi untuk paket tertentu.",
                'valid_until' => now()->addDays(45)->toDateString(),
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Free 7kW Wallbox Charger + Gratis Pemasangan Resmi',
                'slug' => 'free-wallbox-charger-instalasi',
                'badge' => 'FREE EV CHARGER',
                'image' => 'images/promos/promo-wallbox.svg',
                'summary' => 'Setiap pembelian unit BYD berhak mendapatkan perangkat home charger Wallbox 7kW original BYD beserta instalasi kabel dan sertifikasi teknisi PLN resmi.',
                'terms' => "1. Sudah termasuk kabel instalasi hingga 15 meter.\n2. Termasuk MCB pengaman dan grounding standar internasional.\n3. Tambahan bonus portable charger 2.2kW untuk bepergian jauh.",
                'valid_until' => now()->addDays(60)->toDateString(),
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Program Trade-In Subsidi Cashback Ekstra Rp 15 Juta',
                'slug' => 'program-trade-in-cashback-ekstra',
                'badge' => 'TRADE-IN BONUS',
                'image' => 'images/promos/promo-bunga-nol.svg',
                'summary' => 'Tukar mobil lama segala merk (bensin, diesel, atau hybrid) ke mobil listrik BYD baru dengan taksiran harga tertinggi plus subsidi cashback langsung hingga Rp 15 Juta.',
                'terms' => "1. Appraisal unit mobil lama gratis di rumah atau showroom.\n2. Proses tukar tambah transparan dan cepat dalam hitungan jam.\n3. Dokumen BPKB & STNK mobil lama lengkap.",
                'valid_until' => now()->addDays(30)->toDateString(),
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promoData) {
            Promo::updateOrCreate(['slug' => $promoData['slug']], $promoData);
        }

        // 7. News & Articles
        $articles = [
            [
                'title' => 'BYD M6 Resmi Mengaspal di Indonesia: MPV Listrik Idaman Keluarga Modern',
                'slug' => 'byd-m6-resmi-mengaspal-di-indonesia',
                'category' => 'Peluncuran',
                'image' => 'images/news/news-m6.svg',
                'summary' => 'BYD Motor Indonesia resmi menghadirkan M6, MPV listrik pertama yang dirancang khusus untuk kenyamanan keluarga Indonesia dengan pilihan 7-seater dan captain seat.',
                'content' => "Kehadiran BYD M6 di pasar otomotif Tanah Air langsung menarik atensi luar biasa dari masyarakat. Sebagai medium MPV bertenaga listrik murni, BYD M6 memadukan kepraktisan mobil keluarga dengan efisiensi energi terdepan.\n\nDilengkapi dengan teknologi Blade Battery berkapasitas hingga 71.8 kWh, mobil ini mampu menempuh jarak hingga 530 km dalam sekali pengisian daya. Fitur kenyamanan seperti panoramic glass roof, ventilated front seats, wireless smartphone charger, dan suspensi yang disetel khusus untuk kontur jalan Indonesia menjadikan perjalanan jauh semakin berkesan.",
                'author' => 'Tim Redaksi Sales BYD',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Mengapa Blade Battery BYD Disebut Sebagai Baterai EV Paling Aman di Dunia?',
                'slug' => 'keunggulan-blade-battery-byd-paling-aman',
                'category' => 'Teknologi EV',
                'image' => 'images/news/news-battery.svg',
                'summary' => 'Mengenal inovasi baterai revolusioner BYD yang berhasil menaklukkan Nail Penetration Test tanpa api maupun ledakan, serta usia pakai hingga 1.200.000 KM.',
                'content' => "Salah satu kekhawatiran calon pembeli kendaraan listrik adalah keamanan termal baterai. BYD menjawab tantangan tersebut dengan menciptakan Blade Battery berbasis kimia Lithium Iron Phosphate (LFP).\n\nDalam pengujian ekstrem tusukan paku baja (Nail Penetration Test), suhu permukaan Blade Battery hanya berada di kisaran 30-60°C tanpa mengeluarkan asap tebal apalagi kobaran api. Selain sangat aman dari risiko kebakaran saat terjadi benturan keras, Blade Battery juga memiliki ketahanan degradasi luar biasa dengan siklus pengisian lebih dari 3.000 kali pengisian penuh.",
                'author' => 'Dimas Arya Pratama (Senior EV Consultant)',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Tips Merawat Baterai Mobil Listrik Agar Selalu Optimal & Awet Puluhan Tahun',
                'slug' => 'tips-merawat-baterai-mobil-listrik-optimal',
                'category' => 'Tips & Panduan',
                'image' => 'images/news/news-m6.svg',
                'summary' => 'Panduan praktis sehari-hari dari Senior Sales Consultant BYD untuk menjaga daya tahan baterai mobil listrik Anda tetap prima sepanjang masa pakai.',
                'content' => "Memiliki mobil listrik BYD sangat praktis karena minim perawatan rutin seperti ganti oli mesin, busi, atau filter bahan bakar. Namun demikian, memahami kebiasaan charging yang sehat akan membuat performa baterai Anda tetap prima hingga puluhan tahun.\n\n1. Gunakan AC Home Charger (Wallbox) untuk pengisian harian karena arusnya stabil dan menjaga suhu sel baterai tetap sejuk.\n2. Untuk kimia LFP Blade Battery, aman dan dianjurkan sesekali melakukan pengisian hingga 100% agar sistem BMS dapat melakukan kalibrasi sel secara akurat.\n3. Hindari membiarkan kendaraan dalam kondisi baterai 0% dalam jangka waktu berhari-hari saat ditinggal bepergian.",
                'author' => 'Dimas Arya Pratama (Senior EV Consultant)',
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($articles as $articleData) {
            NewsArticle::updateOrCreate(['slug' => $articleData['slug']], $articleData);
        }
    }
}
