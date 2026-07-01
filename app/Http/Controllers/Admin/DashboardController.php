<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\History;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $criteria_count = Criteria::count();
        $alternative_count = Alternative::count();
        $history_count = History::count();

        return view('admin.dashboard', compact('criteria_count', 'alternative_count', 'history_count'));
    }
}
