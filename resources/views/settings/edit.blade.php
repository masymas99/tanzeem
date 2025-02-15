<x-layout title="Settings">
    <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600">Settings</h1>
    <div class="flex justify-center mt-5">
        <div class="w-96 bg-white p-10 rounded-lg shadow-md">
            <form method="POST" action="{{ route('settings.update',['setting' => $setting->id]) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="desD" class="block text-gray-700 font-bold mb-2">يوم الخصم</label>
                    <input type="text" class="form-control text-right" id="desD" name="desD" value="{{ old('desD', $setting->desD) }}" required>
                </div>
                <div class="mb-4">
                    <label for="desH" class="block text-gray-700 font-bold mb-2">ساعة الخصم</label>
                    <input type="text" class="form-control text-right" id="desH" name="desH" value="{{ old('desH', $setting->desH) }}" required>
                </div>
                <div class="mb-4">
                    <label for="addH" class="block text-gray-700 font-bold mb-2">ساعة الإضافي</label>
                    <input type="text" class="form-control text-right" id="addH" name="addH" value="{{ old('addH', $setting->addH) }}" required>
                </div>
                <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">Save </button>

            </form>
        </div>
    </div>

</x-layout>

