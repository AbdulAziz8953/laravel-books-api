<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\BookRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $books = Book::search($request->search)
                    ->paginate($request->get('per_page', 15));
        
        return $this->success($books, 'Books retrieved successfully');
    }

    public function store(BookRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'cover_image' => $request->cover_image,
            'price' => $request->price,
            'published_date' => $request->published_date,
            'deleted' => 0
        ]);

        return $this->success($book, 'Book created successfully', 201);
    }

    public function show($id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return $this->error('Book not found', 404);
        }
        
        return $this->success($book, 'Book retrieved successfully');
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return $this->error('Book not found', 404);
        }
        
        $book->update($request->only([
            'title', 'author', 'cover_image', 'price', 'published_date'
        ]));
        
        return $this->success($book, 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return $this->error('Book not found', 404);
        }
        
        // Soft delete - set deleted flag to 1
        $book->update(['deleted' => 1]);
        
        return $this->success(null, 'Book deleted successfully');
    }
}