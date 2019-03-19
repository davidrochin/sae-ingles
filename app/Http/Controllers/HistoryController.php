<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller {

    const DEFAULT_PARENT_ROUTE = 'history';

    public function showAll(Request $request) {

        return view('history', [
            'history' => History::orderBy('created_at', 'DESC')->paginate(12),
            'parentRoute' => HistoryController::DEFAULT_PARENT_ROUTE,
        ]);
    }
}
