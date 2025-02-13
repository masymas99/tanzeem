<x-layout title="Employee">


    <form class="max-w-sm mx-auto mt-10">
        <div>
            <div class="mb-5 ">
                <label dir="rtl"  for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الـأسم</label>
                <input dir="rtl"  type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="ادخل الاسم" required />
            </div>
            <div class="mb-5">
                <label dir="rtl"  for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الـعنوان</label>
                <input dir="rtl"  type="email" id="email" name="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="البريد الالكتروني" required />
            </div>
            <div class="mb-5">
                <label dir="rtl"  for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">رقم الـتلفون</label>
                <input dir="rtl"  type="tel" id="phone" name="phone"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="0123456789" required />
            </div>
            <div class="mb-5">
                <label dir="rtl"  for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الـجنسية</label>
                <input dir="rtl"  type="text" id="nationality" name="nationality"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="ادخل الجنسية" required />
            </div>   <div class="mb-5">
                <label dir="rtl"   for="national_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الـرقم القومي</label>
                <input dir="rtl"  type="text" id="national_id" name="national_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="01234567890123" required />
            </div>



            <div class="relative max-w-sm">
                <label dir="rtl"  for="datepicker-autohide" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تاريخ الميلاد</label>
                <div class="absolute inset-y-0 left-0 flex items-center px-3 pointer-events-none">
                    <svg class="mt-6 w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input dir="rtl"  id="datepicker-autohide" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="تاريخ الميلاد">
            </div>



            <label for="countries" dir="rtl"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">الـنوع</label>
            <select id="countries" dir="rtl" name="gender"
                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>الـنوع</option>
                <option value="male">ذكر</option>
                <option value="female">أنثي</option>

            </select>
        </div>
        <div>

        </div>


        <button type="submit "
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>


</x-layout>
