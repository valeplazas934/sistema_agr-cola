<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\CultivationPublication;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $cultivationsCount = CultivationPublication::count();
        $categoriesCount = Category::count();

        // Si necesitas usar también variables con el prefijo "total"
        $totalUsers = $usersCount;
        $totalCultivations = $cultivationsCount;
        $totalCategories = $categoriesCount;

        return view('admin.dashboard', compact(
            'usersCount',
            'cultivationsCount',
            'categoriesCount',
            'totalUsers',
            'totalCultivations',
            'totalCategories'
        ));
    }
}