@extends('layouts.app')

@section('title', 'Edit Order')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Order</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Orders</a></div>
                <div class="breadcrumb-item">Edit Order</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Orders</h2>

            <div class="card">
                <form action="{{ route('order.update', $order) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Order Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control selectric @error('status') is-invalid @enderror" name="status">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="on_delivery" {{ $order->status == 'on_delivery' ? 'selected' : '' }}>On
                                    Delivery</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="expired" {{ $order->status == 'expired' ? 'selected' : '' }}>Expired
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Failed
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Shipping Resi</label>
                            <input type="text" class="form-control @error('shipping_resi') is-invalid @enderror" name="shipping_resi" step="0.1" value="{{ $order->shipping_resi }}">
                            @error('shipping_resi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update Order</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection

@push('scripts')
@endpush