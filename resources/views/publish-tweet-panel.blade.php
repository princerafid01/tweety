<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets">
        @csrf
        <span class="mb-3 grey">255/<span id="word_left">255</span></span>

        <textarea
            name="body"
            class="w-full tweet-textarea"
            placeholder="What's up doc?"
            required
            maxlength="255"
        ></textarea>

        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <img
                src="{{ auth()->user()->avatar }}"
                alt="your avatar"
                class="rounded-full mr-2"
                width="50"
                height="50"
            >

            <button
                type="submit"
                class="bg-blue-500 rounded-lg shadow py-2 px-10 text-sm hover:bg-blue-600 text-white"
            >
                Publish
            </button>
        </footer>
    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
