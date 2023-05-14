<div class="mt-8 flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="w-full text-right mb-6">
                <x-laravel-ai::buttons.a-primary href="{{ route('laravel-ai.chat.create') }}">
                    Start a new chat
                </x-laravel-ai::buttons.a-primary>
            </div>
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full max-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                        </th>
                        <th scope="col" wire:click.prevent="sortBy('{{ $sortFields['created_at']  }}')"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 cursor-pointer hover:bg-gray-100">
                            Name
                        </th>
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 cursor-pointer hover:bg-gray-100">
                            Date
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($chats as $chat)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-xs sm:pl-6 text-gray-400">
                                {{ $chat->id }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900 truncate">{{ $chat->created_at }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900">
                                    <span class="block text-xs font-bold">{{ $chat->created_at->format("Y-m-d") }}</span>
                                    <span class="block text-xs text-gray-500">{{ $chat->created_at->format("H:i") }}</span>
                                </div>
                            </td>
                            <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 my-auto">
                                <a href="{{ route('laravel-ai.chat.edit', $chat)  }}"
                                   class="inline-block text-indigo-600 hover:text-indigo-900">
                                    <x-laravel-ai::icons.solid-pencil-square class="w-5 h-5" />
                                </a>
                                <form action="{{ route('laravel-ai.chat.destroy', $chat) }}" method="POST"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                        <x-laravel-ai::icons.solid-trash class="w-5 h-5" />
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="md:px-6 lg:px-8 mt-6">
        {{ $chats->onEachSide(1)->links() }}
    </div>
</div>
