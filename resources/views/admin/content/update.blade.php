@extends('layouts.dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Update Content') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('content.index') }}">
                <button type="button"
                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-700">
                    Back
                </button>
            </a>

            <div class="w-full sm:max-w px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <form method="POST" enctype="multipart/form-data" action="{{ route('content.update', $content->id) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block font-medium text-sm text-gray-700"
                            for="title">{{ __('Title Content') }}@include('components.label-required')</label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="title" type="text" name="title" value="{{ $content->title }}" autofocus
                            autocomplete="Title Content" />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700"
                            for="header">{{ __('Header Content') }}@include('components.label-required')</label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="header" type="text" name="header" value="{{ $content->header }}" required autofocus
                            autocomplete="Header" />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700"
                            for="link_video">{{ __('Link Video') }}</label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="link_video" type="text" name="link_video" value="{{ $content->link_video }}" autofocus
                            autocomplete="Link Video" />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700"
                            for="content">{{ __('Content') }}@include('components.label-required')</label>
                        <textarea id="content" name="content" required autofocus autocomplete="Content" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Write your thoughts here...">{{ $content->content }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-x-6">
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700"
                                for="image_tumbnail">{{ __('Image Thumbnail') }}</label>
                            <img src="{{ $content->image_tumbnail }}" alt="Image Thumbnail - {{ $content->title }}"
                                class="w-20 h-20 object-cover rounded-lg my-2">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500 file:cursor-pointer file:border-0 file:py-2 file:px-4"
                                id="image_tumbnail" type="file" name="image_tumbnail" autofocus
                                aria-describedby="image_tumbnail" autocomplete="Image Thumbnail" />
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700"
                                for="image_content">{{ __('Image Content') }}</label>
                            @if ($content->image_content)
                                <img src="{{ $content->image_content }}" alt="Image Content - {{ $content->title }}"
                                    class="w-20 h-20 object-cover rounded-lg">
                            @endif
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500 file:cursor-pointer file:border-0 file:py-2 file:px-4"
                                id="image_content" type="file" name="image_content" autofocus
                                aria-describedby="image_content" autocomplete="Image Content" />
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700"
                                for="type_content">{{ __('Type Content') }}@include('components.label-required')</label>
                            <select id="type_content" name="type_content" required autocomplete="Type Content"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="0" {{ $content->type_content == 'DIY' ? 'selected' : '' }}>
                                    {{ __('DIY') }}</option>
                                <option value="1" {{ $content->type_content == 'Course' ? 'selected' : '' }}>
                                    {{ __('Course') }}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700"
                                for="type_trash">{{ __('Type Trash') }}@include('components.label-required')</label>
                            <select id="type_trash" name="type_trash" required autocomplete="Type Trash"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="0" {{ $content->type_trash == 'Organic' ? 'selected' : '' }}>
                                    {{ __('Organic') }}</option>
                                <option value="1" {{ $content->type_trash == 'Anorganic' ? 'selected' : '' }}>
                                    {{ __('Anorganic') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
