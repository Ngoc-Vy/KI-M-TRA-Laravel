@extends('app')

@section('content')

<a href="/cars/create" class="btn btn-success mb-3">+ Thêm xe</a>

<table class="table table-bordered table-hover text-center">
    <tr class="table-dark">
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Produced</th>
        <th>Action</th>
    </tr>

    @foreach($cars as $car)
    <tr>
        <td>{{ $car->id }}</td>
        <td>{{ $car->make }}</td>
        <td>{{ $car->model }}</td>
        <td>{{ $car->produced_on }}</td>
        <td>
            <a href="/cars/{{ $car->id }}" class="btn btn-info btn-sm">Xem</a>
            <a href="/cars/{{ $car->id }}/edit" class="btn btn-warning btn-sm">Sửa</a>

            <form action="/cars/{{ $car->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Xoá</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection