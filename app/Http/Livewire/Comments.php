<?php

namespace App\Http\Livewire;

use App\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;


    public function mount()
    {
        $initialComment = Comment::latest()->get();
        $this->comments = $initialComment;
    }


    public function addComment()
    {

        $this->validate([
            'newComment' => 'required',
        ]);

        $create = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1
        ]);

        $this->comments->prepend($create);


        $this->newComment = "";
    }


    public function updated($fields)
    {

        $this->validateOnly($fields, [
            'newComment' => 'required',
        ]);

    }


    public function render()
    {
        return view('livewire.comments');
    }
}
