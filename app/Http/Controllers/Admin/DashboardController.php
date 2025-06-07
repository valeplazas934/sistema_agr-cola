<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Cultivation;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $cultivationsCount = Cultivation::count();
        $categoriesCount = Category::count();

        return view('admin.dashboard', compact('usersCount', 'cultivationsCount', 'categoriesCount'));
    }

}


