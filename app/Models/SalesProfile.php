<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'branch',
        'photo',
        'phone',
        'whatsapp',
        'email',
        'bio',
        'experience_years',
        'units_sold',
        'rating',
        'badge',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'experience_years' => 'integer',
        'units_sold' => 'integer',
    ];

    /**
     * Get clean WhatsApp URL with prefilled text
     */
    public function getWhatsappUrlAttribute(?string $customText = null): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp ?? $this->phone ?? '');
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $text = $customText ?: "Halo {$this->name}, saya tertarik dengan mobil BYD dan ingin informasi promo / test drive.";
        return "https://wa.me/{$phone}?text=" . urlencode($text);
    }
}
