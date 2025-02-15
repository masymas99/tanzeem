<x-layout title="Settings">
    <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600">Settings</h1>
    <div class="flex justify-center mt-5">
        <form action="{{ route('settings.store') }}" method="POST">
            @csrf
            <div class="mb-3 text-right">
                <label for="desD" class="form-label">يوم الخصم</label>
                <input type="text" class="form-control text-right" id="desD" name="desD" required>
            </div>
            <div class="mb-3 text-right">
                <label for="desH" class="form-label">ساعة الخصم</label>
                <input type="text" class="form-control text-right" id="desH" name="desH" required>
            </div>
            <div class="mb-3 text-right">
                <label for="addH" class="form-label">ساعة الإضافي</label>
                <input type="text" class="form-control text-right" id="addH" name="addH" required>
            </div>
            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">Save </button>

        </form>
    </div>

</x-layout>

