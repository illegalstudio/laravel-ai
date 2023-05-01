<div>
    <div class="bg-indigo-500 w-52 fixed h-full hidden lg:block">
        LEFT
    </div>

    <div class="lg:ml-52">
        <div class="mx-auto max-w-7xl px-5 mb-24 sm:px-6 lg:px-8">
            <div>
                <h1>Chat</h1>
                @foreach($messages as $message)
                    <p>
                        {{ $message['role'] }}: {{ $message['content'] }}
                    </p>
                @endforeach
            </div>
            <div class="fixed bottom-0 h-20 w-full bg-white">
                <input type="text" name="message" id="message"
                       wire:model.defer="message" wire:keydown.enter="sendChat"
                >
            </div>
        </div>
    </div>
</div>
