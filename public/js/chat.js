document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const messagesContainer = document.getElementById('messages-container');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');
    const sendButton = document.getElementById('send-button');

    // Chat state
    let chatHistory = [];
    let isWaitingForResponse = false;
    let searchResults = [];

    // Common questions suggestions
    const commonQuestions = [
        'كيف يمكنني تسجيل الحضور؟',
        'كيف يمكنني طلب إجازة؟',
        'ما هي ساعات العمل؟',
        'كيف يمكنني عرض سجل الحضور الخاص بي؟',
        'متى يتم دفع الراتب؟'
    ];

    // Initialize suggestions
    function initializeSuggestions() {
        const suggestionsContainer = document.createElement('div');
        suggestionsContainer.className = 'suggestions-container';
        suggestionsContainer.innerHTML = `
            <div class="suggestions-header">أسئلة شائعة:</div>
            <div class="suggestions-list">
                ${commonQuestions.map(q => `<div class="suggestion-item">${q}</div>`).join('')}
            </div>
        `;
        messagesContainer.parentElement.insertBefore(suggestionsContainer, messagesContainer);

        // Add click handlers
        document.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', () => {
                messageInput.value = item.textContent;
                sendMessage();
            });
        });
    }

    // Try to load chat history from meta tag
    try {
        const metaHistory = document.querySelector('meta[name="chat-history"]');
        if (metaHistory && metaHistory.content) {
            chatHistory = JSON.parse(metaHistory.content);

            // Display existing chat history if available
            if (chatHistory.length > 0) {
                chatHistory.forEach(message => {
                    if (message.role === 'user') {
                        addUserMessage(message.content);
                    } else if (message.role === 'assistant') {
                        addAssistantMessage(message.content);
                    }
                });
                scrollToBottom();
            }
        }
    } catch (error) {
        console.error('Error loading chat history:', error);
    }

    // If no history, show welcome message
    if (chatHistory.length === 0 && messagesContainer.children.length === 0) {
        showWelcomeMessage();
    }

    // Handle form submission and search
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage();
    });

    // Add search functionality
    messageInput.addEventListener('input', function(e) {
        const searchQuery = e.target.value.toLowerCase();
        if (searchQuery.startsWith('/search ')) {
            const query = searchQuery.replace('/search ', '');
            searchHistory(query);
        }
    });

    function searchHistory(query) {
        searchResults = chatHistory.filter(msg =>
            msg.content.toLowerCase().includes(query)
        );

        if (searchResults.length > 0) {
            showSearchResults();
        }
    }

    function showSearchResults() {
        const resultsContainer = document.createElement('div');
        resultsContainer.className = 'search-results';
        resultsContainer.innerHTML = `
            <div class="search-results-header">نتائج البحث:</div>
            ${searchResults.map(msg => `
                <div class="search-result-item ${msg.role}">
                    <div class="search-result-content">${msg.content}</div>
                </div>
            `).join('')}
        `;

        const existingResults = document.querySelector('.search-results');
        if (existingResults) {
            existingResults.remove();
        }

        messagesContainer.parentElement.insertBefore(resultsContainer, messagesContainer);
    }

    // Initialize suggestions when DOM is loaded
    initializeSuggestions();

    // Send message function
    function sendMessage() {
        const message = messageInput.value.trim();
        if (!message || isWaitingForResponse) return;

        // Clear welcome message if present
        const welcomeContainer = document.querySelector('.welcome-container');
        if (welcomeContainer) {
            welcomeContainer.remove();
        }

        // Add user message to UI
        addUserMessage(message);

        // Clear input field
        messageInput.value = '';

        // Add to chat history
        chatHistory.push({ role: 'user', content: message });

        // Show typing indicator
        showTypingIndicator();

        // Set waiting state
        isWaitingForResponse = true;
        updateSendButtonState();

        // Process the message and get response
        processUserMessage(message);
    }

    // Process user message and get response from server
    function processUserMessage(message) {
        // Check if CSRF token exists
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            removeTypingIndicator();
            addAssistantMessage('عذراً، لا يمكن إرسال الرسالة. يرجى تحديث الصفحة والمحاولة مرة أخرى.');
            isWaitingForResponse = false;
            updateSendButtonState();
            return;
        }

        fetch('/chat/message', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                message: message,
                history: chatHistory
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            removeTypingIndicator();

            if (data.error) {
                if (data.error.includes('No employee record found')) {
                    addAssistantMessage('لا يمكنني الوصول إلى معلومات الموظف الخاصة بك. يرجى الاتصال بقسم الموارد البشرية للتأكد من ربط بريدك الإلكتروني بشكل صحيح بملف الموظف الخاص بك في النظام.');
                } else {
                    addAssistantMessage('عذراً، حدث خطأ: ' + data.error + '. يرجى المحاولة مرة أخرى.');
                }
            } else if (!data.response) {
                addAssistantMessage('عذراً، لم يتم استلام رد من الخادم. يرجى المحاولة مرة أخرى.');
            } else {
                addAssistantMessage(data.response);
                chatHistory.push({ role: 'assistant', content: data.response });

                if (chatHistory.length > 20) {
                    chatHistory = chatHistory.slice(chatHistory.length - 20);
                }
            }

            isWaitingForResponse = false;
            updateSendButtonState();
        })
        .catch(error => {
            console.error('Error:', error);
            removeTypingIndicator();

            let errorMessage = 'عذراً، حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.';
            if (error.message.includes('HTTP error!')) {
                errorMessage = 'عذراً، لا يمكن الاتصال بالخادم. يرجى التحقق من اتصال الإنترنت والمحاولة مرة أخرى.';
            } else if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
                errorMessage = 'عذراً، فشل الاتصال بالخادم. يرجى التحقق من اتصال الإنترنت والمحاولة مرة أخرى.';
            }

            addAssistantMessage(errorMessage);
            isWaitingForResponse = false;
            updateSendButtonState();
        });
    }

    // Add user message to chat
    function addUserMessage(message) {
        const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message user-message';
        messageDiv.innerHTML = `
            <div class="message-content">
                ${formatMessage(message)}
            </div>
            <div class="message-time">${timestamp}</div>
        `;
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    // Add assistant message to chat
    function addAssistantMessage(message) {
        const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message assistant-message';
        messageDiv.innerHTML = `
            <div class="message-content">
                <div class="markdown">${formatMessage(message)}</div>
            </div>
            <div class="message-time">${timestamp}</div>
        `;
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    // Show typing indicator
    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message assistant-message';
        typingDiv.id = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="message-content typing-indicator">
                <span class="typing-dot"></span>
                <span class="typing-dot"></span>
                <span class="typing-dot"></span>
            </div>
        `;
        messagesContainer.appendChild(typingDiv);
        scrollToBottom();
    }

    // Remove typing indicator
    function removeTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    // Format message (convert markdown, escape HTML, etc.)
    function formatMessage(message) {
        let formattedMessage = escapeHtml(message);

        formattedMessage = formattedMessage
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/```(.*?)```/gs, '<pre><code>$1</code></pre>')
            .replace(/`(.*?)`/g, '<code>$1</code>');

        return formattedMessage;
    }

    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Scroll to bottom of messages container
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Update send button state
    function updateSendButtonState() {
        sendButton.disabled = isWaitingForResponse;
        sendButton.classList.toggle('opacity-50', isWaitingForResponse);
    }

    // Show welcome message
    function showWelcomeMessage() {
        const welcomeDiv = document.createElement('div');
        welcomeDiv.className = 'welcome-container';
        welcomeDiv.innerHTML = `
            <h2 class="welcome-title">Welcome to Tanzeem AI Assistant</h2>
            <p class="welcome-subtitle">I can help you with questions about your attendance, leave, and absences. How can I assist you today?</p>
            <div class="example-cards">
                <div class="example-card">
                    <div class="example-title">Attendance Summary</div>
                    <div class="example-text">What was my attendance last week?</div>
                </div>
                <div class="example-card">
                    <div class="example-title">Leave Balance</div>
                    <div class="example-text">How many leave days do I have remaining?</div>
                </div>
                <div class="example-card">
                    <div class="example-title">Absence Records</div>
                    <div class="example-text">Show me my absences for this month</div>
                </div>
            </div>
        `;
        messagesContainer.appendChild(welcomeDiv);

        const exampleCards = welcomeDiv.querySelectorAll('.example-card');
        exampleCards.forEach(card => {
            card.addEventListener('click', function() {
                const exampleText = this.querySelector('.example-text').textContent;
                messageInput.value = exampleText;
                sendMessage();
            });
        });
    }
});
