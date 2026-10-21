<x-app-layout>
    <h1 class="text-gray-500 font-bold text-3xl text-center my-5">記録入力</h1>

    <form action="{{ route('records.store') }}" method="post">
        @csrf

        <div class="max-w-2xl mx-auto w flex gap-5 justify-center mb-5 h-10">
            <label class="w-1/3 bg-blue-300 py-2 px-4 rounded-lg text-center">学習日</label>
            <input class="w-2/3 border pl-2" type="date" name="study_date" value="{{ old('study_date') }}">
            @error('study_date')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="max-w-2xl mx-auto flex gap-5 justify-center mb-5 h-10">
            <label class="w-1/3 bg-blue-300 py-2 px-4 rounded-lg text-center">カテゴリ</label>
            <select class="w-2/3 border pl-2" name="category" id="category">
                <option value="">選択してください</option>
                <option value="Word_Specialist">Word_Specialist</option>
                <option value="Excel_Specialist">Excel_Specialist</option>
                <option value="Word_Expert">Word_Expert</option>
                <option value="Excel_Expert">Excel_Expert</option>
                <option value="Power_point">Power_point</option>
                <option value="Other">Other</option>
            </select>
            @error('category')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mx-auto max-w-2xl flex gap-5 justify-center mb-5 h-10">
            <label class="w-1/3 bg-blue-300 py-2 px-4 rounded-lg text-center">達成時間(分)</label>
            <input class="w-2/3 border pl-2" type="text" name="test_time" placeholder="
            00:00" value="{{ old('test_time') }}">
            @error('test_time')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mx-auto max-w-2xl flex gap-5 justify-center mb-5 h-10">
            <label class="w-1/3 bg-blue-300 py-2 rounded-lg text-center">
                正答率(%)
            </label>

            <input class="w-2/3 border pl-2" type="number" name="correct_rate" min="0" max="100"
                value="{{ old('correct_rate') }}">

            @error('correct_rate')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mx-auto max-w-2xl flex gap-5 justify-center mb-5 h-10">
            <label class="w-1/3 bg-blue-300 py-2 px-4 rounded-lg text-center">学習時間（分）</label>
            <input class="w-2/3 border pl-2" type="number" name="minutes" value="{{ old('minutes') }}">
            @error('minutes')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mx-auto max-w-2xl flex gap-5 justify-center mb-5">
            <label class="w-1/3 bg-blue-300 py-2 px-4 rounded-lg text-center h-10">メモ</label>
            <textarea class="w-2/3 border pl-2 h-20" name="memo">{{ old('memo') }}</textarea>
        </div>

        <div class="pb-5">
            <button
                class="bg-green-400 text-white py-2 px-4 rounded-lg text-center mx-auto justify-center block cursor-pointer"
                type="submit">登録する</button>
        </div>

    </form>
</x-app-layout>