@extends('layouts.main')

@section('title', $page->title ?? $page->name)
@section('description', $page->description)
@section('keywords', $page->keywords)

@section('content')
    {!! $page->content !!}
@endsection
