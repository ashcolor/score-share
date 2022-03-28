<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScoreResource;
use App\Models\Score;
use App\Models\Want;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{

    public function index(Request $request)
    {
        $searchSelected = $request->input('searchSelected');
        $search = $request->input('search');

        $query = Score::query();

        if ($search) {
            $query->where($searchSelected, 'like', "%$search%");
        }

        $scores = $query->orderBy('updated_at', 'DESC')->paginate(25);
        ScoreResource::collection($scores);
        return response($scores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $score = new Score();

        $score->fill(
            array_merge($request->input(), [
                'score_created_by' => 1,
            ])
        )->save();

        if ($score) {
            return response(Score::query()->where('id', $score->id)->get(), 200);
        } else {
            return response([
                'message' => 'save failed',
                'code' => 404
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
