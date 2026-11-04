<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Settings table for Logo, Favicon, OG Image, Dealer details, Maps
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Sales profile table
        Schema::create('sales_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->default('Senior BYD EV Specialist');
            $table->string('branch')->default('BYD Authorized Dealer');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->text('bio')->nullable();
            $table->integer('experience_years')->default(5);
            $table->integer('units_sold')->default(180);
            $table->string('rating')->default('4.9');
            $table->string('badge')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Hero Sliders table
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('badge')->nullable();
            $table->string('image');
            $table->string('button_text')->default('Konsultasi Sekarang');
            $table->string('button_link')->default('#contact');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Car Models table
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('EV'); // Sedan, SUV, MPV
            $table->string('tagline')->nullable();
            $table->unsignedBigInteger('starting_price')->default(0);
            $table->string('image');
            $table->string('brochure_file')->nullable();
            $table->string('range_km')->nullable();
            $table->string('acceleration')->nullable();
            $table->string('battery_type')->default('BYD Blade Battery (LFP)');
            $table->string('battery_capacity')->nullable();
            $table->string('max_power')->nullable();
            $table->string('charging_time')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Car Types / Trims table
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained('car_models')->onDelete('cascade');
            $table->string('name');
            $table->unsignedBigInteger('price')->default(0);
            $table->string('range_km')->nullable();
            $table->string('battery_capacity')->nullable();
            $table->string('drivetrain')->default('FWD'); // FWD, RWD, AWD
            $table->string('power')->nullable();
            $table->string('seats')->default('5-Seater');
            $table->text('highlights')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Promos table
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('badge')->nullable(); // Hot Deal, DP 10%, dsb
            $table->string('image')->nullable();
            $table->text('summary')->nullable();
            $table->text('terms')->nullable();
            $table->date('valid_until')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // News & Articles table
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Berita');
            $table->string('image')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('author')->default('BYD Sales Specialist');
            $table->boolean('is_published')->default(true);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });

        // Customer Inquiries & Test Drive Requests table
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->foreignId('car_model_id')->nullable()->constrained('car_models')->nullOnDelete();
            $table->string('inquiry_type')->default('test_drive'); // test_drive, promo, simulasi_kredit, umum
            $table->date('preferred_date')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('city')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('baru'); // baru, dihubungi, dijadwalkan, selesai, batal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('news_articles');
        Schema::dropIfExists('promos');
        Schema::dropIfExists('car_types');
        Schema::dropIfExists('car_models');
        Schema::dropIfExists('hero_sliders');
        Schema::dropIfExists('sales_profiles');
        Schema::dropIfExists('settings');
    }
};
