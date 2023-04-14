<x-app-layout>
    @section('title')
        {{ $title }}
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $discussion->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="block rounded-lg bg-white dark:bg-neutral-700 mb-6">
                        <div class="border-b-2 border-neutral-100 py-3 px-6 flex items-center dark:border-neutral-600 dark:text-neutral-50">
                            <div>
                                @if($discussion->user->profile_pic != '')
                                <img src="{{ $discussion->user->profile_pic }}" alt="{{ $discussion->user->name }}" width="70" height="70">
                                @else
                                <img src="{{ url('user.png') }}" alt="{{ $discussion->user->name }}" width="70" height="70">
                                @endif
                            </div>
                            <div class="ml-3">
                                {{ $discussion->user->name }}, <b>{{ $discussion->created_at->diffForHumans() }}</b>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="p-4">{{ $discussion->title }}</h3>
                            <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                {{ $discussion->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach($discussion->replies as $reply)
                    <div class="block rounded-lg bg-white dark:bg-neutral-700 mb-6">
                        <div class="border-b-2 border-neutral-100 py-3 px-6 flex items-center dark:border-neutral-600 dark:text-neutral-50">
                            <div>
                                @if($reply->user->profile_pic != '')
                                <img src="{{ $reply->user->profile_pic }}" alt="{{ $reply->user->name }}" width="70" height="70">
                                @else
                                <img src="{{ url('user.png') }}" alt="{{ $reply->user->name }}" width="70" height="70">
                                @endif
                            </div>
                            <div class="ml-3">
                                {{ $reply->user->name }}, <b>{{ $reply->created_at->diffForHumans() }}</b>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="p-4">{{ $reply->title }}</h3>
                            <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                {{ $reply->content }}
                            </p>
                        </div>
                        <div class="border-t-2 border-neutral-100 py-3 px-6 flex items-center dark:border-neutral-600 dark:text-neutral-50">
                            <p>
                                Likes
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>