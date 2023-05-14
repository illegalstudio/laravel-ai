<div
    x-data="{
        messages: @entangle('messages'),
        scroll() {
            const body = document.querySelector('body');
            body.scrollTop = body.scrollHeight;
        },
        capitalize(text) {
            return text.charAt(0).toUpperCase() + text.slice(1);
        }
    }"
    x-on:scroll-to-bottom.window="scroll()"
    x-init="$nextTick(() => scroll())"
>

    <div class="flex flex-col">
        <template x-for="message in messages">
            <div :class="message.role === 'user' ? 'bg-gray-50' : ''" class="p-8 last:pb-28 last:grow border-b border-gray-200">
                <div class="block mx-auto max-w-xl px-5 sm:px-6 lg:px-8">
                    <p class="font-bold mb-2" x-text="capitalize(message.role) + ':'"></p>
                    <p x-text="message.content"> </p>
                </div>
            </div>
        </template>
    </div>

    <div class="fixed bottom-0 right-0 left-0 py-2 lg:left-72 h-42 bg-slate-200 border-t-2 border-slate-400">
        <div class="mx-auto max-w-xl">
            <label for="message" class="hidden">Message</label>
            <div
                class="flex flex-col w-full py-2 flex-grow md:py-3 md:pl-4 relative border border-black/10 bg-white rounded-md shadow-xl">
                <textarea
                    x-data="{
                        resize: () => {
                            $el.style.height = '5px';
                            $el.style.height = ($el.scrollHeight > 200 ? 200 : $el.scrollHeight) + 'px';
                        }
                    }"
                    x-init="resize()"
                    @input="resize()"
                    name="message" id="message" rows="1"
                    class="m-0 w-full resize-none border-0 bg-transparent p-0 pr-7 focus:ring-0 focus-visible:ring-0 pl-2 md:pl-0"
                    wire:model.defer="message">
                </textarea>
                <button x-on:click="$wire.sendChat()"
                    class="absolute p-1 rounded-full aspect-square text-gray-500 bottom-1.5 md:bottom-2.5 hover:bg-sky-500 hover:text-white right-1 md:right-2 disabled:opacity-40">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                         stroke-linejoin="round" class="h-4 w-4 mr-1" height="1em" width="1em"
                         xmlns="http://www.w3.org/2000/svg">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
