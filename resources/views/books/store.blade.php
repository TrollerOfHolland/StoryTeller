@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">Könyv feltöltése</h1>
                    <div class="card-body">
                        <div class="container mx-auto p-3 lg:px-36 overflow-hidden min-h-screen">
                            <div class="mb-5">
                                <h3 class="mb-2">Ezen az oldalon tudsz új könyvet feltölteni az oldalra</h3>
                            </div>
                            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-5">
                                    <label for="title" class="block text-lg font-medium text-gray-700">Könyv címe</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('title') border-red-400 @else border-gray-400 @enderror">
                                    @error('title')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="author" class="block text-lg font-medium text-gray-700">Könyv szerzője</label>
                                    <input type="text" name="author" id="author" value="{{ old('author') }}"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('author') border-red-400 @else border-gray-400 @enderror">
                                    @error('author')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="ageLimit" class="block text-lg font-medium text-gray-700">Korhatár</label>
                                    <input type="number" name="ageLimit" id="ageLimit" min="1" value="{{ old('ageLimit') }}"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('ageLimit') border-red-400 @else border-gray-400 @enderror">
                                    @error('ageLimit')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <div class="flex flex-col gap-1.5 mt-2">
                                        <div class="flex items-center gap-1.5">
                                            <input type="checkbox" id="disable_comments" name="disable_comments"
                                                {{ old('disable_comments') ? 'checked' : '' }}>
                                            <label for="disable_comments">
                                                Hozzászólások kikapcsolása
                                            </label>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <input type="checkbox" id="disable_ratings" name="disable_ratings"
                                                {{ old('disable_ratings') ? 'checked' : '' }}>
                                            <label for="disable_ratings">
                                                Értékelések kikapcsolása
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="coverPhoto" class="block  text-lg font-medium text-gray-700">Kép feltöltése a könyvhöz</label>
                                    <input type="file" class="form-control-file" id="coverPhoto" name="coverPhoto">
                                    @error('coverPhoto')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="content" class="block  text-lg font-medium text-gray-700">Könyv tartalmának feltöltése</label>
                                    <input type="file" class="form-control-file" id="content" name="content">
                                    @error('content')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="mt-6 bg-blue-500 hover:bg-blue-600 text-gray-100 font-semibold px-2 py-1 text-xl">Feltöltés</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
