<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        try {
            $states = State::select(['id', 'state'])->get();
            
            return formatResponse(200, 'States Retrieved', true, $states);
        } catch (Exception $e) {
            info($e->getMessage()); //logs error message to console
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }
}
