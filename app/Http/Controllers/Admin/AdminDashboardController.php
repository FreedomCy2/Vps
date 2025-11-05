<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // GET /admin/dashboard
    public function index()
    {
        // returns resources\views\admin\dashboard.blade.php
        return view('admin.dashboard');
    }
}