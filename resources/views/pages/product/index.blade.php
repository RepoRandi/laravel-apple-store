@extends('layouts.app')

@section('title', 'Product')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>
            <div class="section-header-button">
                <a href="{{ route('product.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Product</a></div>
                <div class="breadcrumb-item">All Product</div>
            </div>
        </div>
        <div class="section-body">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <h2 class="section-title">Products</h2>
            <p class="section-lead">
                You can manage all Products, such as editing, deleting and more.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="float-right">
                                <form method="GET" action="{{ route('product.index') }}">
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
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if ($product->image)
                                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image" width="100">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href='{{ route('product.edit', $product->id) }}' class="btn btn-sm btn-info btn-icon">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="ml-2">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                        <i class="fas fa-times"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                {{ $products->withQueryString()->links() }}
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