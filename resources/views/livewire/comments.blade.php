<div class="flex justify-center">
    <div class="w-6/12">
        <h1 class="my-10 text-3x1">Comments</h1>
        @if(session()->has('message'))
            <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                {{ session('message') }}
            </div>
        @endif


        <section>
            <img src="{{ $image }}"  width="100"/>
            <input type="file" id="image" wire:change="$emit('fileChoosen')">
        </section>

        <form wire:submit.prevent="addComment" class="my-4 flex">
            <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2x" placeholder="What's in your mind." wire:model="newComment">
            <div class="py-0">
                <button class="p-2 bg-blue-500 w-20 rounded shadow text-white" type="submit">Add</button>
            </div>
        </form>
        @error('newComment') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror


    @foreach($comments as $comment)
            <div class="rounded border shadow p-3 my-2">
                <div class="flex justify-between my-2">
                    <div class="flex">
                        <p class="font-bold text-lg">{{ $comment->creator->name }}</p>
                        <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    <i class="fa fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{ $comment->id }})"></i>
                </div>
                <p class="text-gray-800">{{ $comment->body }}</p>
                @if($comment->image)
                    <img src="{{ $comment->imagePath }}">
                @endif
            </div>
        @endforeach
        {{ $comments->links('paginate-links') }}
    </div>
</div>

<script>

    window.livewire.on('fileChoosen', () => {
        let inputField = document.getElementById('image');
        let file = inputField.files[0];
        let reader = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file)
})
</script>
