<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AI Chat Assistant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Welcome to the AI Chat Assistant. You can ask questions about attendance, leave,
                        and other HR-related matters for any employee in the company.</p>
                    <p class="mb-4">The chat assistant has access to the entire database and can provide information
                        about all employees.</p>
                    <p class="mb-8">Click the chat button in the bottom right corner to start chatting.</p>

                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <h3 class="font-semibold text-lg text-blue-800 mb-2">Example Questions</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>Show me the attendance statistics for all employees this month</li>
                            <li>Who has the highest absence rate in the company?</li>
                            <li>Compare attendance rates between departments</li>
                            <li>Which employee worked the most hours last month?</li>
                            <li>Show me leave patterns across the company</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set data attribute to show chat on this page
        document.body.setAttribute('data-show-chat', 'true');

        // Trigger click on floating button after a short delay
        setTimeout(() => {
            const floatingButton = document.querySelector('.floating-chat-button');
            if (floatingButton) {
                floatingButton.click();
            }
        }, 1000);
    });
</script>
