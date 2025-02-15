<x-layout title="Weekly Holidays">
    <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600">Weekly Holidays</h1>
    <!-- #region -->
    <div class="d-flex flex-column align-items-center  justify-content-center">
        <form action="{{ route('weeklyHolidays.store') }}" method="POST">
            @csrf
            <div class=" d-flex  mb-3 text-right">
                <label for="day" class="form-label">Day</label>
                <select id="day" name="day" class="form-select @error('day') is-invalid @enderror" required>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                </select>
                @error('day')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="d-flex align-self-center btn btn-primary mt-3">Save</button>

        </form>
    </div>
</x-layout>
