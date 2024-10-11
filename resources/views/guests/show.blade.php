@extends('layouts.template')

@section('title', "Guest: $guest->name")

@section('body')
@if ($guest->avatar)
    <img src="{{ $guest->avatar_url }}" class="rounded img-thumbnail mx-auto d-block my-3"/>
@endif

<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">Name</th>
            <td>{{ $guest->name }}</td>
        </tr>
        <tr>
            <th scope="row">Message</th>
            <td>{{ $guest->message }}</td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td>{{ $guest->email }}</td>
        </tr>
        <tr>
            <th scope="row">Phone Number</th>
            <td>{{ $guest->phone_number }}</td>
        </tr>
    </tbody>
</table>

<div>
    <small>Created at: {{ $guest->created_at }}</small>
    @if ($guest->updated_at)
        <br><small>Updated at: {{ $guest->updated_at }}</small>
    @endif
</div>
@endsection
