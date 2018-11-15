<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Location;
use App\Monument;
use App\Photo;
use App\Source;
use Illuminate\Http\Request;

class MonumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy', 'addComment']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('monuments.index')->with('monuments', Monument::getAll(1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monuments.add')->with('categories', Category::all('name', 'id')->pluck('name', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:190',
            'short_description' => 'required|string|max:190',
            'description' => 'required|string',
            'sources' => 'nullable|string',
            'street' => 'nullable|string|max:190',
            'city' => 'nullable|string|max:190',
            'voivodeship' => 'nullable|string|max:190',
            'postal' => 'nullable|string|max:190',
            'country' => 'nullable|string|max:190',
            'latitude' => 'nullable|numeric',
            'logitude' => 'nullable|numeric',
            'files[]' => 'image',
        ]);
        $monument = new Monument;
        $monument->user_id = auth()->user()->id;
        $monument->category_id = $request->category_id;
        $monument->name = $request->name;
        $monument->short_description = $request->short_description;
        $monument->description = $request->description;
        $monument->confirmed = 1;
        $monument->in_area = $request->in_area == 'on' ? 1 : 0;
        $monument->save();

        $location = new Location();
        $location->fillLocation($request, $monument->id);
        $location->save();

        $string = explode(';', $request->sources);
        foreach ($string as $source) {
            $source = explode('|', $source);
            $sr = new Source();
            $sr->source = $source[0];
            if (isset($source[1])) {
                $sr->link = $source[1];
            }

            $sr->monument_id = $monument->id;
            $sr->save();
        }

        if ($request->file('files')) {
            foreach ($request->file('files') as $photo) {
                $photoModel = new Photo();
                $photoModel->monument_id = $monument->id;
                $name = 'storage/' . $photo->store('public/monuments');
                $photoModel->file_name = str_replace('public/', '', $name);
                $photoModel->save();
            }
        }

        return redirect()->action('MonumentController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('monuments.show')->with('monument', Monument::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addComment(Request $request)
    {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->monument_id = $request->monument_id;
        $comment->content = $request->text;
        if (!empty($comment->content)) {
            $comment->save();
        }
        return redirect()->action('MonumentController@show', ['id' => $request->monument_id]);
    }
}
