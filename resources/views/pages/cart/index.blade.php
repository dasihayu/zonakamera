@extends('layouts.layout')
@section('title', 'Cart')

@section('content')
    <!-- Hero Section -->
    <div class="relative">
        <!-- Background Image -->
        <img src="{{ asset('storage/' . $page->cart_banner) }}" alt="Hero Image"
            class="object-cover w-full max-h-80 md:max-h-96 blur-sm" />
        <!-- Headline -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
            <h1 class="text-6xl font-extrabold text-white md:text-8xl drop-shadow-lg">
                @yield('title')
            </h1>
        </div>
    </div>
    <div class="container p-6 mx-auto">
        @if ($cartItems->count() > 0)
            <div class="flex justify-between mb-6">
                <h1 class="text-2xl font-bold">Your Cart</h1>
                <button onclick="showVoucherModal()" class="px-4 py-2 text-white rounded bg-primary hover:bg-primary-dark">
                    <i class="mr-2 fas fa-ticket-alt"></i>Apply Voucher
                </button>
            </div>
            <div class="space-y-4">
                @foreach ($cartItems as $item)
                    <div
                        class="flex flex-col items-center justify-between p-4 space-y-4 border rounded sm:flex-row sm:space-y-0 sm:space-x-4">
                        <div class="w-full sm:w-3/4">
                            <h3 class="text-lg font-bold">{{ $item->product->title }}</h3>
                            <p>Quantity: {{ $item->quantity }}</p>
                            <p>Price per day:
                                Rp{{ number_format($item->product->getPriceForUser(auth()->user()), 0, ',', '.') }}</p>
                            <p>Rental Period: {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d F Y') }} to
                                {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="flex items-center justify-between w-full sm:justify-end sm:w-1/4">
                            <p class="mr-4 text-xl font-bold">
                                Rp{{ number_format($item->product->getPriceForUser(auth()->user()) * $item->quantity, 0, ',', '.') }}
                            </p>
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 mt-2 text-white bg-red-500 rounded sm:mt-0">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 mt-6 rounded bg-gray-50">
                <div class="flex items-center justify-between">
                    <span>Subtotal:</span>
                    <span>Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
                <div id="voucherInfo" class="hidden pt-2 mt-2 border-t">
                    <div class="flex items-center justify-between text-primary">
                        <span>Voucher Discount:</span>
                        <span id="discountAmount">-</span>
                    </div>
                    <div class="flex items-center justify-between mt-2 font-bold">
                        <span>Final Total:</span>
                        <span id="finalPrice">-</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-start mt-6">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2 text-white rounded bg-primary hover:bg-primary-dark">
                        Create Booking
                    </button>
                </form>
            </div>
        @else
            <div class="py-12 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by adding products.</p>
                <div class="mt-6">
                    <a href="{{ route('products') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function showVoucherModal() {
                Swal.fire({
                    title: 'Apply Voucher',
                    html: `
                        <div class="space-y-4 text-left">
                            <div class="flex flex-col">
                                <label for="voucher_code" class="mb-1 font-semibold">Voucher Code</label>
                                <input type="text" 
                                       id="voucher_code" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary" 
                                       placeholder="Enter voucher code">
                            </div>
                            <div id="voucherPreview" class="hidden">
                                <div class="p-4 mt-4 space-y-2 text-sm rounded-lg bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Discount Amount:</span>
                                        <span id="previewDiscountAmount" class="font-medium text-primary">-</span>
                                    </div>
                                    <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                                        <span class="font-medium">Final Price:</span>
                                        <span id="previewFinalPrice" class="font-bold text-primary">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Apply Voucher',
                    confirmButtonColor: '#3150AE',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#EF4444',
                    customClass: {
                        popup: 'rounded-lg shadow-lg p-6',
                        title: 'text-lg font-bold',
                        confirmButton: 'px-4 py-2 text-white bg-primary rounded hover:bg-primary-dark',
                        cancelButton: 'px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600',
                    },
                    showLoaderOnConfirm: true,
                    preConfirm: (code) => {
                        const voucherCode = document.getElementById('voucher_code').value;
                        console.log('Voucher Code:', voucherCode); // Debugging
                        return fetch('/cart/verify-voucher', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    code: voucherCode
                                })
                            })
                            .then(response => {
                                console.log('Response:', response); // Debugging
                                if (!response.ok) {
                                    throw new Error('Invalid voucher code');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Data:', data); // Debugging
                                if (data.status === 'success') {
                                    return data;
                                }
                                throw new Error(data.message || 'Failed to apply voucher');
                            })
                            .catch(error => {
                                console.log('Error:', error); // Debugging
                                Swal.showValidationMessage(error.message);
                            });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    console.log('Result:', result); // Debugging
                    if (result.isConfirmed && result.value.status === 'success') {
                        const voucher = result.value.voucher;

                        // Update cart summary
                        document.getElementById('voucherInfo').classList.remove('hidden');
                        document.getElementById('discountAmount').textContent =
                            `Rp ${new Intl.NumberFormat('id-ID').format(voucher.discount_amount)}`;
                        document.getElementById('finalPrice').textContent =
                            `Rp ${new Intl.NumberFormat('id-ID').format(voucher.final_price)}`;

                        // Add voucher to form
                        const form = document.querySelector('form[action="{{ route('bookings.store') }}"]');
                        let input = form.querySelector('input[name="voucher_code"]');
                        if (!input) {
                            input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'voucher_code';
                            form.appendChild(input);
                        }
                        input.value = voucher.code;

                        // Show success message
                        Swal.fire({
                            title: 'Voucher Applied!',
                            text: `Discount of Rp ${new Intl.NumberFormat('id-ID').format(voucher.discount_amount)} has been applied`,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3150AE',
                            customClass: {
                                popup: 'rounded-lg shadow-lg',
                                confirmButton: 'px-4 py-2 text-white bg-primary rounded hover:bg-primary-dark'
                            }
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection
