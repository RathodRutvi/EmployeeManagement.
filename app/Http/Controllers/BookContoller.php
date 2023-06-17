<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Cart;
use DataTables;

class BookContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category_id',function($row){
                        $arr = explode(",",$row->category_id);
                    $data = Category::whereIn('id',$arr)->get();
                    
                    foreach($data as $row)
                    {
                        $tdata[] = $row->name;
                    } 
                     return $tdata;  
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="'.route('book.edit',$row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn .= '<a href="'.route('book.delete',$row->id).'" class="btn btn-danger btn-sm m-2">Delete</a>';
                        return $btn;
                    })
                    
                    ->rawColumns(['action'])
                    ->make(true);
        }
          
        return view('admin.book.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.book.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $book = new Book();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->category_id = implode(",",$request->category_id);
        if($request->hasfile('image'))
        {
           
            $file=$request->file('image');
            $extension=$file->getClientOriginalName();
            $filename=$extension;
            $file->move('upload/',$filename);
            $book->image=$filename;
           
        }
        $book->image  = $filename;
        $book->save();
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        $categories = Category::all();
       return view('admin.book.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Book::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = implode(',',$request->category_id);
        if($request->file('image'))
        {
            $file=$request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->move('images',$file_name);
            $product->image= $file_name;
        }
       
        $product->update();

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        Book::find($id)->delete();
        return redirect()->route('book.index');
    }

    
   
    
   
}
