<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->get();

        return view('tags.index', ['tags'=>$tags]);
    }


    public function create()
    {
        return view('tags.create');
    }


    public function store(Request $request)
    {
        $this->validateTags();

        $tag        = new Tag;
        $tag->name  = $request->name;
        $tag->label = $request->label;
        $tag->save();

        return redirect('/tags');
    }


    public function show(Tag $tag)
    {
        return view('tags.show', ['tag'=>$tag]);
    }


    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }


    public function update(Request $request, Tag $tag)
    {
        $this->validateTags();

        $tag->name  = $request->name;
        $tag->label = $request->label;
        $tag->save();

        return redirect('/tags');
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect('/tags');
    }


    public function validateTags()
    {
        return request()->validate([
            'name' => 'required',
            'label' => 'required'
        ]);
    }
}
