@extends('layouts.dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $content->title }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="w-full sm:max-w px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <img class="mt-2 h-100 object-cover rounded-lg" src="{{ $content->image_tumbnail }}"
                    alt="Image Thumbnail - {{ $content->title }}" />
                <p class="text-gray-600 mt-1">
                    {{ $content->user_name . ' - ' . $content->type_content . ' - ' . $content->type_trash }}</p>
                <p class="text-gray-600">{{ Date::parse($content->created_at)->format('l, d F y h:i:s') }}</p>
                <h1 class="text-xl font-semibold text-gray-800 mt-4 ">{{ $content->header }}</h1>
                <hr class="my-1" />
                @if ($content->link_video)
                    <div class="mt-2">
                        <iframe width="100%" height="315" src="{{ $content->link_video }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                @elseif ($content->image_content)
                    <div class="mt-2">
                        <img class="mt-2 h-100 object-cover rounded-lg" src="{{ $content->image_content }}"
                            alt="Image Content - {{ $content->title }}" />
                    </div>
                @endif
                <p class="text-gray-600">
                    {!! nl2br(e($content->content)) !!}
                </p>
            </div>

            <a href="{{ route('content.index') }}">
                <button type="button"
                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mt-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-700">
                    Back
                </button>
            </a>
        </div>
    </div>
@endsection
