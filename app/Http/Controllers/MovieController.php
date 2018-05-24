<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Movie;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Movie::search($request->title, $request->take, $request->skip));
        //return Movie::search($request->title, $request->take);

        $term = request()->input('term');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Movie::get()->count());

        if ($term) {
            return Movie::search($term, $skip, $take);
        } else {
            return Movie::skip($skip)->take($take)->get();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //   'title' => [
        //     'required',
        //      Rule::unique('movies')
        //       ->where('releaseDate', request('releaseDate'))
        //   ],
        //   'director'=>'required',
        //   'imageUrl' => 'url',
        //   'duration' => 'required | integer:min=1,max=500',
        //   'releaseDate' => 'required'
        // ]);
        $validator = Validator::make($request->all(), [
          'title' => [
            'required',
             Rule::unique('movies')
              ->where('releaseDate', request('releaseDate'))
          ],
          'director'=>'required',
          'imageUrl' => 'url',
          'duration' => 'required|integer|min:1|max:500',
          'releaseDate' => 'required|date'
        ]);

        if ($validator->fails()) {
            //dd($validator);
            // return redirect('/api/movies/' . $request->id)
            //             ->withErrors($validator)
            //             ->withInput();
            //abort(422);
            return response()->json($validator->errors(), 422);
        }

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();
        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::find($id);
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
         $this->validate($request,[
         'title'=>'required',
         'director'=>'required',
         'imageUrl' => 'url',
         'duration' => 'required|integer|min:1|max:500',
         'releaseDate' => 'required|date'
      ]);

      if ($validator->fails()) {
            //dd($validator);
            // return redirect('/api/movies/' . $request->id)
            //             ->withErrors($validator)
            //             ->withInput();
            return response()->json($validator->errors(), 422);
        }

        $movie = Movie::find($id);
        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->imageUrl = $request->input('imageUrl');
        $movie->duration = $request->input('duration');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->genre = $request->input('genre');

        $movie->save();
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return new JsonResponse(true);
    }
}
