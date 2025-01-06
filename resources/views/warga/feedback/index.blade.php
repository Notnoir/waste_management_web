@extends('layouts.main_warga')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Feedback Warga</h2>

    @if($feedbacks->isEmpty())
    <p class="text-center text-gray-500">Belum ada feedback yang tersedia.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($feedbacks as $feedback)
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <div
                        class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr($feedback->user->name, 0, 1)) }}
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $feedback->user->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $feedback->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <div class="mb-4">
                <span class="flex text-yellow-400">
                    @for ($i = 1; $i <= $feedback->rating; $i++)
                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        @endfor
                        @for ($i = $feedback->rating + 1; $i <= 5; $i++) <svg
                            class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            @endfor </span>
            </div>
            <p class="text-gray-700">{{ $feedback->comments ?? 'Tidak ada komentar.' }}</p>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $feedbacks->links('pagination::tailwind') }}
    </div>
    @endif


    <h3 class="text-2xl font-bold text-gray-800 mb-9 py-3 mt-20 border-b-2">Beri Feedback</h3>
    <!-- Bagian Form Feedback -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <form action="{{ route('warga.feedback.store') }}" method="POST">
            @csrf

            <!-- Rating -->
            <div class="mb-4 space-y-3">
                <label for="rating">Penilaian (1-5)</label>
                <div class="flex items-center space-x-1">
                    @for ($i = 1; $i <= 5; $i++) <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 cursor-pointer star-icon text-gray-400" fill="currentColor" viewBox="0 0 22 20"
                        data-rating="{{ $i }}">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        @endfor
                </div>
                <input type="hidden" name="rating" id="rating" value="0" required>
                @error('rating')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Komentar -->
            <div class="mb-4">
                <label for="comments" class="block text-sm font-medium text-gray-700">Komentar</label>
                <textarea name="comments" id="comments" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('comments')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Kirim Feedback
            </button>
        </form>
    </div>
</div>

<script>
    const stars = document.querySelectorAll('.star-icon');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            updateStars(rating);
        });

        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            updateStars(rating);
        });

        star.addEventListener('mouseout', function() {
            const currentRating = ratingInput.value;
            updateStars(currentRating);
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-rating') <= rating) {
                star.classList.add('text-yellow-300');
                star.classList.remove('text-gray-300');
            } else {
                star.classList.add('text-gray-300');
                star.classList.remove('text-yellow-300');
            }
        });
    }
</script>
@endsection