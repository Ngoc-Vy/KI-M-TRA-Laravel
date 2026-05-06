<!-- Floating Chat Bubble Partial -->
<style>
    .chat-bubble-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
    }

    .chat-bubble-main {
        width: 60px;
        height: 60px;
        background-color: var(--primary-gold);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        animation: pulse-gold 2s infinite;
    }

    @keyframes pulse-gold {
        0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(212, 175, 55, 0); }
        100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
    }

    .chat-bubble-main:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.6);
        animation: none;
    }

    .chat-options {
        position: absolute;
        bottom: 75px;
        right: 0;
        display: flex;
        flex-direction: column;
        gap: 15px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .chat-options.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .chat-option-item {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .chat-option-item:hover {
        transform: scale(1.1);
    }

    .option-messenger { background-color: #0084ff; }
    .option-zalo { background-color: #0068ff; }
    .option-phone { background-color: #4caf50; }

    .chat-tooltip {
        position: absolute;
        right: 65px;
        background: white;
        color: #333;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        white-space: nowrap;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        pointer-events: none;
        opacity: 0;
        transition: 0.3s;
    }

    .chat-option-item:hover .chat-tooltip {
        opacity: 1;
        right: 75px;
    }
</style>

<div class="chat-bubble-container">
    <div class="chat-options" id="chatOptions">
        <a href="https://m.me/yourpage" target="_blank" class="chat-option-item option-messenger">
            <i class="fa-brands fa-facebook-messenger"></i>
            <span class="chat-tooltip">Messenger</span>
        </a>
        <a href="https://zalo.me/0905350949" target="_blank" class="chat-option-item option-zalo">
            <i class="fa-solid fa-comment-dots"></i>
            <span class="chat-tooltip">Zalo</span>
        </a>
        <a href="tel:0905350949" class="chat-option-item option-phone">
            <i class="fa-solid fa-phone"></i>
            <span class="chat-tooltip">Hotline</span>
        </a>
    </div>
    <div class="chat-bubble-main" id="chatBubbleMain">
        <i class="fa-solid fa-comments"></i>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatBubbleMain = document.getElementById('chatBubbleMain');
        const chatOptions = document.getElementById('chatOptions');
        
        chatBubbleMain.addEventListener('click', () => {
            chatOptions.classList.toggle('active');
            const icon = chatBubbleMain.querySelector('i');
            if (chatOptions.classList.contains('active')) {
                icon.classList.remove('fa-comments');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-comments');
            }
        });

        document.addEventListener('click', (e) => {
            if (!chatBubbleMain.contains(e.target) && !chatOptions.contains(e.target)) {
                chatOptions.classList.remove('active');
                const icon = chatBubbleMain.querySelector('i');
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-comments');
            }
        });
    });
</script>
