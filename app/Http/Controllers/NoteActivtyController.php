<?php

namespace App\Http\Controllers;

use App\Note;
use App\Activity;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class NoteActivtyController extends Controller
{
    public function postNote(Request $request, Response $response)
    {
    	$note = Note::create($request->all());

    	if ($note) {
    	    return response()->json(['message' => 'Success'], 201);
    	}

    	return response()->json(['message' => 'Failed'], 302); 
    }
}
