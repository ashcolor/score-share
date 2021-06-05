<?php

namespace App\Http\Controllers;

use App\Models\Want;
use Illuminate\Http\Request;

class WantController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $want = new Want();

        $want->fill([
            'score_id' => $request->input('score_id'),
            'user_id' => 1,
        ])->save();


        if ($want) {
            return response(Want::query()->where('id', $want->id)->get(), 200);
        } else {
            return response([
                'message' => 'save failed',
                'code' => 404
            ], 404);
        }
    }

}
