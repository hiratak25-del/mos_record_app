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

             $achievementMessage = null;

        $weeklyAchievementRate = $weeklyTotal > 0
            ? ($weeklyHighScore / $weeklyTotal) * 100
            : 0;

           if ( $weeklyAchievementRate >=50){
             $achievementMessage = 'これからも頑張りましょう！';
           } elseif( $achievementMessage >=70){
             $achievementMessage = 'もう少し頑張りましょう';
           }elseif( $achievementMessage >=90){
             $achievementMessage = 'この調子でいきましょう！！';
           }
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
