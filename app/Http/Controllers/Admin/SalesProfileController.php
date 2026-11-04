<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesProfile;
use Illuminate\Http\Request;

class SalesProfileController extends Controller
{
    public function edit()
    {
        $sales = SalesProfile::firstOrCreate([], [
            'name' => 'Dimas Arya Pratama, S.T.',
            'title' => 'Senior EV Consultant & Certified Master Sales',
            'branch' => 'BYD Arista BSD Experience Center',
            'phone' => '+62 812-8899-7722',
            'whatsapp' => '6281288997722',
            'email' => 'sales@byd-arista.co.id',
            'photo' => 'images/sales/sales-consultant.svg',
            'experience_years' => 6,
            'units_sold' => 240,
            'rating' => '4.9',
            'badge' => 'Top 1 Sales BYD Jabodetabek',
            'is_active' => true,
        ]);

        return view('admin.sales.edit', compact('sales'));
    }

    public function update(Request $request)
    {
        $sales = SalesProfile::firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'title' => 'required|string|max:150',
            'branch' => 'required|string|max:150',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:50',
            'email' => 'nullable|email|max:100',
            'bio' => 'nullable|string|max:1500',
            'experience_years' => 'required|integer|min:0',
            'units_sold' => 'required|integer|min:0',
            'rating' => 'required|string|max:10',
            'badge' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'photo' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('uploads/sales', 'public');
            $validated['photo'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->has('is_active');

        $sales->update($validated);

        return redirect()->route('admin.sales.edit')
            ->with('success', 'Profil Sales Consultant berhasil diperbarui!');
    }
}
