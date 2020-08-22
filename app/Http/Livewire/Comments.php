<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Comments extends Component
{
    use WithPagination;

    public $newComment, $image;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function addComment()
    {

        $this->validate([
            'newComment' => 'required',
        ]);

        $image = $this->storeImage();

        $create = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1,
            'image' => $image,
        ]);

        $this->newComment = "";
        $this->image      = "";

        session()->flash('message', 'Comment added successfully.');
    }

    public function storeImage()
    {
        if (!$this->image) return null;

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'newComment' => 'required',
        ]);

    }


    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();
        session()->flash('message', 'Comment deleted successfully.');
    }


    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
