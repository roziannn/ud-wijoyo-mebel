@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li><a href="{{ route('customer.dashboard') }}">Dashboard<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">keranjang</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="shopping-cart section pt-0">
        <div class="container mb-3">
            <h4>Keranjang Saya</h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form id="cart-form" action="">
                        @csrf
                        <table class="table shopping-summery">
                            <thead>
                                <tr class="main-hading">
                                    <th class="w-5">#</th>
                                    <th>Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Harga Unit</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Harga Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItem as $item)
                                    <tr data-item-id="{{ $item->id }}">
                                        <td>
                                            <input type="checkbox" name="id_cart[]" value="{{ $item->id }}"
                                                class="cart-checkbox">
                                        </td>
                                        <td class="image" data-title="No">
                                            <img src="{{ asset('storage/' . $item?->image) }}" alt="#">
                                        </td>
                                        <td class="product-des" data-title="Description">
                                            <p class="product-name"><a
                                                    href="{{ route('single.produk', $item?->produk->slug) }}">{{ $item?->nama }}</a>
                                            </p>
                                        </td>
                                        <td class="product-des" data-title="Description">
                                            <p>{{ $item?->produk->kategori }}</p>
                                        </td>
                                        <td class="price" data-title="Price">
                                            <span>Rp. {{ number_format($item?->produk->harga, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="qty" data-title="Qty">
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        data-type="minus" data-field="quant[{{ $item->id }}]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="quant[{{ $item->id }}]"
                                                    class="input-number" data-min="1" data-max="100"
                                                    data-price="{{ $item?->produk->harga }}"
                                                    value="{{ $item?->item_qty }}">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        data-type="plus" data-field="quant[{{ $item->id }}]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-amount" data-title="Total">
                                            <span>Rp. <span
                                                    class="total">{{ number_format($item?->produk->harga * $item->item_qty, 0, ',', '.') }}</span></span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-delete text-danger"
                                                data-id="{{ $item->id }}">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="8">Keranjang kosong.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button id="checkout-button" type="button" class="btn w-full" disabled>Checkout
                                Keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form id="cart-form" action="{{ route('customer.checkout.store') }}" method="POST">
        @csrf
        <div class="modal
        fade" id="checkoutModal" tabindex="-1" role="dialog"
            aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="P-3">
                            @if (empty($customer->nama_lengkap) ||
                                    empty($customer->no_telp) ||
                                    empty($customer->alamat) ||
                                    empty($customer->regensi->name) ||
                                    empty($customer->kode_pos))
                                <div class="alert alert-warning">
                                    <strong><i class="fa fa-exclamation-triangle"></i></strong>
                                    Harap lengkapi data profile dan informasi alamat sebelum melakukan
                                    checkout.
                                    <a href="{{ route('customer.profile') }}" class="text-primary"><i
                                            class="fa fa-pencil-square-o mx-2"></i>Lengkapi Alamat</a>
                                </div>
                            @else
                                <div class="alert alert-secondary">
                                    <strong><i class="fa fa-location-arrow mx-2"></i> Pengiriman ke:</strong>
                                    <span>{{ $customer->nama_lengkap }}</span>
                                    <span>{{ $customer->no_telp }}</span>
                                    <span>{{ $customer->alamat }}, {{ $customer->regensi->name }},
                                        {{ $customer->kode_pos }}</span>
                                    <a href="{{ route('customer.profile') }}" class="text-primary"><i
                                            class="fa fa-pencil-square-o mx-2"></i>Ubah Alamat</a>
                                </div>
                            @endif
                        </div>
                        <table class="table table-bordered">
                            <input type="hidden" id="id_cart" name="id_cart" value="">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Item</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center">Harga Unit</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="checkoutItems">
                            </tbody>
                        </table>
                        <h5 class="text-right m-3">Total Bayar: <span id="grandTotal">Rp. 0</span></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="confirmCheckout">Konfirmasi Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkoutButton = document.getElementById("checkout-button");
            const cartCheckboxes = document.querySelectorAll(".cart-checkbox");
            const checkoutItems = document.getElementById("checkoutItems");
            const grandTotal = document.getElementById("grandTotal");

            let selectedItems = [];

            cartCheckboxes.forEach(checkbox => {
                checkbox.addEventListener("change", () => {
                    selectedItems = Array.from(cartCheckboxes)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => {
                            const row = checkbox.closest("tr");
                            return {
                                id: checkbox.value,
                                name: row.querySelector(".product-name a").textContent.trim(),
                                price: parseInt(row.querySelector(".price span").textContent
                                    .replace(/[^0-9]/g, "")),
                                quantity: parseInt(row.querySelector(".input-number").value),
                                total: parseInt(row.querySelector(".total").textContent.replace(
                                    /[^0-9]/g, ""))
                            };
                        });

                    checkoutButton.disabled = selectedItems.length === 0;
                });
            });

            checkoutButton.addEventListener("click", () => {
                checkoutItems.innerHTML = "";

                let grandTotalValue = 0;

                const idCartInput = document.getElementById("id_cart");

                // Ensure the value is a string of comma-separated values
                idCartInput.value = selectedItems.map(item => item.id).join(",");

                selectedItems.forEach(item => {
                    grandTotalValue += item.total;
                    const row = `
            <tr>
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td class="text-center">Rp. ${item.price.toLocaleString()}</td>
                <td class="text-center">${item.quantity}</td>
                <td class="text-center">Rp. ${item.total.toLocaleString()}</td>
            </tr>
        `;
                    checkoutItems.insertAdjacentHTML("beforeend", row);
                });

                grandTotal.textContent = `Rp. ${grandTotalValue.toLocaleString()}`;

                $("#checkoutModal").modal("show");
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.cart-checkbox');
            const checkoutButton = document.getElementById('checkout-button');

            function toggleCheckoutButton() {
                const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                checkoutButton.disabled = !anyChecked;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleCheckoutButton);
            });

            toggleCheckoutButton();

            const updateTotal = async (button, type) => {
                const input = button.closest('.input-group').querySelector('.input-number');
                const totalAmount = button.closest('tr').querySelector('.total-amount .total');

                let currentQty = parseInt(input.value) || 1;
                const price = parseFloat(input.dataset.price) || 0;
                const min = parseInt(input.dataset.min) || 1;
                const max = parseInt(input.dataset.max) || 100;

                if (type === 'plus' && currentQty < max) {
                    currentQty += 0;
                } else if (type === 'minus' && currentQty > min) {
                    currentQty -= 0;
                }

                input.value = currentQty;
                const newTotal = currentQty * price;
                totalAmount.textContent = newTotal.toLocaleString('id-ID', {
                    style: 'decimal',
                    minimumFractionDigits: 0
                });


                try {
                    const response = await fetch("{{ route('customer.cart.updateQty') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: button.closest('tr').dataset.itemId,
                            qty: currentQty
                        })
                    });

                    const data = await response.json();
                    if (data.success) {
                        console.log('Quantity updated');
                    } else {
                        console.error('Error updating quantity');
                    }
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    spinner.remove();
                }
            };

            document.querySelectorAll('.btn-number').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const type = button.dataset.type;
                    updateTotal(button, type);
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.btn-delete', function() {
            var itemId = $(this).data('id');
            var url = '/customer/keranjang/delete/' + itemId;

            Swal.fire({
                title: 'Hapus dari keranjang?',
                text: "Item ini akan dihapus dari keranjang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan: ' + xhr.responseText,
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
