document.addEventListener('DOMContentLoaded', function() {
    // Create floating chat button element
    const floatingButton = document.createElement('div');
    floatingButton.className = 'floating-chat-button';
    floatingButton.innerHTML = '<i class="fas fa-comments"></i>';
    floatingButton.style.display = 'flex';
    floatingButton.style.opacity = '0';
    document.body.appendChild(floatingButton);

    // Fade in animation
    setTimeout(() => {
        floatingButton.style.opacity = '1';
    }, 300);

    // Remove toggle button since we want the chat icon to show directly
    const toggleChatButton = document.getElementById('toggle-chat-button');
    if (toggleChatButton) {
        toggleChatButton.remove();
    }

    // Create chat modal container with enhanced UI
    const chatModal = document.createElement('div');
    chatModal.className = 'chat-modal';
    chatModal.style.display = 'none';
    chatModal.innerHTML = `
        <div class="chat-modal-content">
            <div class="chat-modal-header">
                <div class="chat-modal-title">
                    <div class="chat-avatar pulse">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div>
                        <h3>مساعد تنظيم الذكي</h3>
                        <p>كيف يمكنني مساعدتك اليوم؟</p>
                    </div>
                </div>
                <div class="chat-modal-close">
                    <i class="fas fa-xmark"></i>
                </div>
            </div>
            <div class="chat-modal-body">
                <div id="modal-messages-container" class="messages-container">
                    <!-- Messages will be inserted here -->
                </div>
            </div>
            <div class="chat-modal-footer">
                <form id="modal-chat-form" class="chat-form">
                    <input type="text" id="modal-message-input" class="message-input" placeholder="اكتب رسالتك هنا..." autocomplete="off">
                    <button type="submit" id="modal-send-button" class="send-button">
                        <i class="fas fa-paper-plane fa-fw"></i>
                    </button>
                </form>
            </div>
        </div>
    `;
    document.body.appendChild(chatModal);

    // Add CSS for chat modal
    const modalStyle = document.createElement('style');
    modalStyle.textContent = `
        .chat-modal {
            position: fixed;
            bottom: 110px;
            right: 30px;
            width: 380px;
            height: 520px;
            z-index: 999;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            opacity: 0;
            transform: translateY(20px) scale(0.95);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .chat-modal.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .chat-modal-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            background-color: white;
        }

        .chat-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px;
            background: linear-gradient(135deg, #6A5DCF, #4f46e5);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .chat-modal-title {
            display: flex;
            align-items: center;
        }

        .chat-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .chat-avatar i {
            font-size: 22px;
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.2));
        }

        .chat-modal-title h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .chat-modal-title p {
            margin: 0;
            font-size: 13px;
            opacity: 0.9;
            margin-top: 3px;
        }

        .chat-modal-close {
            font-size: 24px;
            cursor: pointer;
            opacity: 0.8;
            transition: all 0.2s ease;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .chat-modal-close:hover {
            opacity: 1;
            background-color: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .chat-modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #f8fafc;
            background-image: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)),
                            url('data:image/svg+xml;utf8,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect width="20" height="20" fill="none"/><circle cx="3" cy="3" r="1" fill="%23e2e8f0"/></svg>');
            background-size: 20px 20px;
        }

        .chat-modal-footer {
            padding: 12px 18px;
            border-top: 1px solid #e2e8f0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .chat-form {
            display: flex;
            gap: 10px;
        }

        .message-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            direction: rtl;
        }

        .message-input:focus {
            outline: none;
            border-color: #6A5DCF;
            box-shadow: 0 0 0 2px rgba(106, 93, 207, 0.2);
        }

        .send-button {
            background: #6A5DCF;
            color: white;
            border: none;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .send-button:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }

        .send-button:active {
            transform: translateY(1px);
        }

        .send-button i {
            font-size: 16px;
        }
    `;
    document.head.appendChild(modalStyle);

    // Toggle chat modal when floating button is clicked
    floatingButton.addEventListener('click', function() {
        if (chatModal.style.display === 'none') {
            chatModal.style.display = 'block';
            // Add visible class after a small delay to trigger animation
            setTimeout(() => {
                chatModal.classList.add('visible');
            }, 10);
            // Initialize chat if it's the first time opening
            initializeModalChat();
        } else {
            // Remove visible class first to trigger animation
            chatModal.classList.remove('visible');
            // Hide modal after animation completes
            setTimeout(() => {
                chatModal.style.display = 'none';
            }, 300);
        }
    });

    // Close chat modal when close button is clicked
    const closeButton = chatModal.querySelector('.chat-modal-close');
    closeButton.addEventListener('click', function() {
        // Remove visible class first to trigger animation
        chatModal.classList.remove('visible');
        // Hide modal after animation completes
        setTimeout(() => {
            chatModal.style.display = 'none';
        }, 300);
    });



    // Initialize chat in modal
    let modalChatInitialized = false;
    function initializeModalChat() {
        if (modalChatInitialized) return;

        const messagesContainer = document.getElementById('modal-messages-container');
        const chatForm = document.getElementById('modal-chat-form');
        const messageInput = document.getElementById('modal-message-input');
        const sendButton = document.getElementById('modal-send-button');

        // Chat state
        let chatHistory = [];
        let isWaitingForResponse = false;

        // Show welcome message
        showWelcomeMessage();

        // Handle form submission
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });

        // Send message function
        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message || isWaitingForResponse) return;

            // Clear welcome message if present
            const welcomeContainer = messagesContainer.querySelector('.welcome-container');
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
            // Get CSRF token with fallback
            let csrfToken = '';
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (csrfMeta) {
                csrfToken = csrfMeta.getAttribute('content');
            } else {
                // If CSRF token is not available, show an error message
                removeTypingIndicator();
                addAssistantMessage('Unable to process your request. Please try again on a page with proper authentication.');
                isWaitingForResponse = false;
                updateSendButtonState();
                return;
            }

            // Send AJAX request to server
            fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: message,
                    history: chatHistory
                })
            })
            .then(response => response.json())
            .then(data => {
                // Remove typing indicator
                removeTypingIndicator();

                // Add assistant response to chat
                if (data.error) {
                    addAssistantMessage('Sorry, I encountered an error: ' + data.error + '. Please try again.');
                } else {
                    addAssistantMessage(data.response);

                    // Add assistant response to history
                    chatHistory.push({ role: 'assistant', content: data.response });

                    // Limit history size to prevent it from growing too large
                    if (chatHistory.length > 20) {
                        chatHistory = chatHistory.slice(chatHistory.length - 20);
                    }
                }

                // Reset waiting state
                isWaitingForResponse = false;
                updateSendButtonState();
            })
            .catch(error => {
                console.error('Error:', error);
                removeTypingIndicator();

                // Provide more specific error message based on the error type
                if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
                    addAssistantMessage('Unable to connect to the server. Please check your internet connection and try again.');
                } else {
                    addAssistantMessage('Sorry, I encountered an error processing your request. Please try again later.');
                }

                // Reset waiting state
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
                <div class="message-bubble">
                    <div class="message-content">
                        ${formatMessage(message)}
                    </div>
                    <div class="message-time">${timestamp}</div>
                </div>
                <div class="message-avatar user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            `;
            messagesContainer.appendChild(messageDiv);
            // Add animation class after a small delay
            setTimeout(() => {
                messageDiv.classList.add('message-visible');
            }, 10);
            scrollToBottom();
        }

        // Add assistant message to chat
        function addAssistantMessage(message) {
            const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const messageDiv = document.createElement('div');
            messageDiv.className = 'message assistant-message';
            messageDiv.innerHTML = `
                <div class="message-avatar assistant-avatar">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="message-bubble">
                    <div class="message-content">
                        <div class="markdown">${formatMessage(message)}</div>
                    </div>
                    <div class="message-time">${timestamp}</div>
                </div>
            `;
            messagesContainer.appendChild(messageDiv);
            // Add animation class after a small delay
            setTimeout(() => {
                messageDiv.classList.add('message-visible');
            }, 10);
            scrollToBottom();
        }

        // Show typing indicator
        function showTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message assistant-message';
            typingDiv.id = 'typing-indicator';
            typingDiv.innerHTML = `
                <div class="message-avatar assistant-avatar">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="message-bubble typing-bubble">
                    <div class="message-content typing-indicator">
                        <span class="typing-dot"></span>
                        <span class="typing-dot"></span>
                        <span class="typing-dot"></span>
                    </div>
                </div>
            `;
            messagesContainer.appendChild(typingDiv);
            // Add animation class after a small delay
            setTimeout(() => {
                typingDiv.classList.add('message-visible');
            }, 10);
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
            // First escape HTML to prevent XSS
            let formattedMessage = escapeHtml(message);

            // Convert markdown-like formatting
            formattedMessage = formattedMessage
                // Convert line breaks to <br>
                .replace(/\n/g, '<br>')
                // Bold text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                // Italic text
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                // Code blocks
                .replace(/```(.*?)```/gs, '<pre><code>$1</code></pre>')
                // Inline code
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
                <div class="welcome-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h2 class="welcome-title">مرحبًا بك في مساعد تنظيم الذكي</h2>
                <p class="welcome-subtitle">يمكنني مساعدتك في الإجابة على أسئلتك حول الحضور والإجازات والغيابات. كيف يمكنني مساعدتك اليوم؟</p>
                <div class="example-cards">
                    <div class="example-card">
                        <div class="example-icon"><i class="fas fa-calendar-check"></i></div>
                        <div class="example-title">تقارير الحضور</div>
                        <div class="example-text">أظهر لي تقرير حضور الموظفين لهذا الأسبوع</div>
                    </div>
                    <div class="example-card">
                        <div class="example-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="example-title">إدارة الإجازات</div>
                        <div class="example-text">كم عدد طلبات الإجازة المعلقة؟</div>
                    </div>
                    <div class="example-card">
                        <div class="example-icon"><i class="fas fa-user-clock"></i></div>
                        <div class="example-title">تقارير الغياب</div>
                        <div class="example-text">اعرض لي إحصائيات الغياب للشهر الحالي</div>
                    </div>
                </div>
            `;
            messagesContainer.appendChild(welcomeDiv);

            // Add click event listeners to example cards
            const exampleCards = welcomeDiv.querySelectorAll('.example-card');
            exampleCards.forEach(card => {
                card.addEventListener('click', function() {
                    const exampleText = this.querySelector('.example-text').textContent;
                    messageInput.value = exampleText;
                    sendMessage();
                });
            });
        }

        modalChatInitialized = true;
    }
});