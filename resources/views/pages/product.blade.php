@extends('layouts.layout')

@section('title', 'Product')

@section('content')
    <section class="container px-4 py-12 mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center">Our Products</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <!-- Gambar Produk -->
                <img class="w-full h-48 object-cover" src="https://via.placeholder.com/300x200" alt="Nama Produk">
                
                <!-- Konten -->
                <div class="p-4">
                  <h2 class="text-lg font-semibold text-gray-800">Nama Produk</h2>
                  <p class="text-sm text-gray-600 mt-2">
                    Deskripsi singkat produk ini. Jelaskan fitur utama dan manfaatnya.
                  </p>
                  <div class="mt-4 flex items-center justify-between">
                    <span class="text-xl font-bold text-gray-800">Rp 150.000</span>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1">
                      Beli Sekarang
                    </button>
                  </div>
                </div>
              </div>
        </div>
    </section>
@endsection
