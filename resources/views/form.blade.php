<x-app-layout>
    @section('title')
        {{ $title }}
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach($discussions as $discussion)
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
                            <a href="{{ route('discussion.show', ['slug' => $discussion->slug ]) }}"><h3 class="p-4">{{ $discussion->title }}</h3></a>
                            <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">
                                {{ Str::limit($discussion->content, 50) }}
                            </p>
                        </div>
                        <div class="border-t-2 border-neutral-100 py-3 px-6 flex items-center dark:border-neutral-600 dark:text-neutral-50">
                            <p>
                                {{ $discussion->replies->count() }} Replies
                            </p>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        {{ $discussions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
