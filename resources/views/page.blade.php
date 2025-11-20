@extends('layouts.main')

@section('title', $page->title ?? $page->name)
@section('meta_description', $page->description)
@section('meta_keywords', $page->keywords)

@section('content')

    {!! $page->content !!}

@endsection
