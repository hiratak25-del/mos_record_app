<x-app-layout>
    <h1 class="text-blue-500 text-center font-bold text-3xl mt-5 mb-6">学習記録</h1>


    <div class="flex gap-5 w-1/2 mx-auto justify-center mb-8">
        <a class="text-white bg-blue-400 p-4 rounded-lg" href="{{ route('records.create') }}">
            学習記録を追加
        </a>
    </div>
     @if ($hasHighScore)
                    <div class="text-center mb-6">
                        <p class="text-green-500 font-bold text-xl">
                            おめでとうございます！正答率90％以上を達成しました！
                        </p>
                    </div>
                @endif
    <div class="w-5/6 mx-auto flex gap-8 justify-center mb-10">
        <table class="w- full border border-collapse text-center">
            <tr class="border">
                <th class="border py-2">学習日</th>
                <th class="border py-2">カテゴリ</th>
                <th class="border py-2">達成時間</th>
                <th class="border py-2">正答率</th>
                <th class="border py-2">学習時間</th>
                <th class="border py-2">メモ</th>
                <th class="border py-2">編集・削除</th>
            </tr>
            @foreach ($records as $record)
                <tr class="border">
                    <td class="border px-4 py-2">{{ $record->study_date }}</td>
                    <td class="border px-4 py-2">{{ $record->category }}</td>
                    <td class="border px-4 py-2">
                        {{ floor($record->test_time / 60) }}:{{ str_pad($record->test_time % 60, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="border px-4 py-2">{{ number_format($record->correct_rate, 0) }}%</td>
                    <td class="border px-4 py-2">{{ $record->minutes }}分</td>
                    <td class="border px-4 py-2">{{ $record->memo }}</td>
                    <td class=" p-4 border">
                        <div class="flex flex-col gap-3 items-center">
                            <a class="w-20 mx-auto bg-blue-300 py-1 px-4 rounded-lg block"
                                href="{{ route('records.edit', $record) }}">
                                編集
                            </a>
                            <form action="{{ route('records.destroy', $record) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="cursor-pointer w-20 bg-red-300 py-1 px-4 rounded-lg" type="submit">
                                    削除
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="pb-5">
        <div class="mx-auto flex justify-center">
            {{ $records->links() }}
        </div>
    </div>
</x-app-layout>