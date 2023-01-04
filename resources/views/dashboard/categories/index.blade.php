@extends('layout.dashboard')

@section('title', 'categories')

@section('content')

<x-flash-massage />


<x-alert type="success">
    <h4>Alert Title</h4>
    <p>Alert Massage</p>
</x-alert>

<div class="mb-4">
    <a href="{{ route('dashboard.categories.create')}}" class="btn btn-outline-primary">
        <i class="fas fa-plus"></i> Add New</a>
    <a href="{{ route('dashboard.categories.trash')}}" class="btn btn-outline-dark">
        <i class="fas fa-trash"></i> View Trash</a>

</div>

<table class="table">
    <thead>
        <tr>
            <th></th>
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
        <td><img class="img-fluid" src="{{ $category->image_url }}" width="80" alt=""></td>
        <td><strong>{{$category->name}}</strong><br>
        <span class="text-muted">{{$category->slug}}</span></td>
        <td>{{$category->parent_name}}</td>
        <td>{{$category->created_at}}</td>
        <td>{{$category->updated_at ?? 'No updates'}}</td>
        <td>
            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="bt btn-sm btn-outline-primary">
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