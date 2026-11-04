@extends('admin.layouts.admin')

@section('title', 'Profil Sales Consultant')
@section('header_title', 'Kelola Profil &amp; Kontak Sales')

@section('content')

<form action="{{ route('admin.sales.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <div class="admin-card rounded-2xl p-6 sm:p-8 space-y-6">
        <div class="border-b border-slate-800 pb-4">
            <h3 class="text-lg font-bold text-white flex items-center">
                <i class="fa-solid fa-user-tie text-cyan-400 mr-2.5"></i>
                Identitas Sales Consultant Resmi
            </h3>
            <p class="text-xs text-slate-400 mt-1">
                Data profil ini tampil di bagian atas frontend website dan melayani calon pembeli yang menghubungi via WhatsApp &amp; telepon.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Photo Upload & Preview -->
            <div class="md:col-span-4 p-5 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-4 text-center">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Foto Profil Sales
                </label>

                <div class="w-48 h-48 mx-auto rounded-2xl overflow-hidden bg-[#050811] border-2 border-cyan-400/40 p-1">
                    <img src="{{ asset($sales->photo ?? 'images/sales/sales-consultant.svg') }}" 
                         alt="{{ $sales->name }}" 
                         class="w-full h-full object-cover rounded-xl"
                         onerror="this.src='{{ asset('images/sales/sales-consultant.svg') }}'">
                </div>

                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Ganti Foto Sales:</label>
                    <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp,.svg"
                           class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                    <p class="text-[10px] text-slate-500 mt-1">Format JPG, PNG atau WebP (maks. 3MB)</p>
                </div>
            </div>

            <!-- Right: Details Form -->
            <div class="md:col-span-8 space-y-4">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Nama Lengkap &amp; Gelar *
                        </label>
                        <input type="text" name="name" value="{{ old('name', $sales->name) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Jabatan / Titel *
                        </label>
                        <input type="text" name="title" value="{{ old('title', $sales->title) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Cabang / Dealer Showroom *
                        </label>
                        <input type="text" name="branch" value="{{ old('branch', $sales->branch) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Badge / Sertifikasi Keahlian
                        </label>
                        <input type="text" name="badge" value="{{ old('badge', $sales->badge) }}"
                               placeholder="Contoh: Certified Master Sales BYD"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Nomor WhatsApp *
                        </label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $sales->whatsapp) }}" required
                               placeholder="Contoh: 6281288997722"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Nomor Telepon Seluler *
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', $sales->phone) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Alamat Email
                        </label>
                        <input type="email" name="email" value="{{ old('email', $sales->email) }}"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Rating Kepuasan Pelanggan
                        </label>
                        <input type="text" name="rating" value="{{ old('rating', $sales->rating) }}"
                               placeholder="4.9/5.0"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Pengalaman Kerja (Tahun) *
                        </label>
                        <input type="number" name="experience_years" value="{{ old('experience_years', $sales->experience_years) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Total Unit Terkirim *
                        </label>
                        <input type="number" name="units_sold" value="{{ old('units_sold', $sales->units_sold) }}" required
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Pesan Sambutan / Bio Sales
                    </label>
                    <textarea name="bio" rows="3"
                              class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">{{ old('bio', $sales->bio) }}</textarea>
                </div>

                <div class="pt-2">
                    <label class="inline-flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $sales->is_active ? 'checked' : '' }}
                               class="rounded bg-slate-900 border-slate-700 text-cyan-500 focus:ring-0">
                        <span class="text-xs font-semibold text-slate-300">Tampilkan Profil Sales di Frontend Website</span>
                    </label>
                </div>

            </div>

        </div>

        <div class="flex justify-end pt-4 border-t border-slate-800">
            <button type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/25 flex items-center transition-all">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                Simpan Profil Sales
            </button>
        </div>
    </div>
</form>

@endsection
