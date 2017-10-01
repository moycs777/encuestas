<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Poll;
use App\Category;

class PollsController extends Controller
{
    public function index()
    {
        $polls = Poll::all();
        return view('admin.polls.index',compact('polls'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('admin.polls.create', compact('categories'));        
    }

    
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'pausable' => 'required' ]);

        $store = Category::create($request->all());

        Session::flash('message', 'Category added!');
        Session::flash('status', 'success');

        return redirect('admin/categories');

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));


    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required', 'pausable' => 'required' ]);

        $categories = Category::findOrFail($id);
        $categories->update($request->all());

        Session::flash('message', 'Category updated!');
        Session::flash('status', 'success');

        return redirect('admin/categories');
    }

    
    public function destroy($id)
    {
        $categories = Category::findOrFail($id);

        $categories->delete();

        Session::flash('message', 'category deleted!');
        Session::flash('status', 'success');

        return redirect('admin/categories');
    }
}
