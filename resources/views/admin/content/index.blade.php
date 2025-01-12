@extends('layouts.dashboard')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Content') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid justify-end">
                <a href="{{ route('content.create') }}">
                    <button type="button"
                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-700">
                        Add
                    </button>
                </a>
            </div>
            <div class=" mb-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="max-w-[50px] px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="min-w-[175px] px-6 py-3">
                                Title Content
                            </th>
                            <th scope="col" class="min-w-[150px] px-6 py-3">
                                Header Content
                            </th>
                            <th scope="col" class="min-w-[150px] px-6 py-3">
                                Image Thumbnail
                            </th>
                            <th scope="col" class="min-w-[100px] px-6 py-3">
                                Type Content
                            </th>
                            <th scope="col" class="min-w-[100px] px-6 py-3">
                                Type Trash
                            </th>
                            <th scope="col" class="min-w-[100px] px-6 py-3">
                                Views
                            </th>
                            <th scope="col" class="min-w-[150px] px-6 py-3">
                                Date Publish
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $key => $content)
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th scope="row" class="px-6 py-4">
                                    {{ $loop->iteration + ($contents->currentPage() - 1) * $contents->perPage() }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $content->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $content->header }}
                                </td>
                                <td class="px-6 py-4">
                                    <img src="{{ $content->image_tumbnail }}" alt="Image Thumbnail {{ $key }}"
                                        class="w-20 h-20 object-cover rounded-lg">
                                </td>
                                <td class="px-6 py-4">
                                    {{ $content->type_content }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $content->type_trash }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $content->views }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Date::parse($content->created_at)->format('d M Y h:m:s') }}
                                </td>
                                <td class="px-6 py-4 flex">
                                    <a href="{{ route('content.detail', $content->id) }}">
                                        <button type="button"
                                            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-700">
                                            <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 192 512">
                                                <path fill="#ffffff"
                                                    d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <a href="{{ route('content.edit', $content->id) }}">
                                        <button type="button"
                                            class="text-white bg-yellow-500 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-600 dark:hover:bg-yellow-500 dark:focus:ring-yellow-700">
                                            <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 512 512">
                                                <path fill="#ffffff"
                                                    d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <button data-key="{{ $key }}" type="submit"
                                        class="deleteButton text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-700">
                                        <svg class="w-5 h-5 me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="#ffffff"
                                                d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                        </svg>
                                    </button>

                                    <!-- Modal -->
                                    <div id="deleteModal{{ $key }}"
                                        class="deleteModal hidden fixed inset-0 z-10 overflow-y-auto"
                                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true">
                                        </div>
                                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                            <div
                                                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                <div
                                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div
                                                                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                                                <svg class="size-6 text-red-600" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" aria-hidden="true"
                                                                    data-slot="icon">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                                <h3 class="text-base font-semibold text-gray-900"
                                                                    id="modal-title">{{ $content->title }}</h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">Are you sure you want
                                                                        to delete this content? This data will be
                                                                        permanently removed. This action cannot be undone.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                        <form method="POST"
                                                            action="{{ route('content.destroy', $content->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
                                                        </form>
                                                        <button type="button"
                                                            class="cancelButton mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                                            data-key="{{ $key }}">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{ $contents->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.deleteButton').forEach(function(button) {
                button.addEventListener('click', function() {
                    var key = this.getAttribute('data-key');
                    document.getElementById('deleteModal' + key).classList.remove('hidden');
                });
            });

            document.querySelectorAll('.cancelButton').forEach(function(button) {
                button.addEventListener('click', function() {
                    var key = this.getAttribute('data-key');
                    document.getElementById('deleteModal' + key).classList.add('hidden');
                });
            });
        });
    </script>
@endsection
