@extends('app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <img src="{{ asset('car_img/' . $car->image) }}" class="card-img-top img-fluid rounded" alt="{{ $car->model }}">
            </div>
        </div>

        <div class="col-md-7">
            <h2 class="text-primary mb-3">Thông tin chi tiết: {{ $car->model }}</h2>
            
            <ul class="list-group shadow-sm">
                <li class="list-group-item d-flex justify-content-between">
                    <b>ID hệ thống:</b> 
                    <span class="badge bg-secondary rounded-pill">#{{ $car->id }}</span>
                </li>
                <li class="list-group-item">
                    <b>Hãng sản xuất (Make):</b> 
                    <span class="text-uppercase fw-bold text-success">{{ $car->mf->mf_name }}</span>
                </li>
                <li class="list-group-item">
                    <b>Đời xe (Model):</b> {{ $car->model }}
                </li>
                <li class="list-group-item">
                    <b>Ngày xuất xưởng:</b> {{ date('d/m/Y', strtotime($car->produced_on)) }}
                </li>
                <li class="list-group-item">
                    <b>Mô tả:</b> 
                    <p class="text-muted mt-1">{{ $car->description }}</p>
                </li>
            </ul>

            <div class="mt-4">
                <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại danh sách
                </a>
                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Chỉnh sửa thông tin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection