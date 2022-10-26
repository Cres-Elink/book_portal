<?php

namespace App\Http\Controllers;

use App\Helpers\MonthHelper;
use App\Models\Author;
use App\Models\Book;
use App\Models\EbookTransaction;
use App\Models\RejectedEbookTransaction;
use Illuminate\Http\Request;

class RejectedEbookTransactionController extends Controller
{
    public function index()
    {
        return view('rejecteds.ebooks.index', [
            'rejected_ebooks' => RejectedEbookTransaction::orderBy('created_at', 'DESC')->paginate(10)
        ]);
    }


    public function delete(RejectedEbookTransaction $rejected_ebook)
    {
        $rejected_ebook->delete();
        return back();
    }

    public function edit(RejectedEbookTransaction $rejected_ebook)
    {
        $authors = Author::all();
        $months = MonthHelper::getMonths();
        return view('rejecteds.ebooks.edit')
            ->with('ebook', $rejected_ebook)
            ->with('authors', $authors)
            ->with('months', $months);
    }
    public function clear(){
        RejectedEbookTransaction::truncate();
        return back();
    }
    public function update(Request $request, RejectedEbookTransaction $rejected_ebook)
    {
          
        $request->validate([
            'author' => 'required',
            'book' => 'required',
            'class_of_trade' => 'required',
            'line_item_no' => 'required',
            'year' => 'required',
            'month' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'proceeds' => 'required',
            'royalty' => 'required',
        ]);
        
     
        $book = Book::where('title', $request->book)->first();
        
        if (!$book) {
            $book = Book::create([
                'title' => $request->book
            ]);
        }
        
        EbookTransaction::create([
            'author_id' => $request->author,
            'book_id' => $book->id,
            'class_of_trade' => $request->class_of_trade,
            'line_item_no' => $request->line_item_no,
            'year' => $request->year,
            'month' => $request->month,
            'flag' => $request->flag,
            'format' => $request->format,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'proceeds' => $request->proceeds,
            'royalty' => $request->royalty
        ]);

        $rejected_ebook->delete();

       return back(route('rejecteds-ebooks.index'));
    }
}
