@extends('layout.dashboard')

@section('title', 'categories')

@section('content')

@if($status)
<div class="alert alert-success">
    {{$status}}
</div>
@endif

<div class="mb-4">
    <a href="{{ route('dashboard.categories.create')}}" class="btn btn-outline-primary">
        <i class="fas fa-plus"></i> Add New</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent ID</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

<tbody>
    @foreach($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td><strong>{{$category->name}}</strong><br>
        <span class="text-muted">{{$category->slug}}</span></td>
        <td>{{$category->parent_name}}</td>
        <td>{{$category->created_at}}</td>
        <td>{{$category->updated_at ?? 'No updates'}}</td>
        <td>
            <a href="{{ rout('dashboard.categories.edit', $category->id) }}" class="bt btn-sm btn-outline-primary">
            <i class="fas fa-edit"></i> Edit </a> </td>
        <td>
            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fsa fa-trash"></i> Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

@endsection