<?php

namespace App\Http\Controllers;
use App\Models\Record;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {

        $records = Record::where('user_id', auth()->id())->paginate(5);

        $hasHighScore = Record::where('user_id', auth()->id())
            ->where('correct_rate', '>=', 90)
            ->exists();

        $weeklyRecords = Record::where('user_id', auth()->id())
            ->whereBetween('study_date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ])
            ->get();

        $weeklyTotal = $weeklyRecords->count();

        $weeklyHighScore = $weeklyRecords
            ->where('correct_rate', '>=', 90)
            ->count();

        $weeklyAchievementRate = $weeklyTotal > 0
            ? ($weeklyHighScore / $weeklyTotal) * 100
            : 0;
        return view(
            'dashboard',
            compact(
                'records',
                'hasHighScore',
                'weeklyTotal',
                'weeklyHighScore',
                'weeklyAchievementRate'
            ));
    }
}
