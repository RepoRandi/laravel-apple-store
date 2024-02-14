@extends('layouts.app')

@section('title', 'Order')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Order</a></div>
                <div class="breadcrumb-item">All Order</div>
            </div>
        </div>
        <div class="section-body">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h2 class="section-title">Orders</h2>
            <p class="section-lead">
                You can manage all Orders, such as editing, deleting and more.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="float-right">
                                <form method="GET" action="{{ route('order.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="name">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>Transaction Number</th>
                                        <th>Total Cost</th>
                                        <th>Payment Method</th>
                                        <th>Shipping Service</th>
                                        <th>Shipping Resi</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->transaction_number }}</td>
                                        <td>{{ $order->total_cost }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->shipping_service }}</td>
                                        <td>{{ $order->shipping_resi }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href='{{ route('order.edit', $order->id) }}' class="btn btn-sm btn-info btn-icon">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $orders->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush