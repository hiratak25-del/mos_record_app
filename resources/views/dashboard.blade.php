<x-app-layout>
 <h1 class="text-blue-500 text-center font-bold text-3xl mt-5 mb-6">MOS模擬試験記録システム</h1>
 <p class="text-center">ようこそ<span class="text-xl font-bold text-green-400">{{ Auth::user()->name }}</span>さん！</p>
 <p class="text-center">今日も頑張りましょう！</p>

 <div class="text-center mb-6">
    <p>今週の学習回数：{{ $weeklyTotal }}回</p>
    <p>90％以上達成：{{ $weeklyHighScore }}回</p>
    <p>
        90％以上達成率：
        {{ number_format($weeklyAchievementRate, 0) }}%
    </p>
</div>
 <div class="flex gap-5 w-1/2 mx-auto justify-center mt-5 mb-8">
        <a class="text-white bg-blue-400 p-4 rounded-lg" href="{{ route('records.index') }}">
            学習記録一覧へ
        </a>
    </div>

</x-app-layout>
