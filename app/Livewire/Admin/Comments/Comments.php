<?php

namespace App\Livewire\Admin\Comments;

use App\Enums\CommentStatus;
use App\Models\Comment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Comments extends Component
{

    #[Layout('admin.master'), Title('مدیریت نظرات')]


    public function change_status($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        if($comment->status == CommentStatus::Active->value)
        {
            $comment->update([
                'status' => CommentStatus::notActive->value
            ]);
        }elseif($comment->status == CommentStatus::notActive->value)
        {
            $comment->update([
                'status' => CommentStatus::Active->value
            ]);
        }
    }
    public function render()
    {
        $comments = Comment::query()
        ->with(['user','product'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('livewire.admin.comments.comments', compact('comments'));
    }
}
