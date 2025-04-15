<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AI Chat Assistant') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="chat-history" content="{{ $chatHistory }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Modern Chat Interface -->
                    <div class="chat-container h-[600px]">
                        <!-- Chat Header -->
                        <div class="flex items-center p-4 border-b border-gray-200 bg-white">
                            <div
                                class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-lg">Tanzeem Assistant</h3>
                                <p class="text-sm text-gray-500">Attendance & Leave Support</p>
                            </div>
                        </div>

                        <!-- Messages Container -->
                        <div id="messages-container" class="messages-container">
                            <!-- Messages will be added here by JavaScript -->
                        </div>

                        <!-- Input Area -->
                        <div class="input-container">
                            <form id="chat-form" class="flex w-full items-center">
                                <input type="text" id="message-input" class="message-input"
                                    placeholder="Ask about your attendance, leave, or absences..." autocomplete="off">
                                <button type="submit" id="send-button" class="send-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
        <script src="{{ asset('js/chat.js') }}"></script>
    @endpush
</x-app-layout>
