<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Comments extends Component
{
    use WithPagination;
    public $newComment;


    public function addComment()
    {

        $this->validate([
            'newComment' => 'required',
        ]);

        $create = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1
        ]);

        $this->newComment = "";
        session()->flash('message', 'Comment added successfully.');
    }


    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'newComment' => 'required',
        ]);

    }


    public function remove($commentId)
    {
        Comment::destroy($commentId);
        session()->flash('message', 'Comment deleted successfully.');
    }


    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
