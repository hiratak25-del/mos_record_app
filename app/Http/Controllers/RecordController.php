<?php

namespace App\Http\Controllers;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {

        $records = Record::where('user_id', auth()->id())->paginate(5);

        $latestRecord = Record::where('user_id', auth()->id())
            ->latest('created_at')
            ->first();

        $hasHighScore = $latestRecord && $latestRecord->correct_rate >= 90;

        return view(
            'records.index',
            compact(
                'records',
                'hasHighScore',
            )
        );
    }

    public function create()
    {


        return view('records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'study_date' => ['required', 'date'],
            'category' => ['required'],
            'test_time' => ['required', 'date_format:i:s'],
            'correct_rate' => ['required', 'integer', 'min:0', 'max:100'],
            'minutes' => ['required', 'integer', 'min:1'],
            'memo' => ['nullable'],
        ], [
            'study_date.required' => '日付は必ず入力してください',
            'study_date/date' => '正しい日付を入力してください',
            'category.required' => 'カテゴリは必ず選択してください',
            'test_time.required' => '達成時間は必ず入力してください',
            'minutes.required' => '学習時間は必ず入力してください。',
            'minutes.integer' => '学習時間は整数で入力してください。',
            'minutes.min' => '学習時間は1分以上で入力してください。',
        ]);

        [$minutes, $seconds] = explode(':', $request->test_time);

        $totalSeconds = ($minutes * 60) + $seconds;

        $record = Record::create([
            'user_id' => auth()->id(),
            'study_date' => $request->study_date,
            'category' => $request->category,
            'test_time' => $totalSeconds,
            'correct_rate' => $request->correct_rate,
            'minutes' => $request->minutes,
            'memo' => $request->memo,
        ]);
        return redirect()->route('records.index');
    }

    public function edit(Record $record)
    {
        if ($record->user_id !== auth()->id()) {
            abort(403);
        }
        return view('records.edit', compact('record'));
    }

    public function update(Request $request, Record $record)
    {
        $validate = $request->validate(
            [
                'study_date' => ['required', 'date'],
                'category' => ['required', 'in:Word_Specialist,Excel_Specialist,Word_Expert,Excel_Expert,Power_point,Other'],
                'test_time' => ['required', 'date_format:i:s'],
                'correct_rate' => ['required', 'integer', 'min:0', 'max:100'],
                'minutes' => ['required', 'integer', 'min:1'],
                'memo' => ['nullable'],
            ],
            [
                'study_date.required' => '日付は必ず入力してください',
                'study_date/date' => '正しい日付を入力してください',
                'category.required' => 'カテゴリは必ず選択してください',
                'test_time.required' => '達成時間は必ず入力してください',
                'minutes.required' => '学習時間は必ず入力してください。',
                'minutes.integer' => '学習時間は整数で入力してください。',
                'minutes.min' => '学習時間は1分以上で入力してください。',
            ]
        );
        if ($record->user_id !== auth()->id()) {
            abort(403);
        }

        // 「分:秒」を秒数に変換
        [$minutes, $seconds] = explode(':', $request->test_time);

        $totalSeconds = ($minutes * 60) + $seconds;

        $record->update([
            'study_date' => $request->study_date,
            'category' => $request->category,
            'test_time' => $totalSeconds,
            'correct_rate' => $request->correct_rate,
            'minutes' => $request->minutes,
            'memo' => $request->memo,
        ]);
        return redirect()->route('records.index');
    }

    public function destroy(Record $record)
    {
        if ($record->user_id !== auth()->id()) {
            abort(403);
        }

        $record->delete();
        return redirect()->route('records.index');
    }
}
