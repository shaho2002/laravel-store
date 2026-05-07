<?php

namespace App\Livewire\Frontend;

use App\Enums\CommentStatus;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    public $product;
    public $product_id;
    public $title;
    public $recommendation;
    public $comment;


    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $this->product = Product::query()->findOrFail($product_id);
    }
    public function recommend() 
    {
        $this->recommendation = true;
    }
    public function notRecommend() 
    {
        $this->recommendation = false;
    }
    public function submitComment()
    {
        
        $this->validate([
            'title' => 'required | max:15',
            'comment' => 'required | min:3'
        ]);
        Comment::query()->create([
            'user_id' => Auth::user()->id,
            'product_id' => $this->product_id, 
            'title' => $this->title,
            'recommendation' => $this->recommendation,
            'comment' => $this->comment,
            'status' => CommentStatus::Active->value
        ]);
         return redirect()
        ->route('product.details', $this->product->slug)
        ->with('scrollToComments', true);
    }


    public function render()
    {
        $comments = Comment::query()
        ->where('product_id', $this->product_id)
        ->where('status', CommentStatus::Active->value)
        ->with('user')
        ->orderBy('created_at', 'asc')
        ->take(2)
        ->get();

        $moreComments = Comment::query()
        ->where('product_id', $this->product_id)
        ->where('status', CommentStatus::Active->value)
        ->with('user')
        ->orderBy('created_at', 'asc')
        ->skip(2)
        ->take(9999999)
        ->get();

        return view('livewire.frontend.comments', compact('comments', 'moreComments'));
    }
}
