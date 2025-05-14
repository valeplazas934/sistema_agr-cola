@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        <h1 class="text-2xl font-bold mb-4">Cultivation Publications</h1>

        @foreach($posts as $post)
            <div class="bg-white rounded shadow p-4 mb-6">
                <h2 class="text-xl font-semibold">{{ $post->cropTitle }}</h2>
                <p class="text-gray-600 text-sm">
                    By {{ $post->user->name }} |
                    Category: {{ $post->category->name }} |
                    {{ $post->creationDate }}
                </p>
                <p class="mt-2">{{ $post->cropContent }}</p>

                <div class="mt-4">
                    <h4 class="font-medium">Comments ({{ $post->comments->count() }})</h4>
                    @forelse($post->comments as $comment)
                        <div class="border-t border-gray-200 mt-2 pt-2">
                            <p class="text-sm">
                                <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>: {{ $comment->content }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $comment->creationDate }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center mt-10">
            <h2 class="text-xl font-semibold text-red-600">Access Restricted</h2>
            <p class="text-gray-600 mt-2">This section is only available for registered users.</p>
            <a href="{{ route('login') }}" class="text-blue-600 underline mt-4 inline-block">Login to continue</a>
        </div>
    @endauth
</div>
@endsection
