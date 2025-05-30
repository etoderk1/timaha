<?php
// Счетчик просмотров
$viewsFile = 'views.txt';
$views = file_exists($viewsFile) ? (int)file_get_contents($viewsFile) : 0;
$views++;
file_put_contents($viewsFile, $views);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>timaha</title>
    <link rel="icon" href="https://i.postimg.cc/GtqcTQkT/photo-2025-03-26-04-58-38.jpg" type="image/jpeg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap');
        
        :root {
            --theme-color: #ffffff;
            --theme-dark: #cccccc;
            --primary-text: #ffffff;
            --secondary-text: #b0b0b0;
            --bg-color: #000000;
            --box-color: rgba(30, 30, 30, 0.7);
            --box-spacing: 35px;
            --box-radius: 15px;
            --box-blur: 20px;
            --border-color: rgba(255, 255, 255, 0.2);
            --border-width: 1px;
            --avatar-radius: 50px;
            --text-glow: 0 0 8px rgba(255, 255, 255, 0.3);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Unbounded', sans-serif;
            background-color: var(--bg-color);
            color: var(--primary-text);
            min-height: 100vh;
            overflow-x: hidden;
            background-image: 
                linear-gradient(135deg, 
                    rgba(255, 255, 255, 0.02) 0%, 
                    rgba(0, 0, 0, 0) 20%, 
                    rgba(255, 255, 255, 0.02) 40%, 
                    rgba(0, 0, 0, 0) 60%,
                    rgba(255, 255, 255, 0.02) 80%,
                    rgba(0, 0, 0, 0) 100%);
            background-size: 300% 300%;
            animation: gradientFlow 15s ease infinite;
        }
        
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background: rgba(30, 30, 30, 0.5);
            backdrop-filter: blur(10px);
            border-radius: var(--box-radius);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            text-align: center;
            max-width: 300px;
            width: 90%;
            animation: fadeIn 0.5s ease;
        }
        
        .modal-title {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: var(--theme-color);
            text-shadow: var(--text-glow);
            opacity: 0.8;
        }
        
        .modal-button {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--theme-color);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-family: 'Unbounded', sans-serif;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            opacity: 0.7;
        }
        
        .modal-button:hover {
            opacity: 1;
            background: rgba(255, 255, 255, 0.1);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .main-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            z-index: 1;
        }
        
        .profile-card {
            background: var(--box-color);
            backdrop-filter: blur(var(--box-blur));
            border-radius: var(--box-radius);
            border: var(--border-width) solid var(--border-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: var(--transition);
            max-width: 500px;
            margin: 0 auto;
            transform-style: preserve-3d;
            perspective: 1000px;
            transform: perspective(1000px) rotateX(0) rotateY(0);
            position: relative;
        }
        
        .profile-card:hover {
            transform: perspective(1000px) rotateY(10deg) rotateX(5deg) translateZ(20px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
        }
        
        .profile-card:hover::before {
            opacity: 0.3;
        }
        
        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at var(--mouse-x) var(--mouse-y), 
                rgba(255, 255, 255, 0.2) 0%, 
                transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
            z-index: 0;
        }
        
        .banner {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: var(--border-width) solid var(--border-color);
            position: relative;
            z-index: 1;
        }
        
        .profile-content {
            padding: var(--box-spacing);
            position: relative;
            margin-top: -70px;
            z-index: 1;
        }
        
        .avatar-container {
            position: relative;
            width: fit-content;
            margin: 0 auto;
            z-index: 1;
        }
        
        .avatar {
            width: 140px;
            height: 140px;
            border-radius: var(--avatar-radius);
            border: 2px solid var(--theme-color);
            object-fit: cover;
            box-shadow: var(--text-glow);
            transition: var(--transition);
            filter: grayscale(20%);
            position: relative;
            z-index: 1;
        }
        
        .avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.5);
            filter: grayscale(0%);
        }
        
        .username {
            text-align: center;
            margin-top: 1rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--theme-color);
            text-shadow: var(--text-glow);
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            margin: 0.3rem;
            border: 1px solid var(--theme-color);
            transition: var(--transition);
            color: var(--theme-color);
            position: relative;
            z-index: 1;
        }
        
        .badge:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .badges-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 1.5rem 0;
            position: relative;
            z-index: 1;
        }
        
        .description {
            text-align: center;
            margin: 2rem 0;
            font-family: 'Montserrat', sans-serif;
            line-height: 1.8;
            color: var(--secondary-text);
            position: relative;
            z-index: 1;
        }
        
        .theme-text {
            color: var(--theme-color);
            font-weight: 600;
            text-shadow: var(--text-glow);
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--theme-color), transparent);
            margin: 1.5rem auto;
            opacity: 0.2;
            width: 80%;
            position: relative;
            z-index: 1;
        }
        
        .location {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin: 1rem 0;
            color: var(--secondary-text);
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }
        
        .views-counter {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin: 0.5rem 0;
            color: var(--secondary-text);
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 2rem 0;
            position: relative;
            z-index: 1;
        }
        
        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
            position: relative;
            z-index: 1;
        }
        
        .social-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }
        
        .social-link svg {
            width: 20px;
            height: 20px;
            fill: white;
        }
        
        .tooltip {
            position: absolute;
            top: -40px;
            background: rgba(0, 0, 0, 0.8);
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            font-size: 0.8rem;
            opacity: 0;
            transition: var(--transition);
            pointer-events: none;
            white-space: nowrap;
        }
        
        .social-link:hover .tooltip {
            opacity: 1;
            transform: translateY(-5px);
        }
        
        .music-player {
            background: rgba(0, 0, 0, 0.3);
            border-radius: var(--box-radius);
            padding: 1rem;
            margin-top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 1;
        }
        
        .player-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .play-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--theme-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .play-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }
        
        .play-btn svg {
            width: 16px;
            height: 16px;
            fill: var(--theme-color);
        }
        
        .volume-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
        }
        
        .volume-control svg {
            width: 16px;
            height: 16px;
            fill: var(--secondary-text);
        }
        
        .volume-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            outline: none;
        }
        
        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--theme-color);
            cursor: pointer;
        }
        
        .song-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .song-title {
            font-size: 0.9rem;
            color: var(--theme-color);
        }
        
        .song-time {
            font-size: 0.8rem;
            color: var(--secondary-text);
        }
        
        .progress-container {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            margin-top: 0.5rem;
            cursor: pointer;
        }
        
        .progress-bar {
            height: 100%;
            background: var(--theme-color);
            border-radius: 2px;
            width: 0%;
            transition: width 0.1s linear;
        }
        
        .footer {
            text-align: center;
            margin-top: 3rem;
            padding: 1rem;
            font-size: 0.8rem;
            color: var(--secondary-text);
            opacity: 0.5;
        }
        
        .footer a {
            color: var(--theme-color);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer a:hover {
            text-shadow: var(--text-glow);
        }
        
        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }
            
            .profile-card {
                max-width: 100%;
            }
            
            .banner {
                height: 150px;
            }
            
            .avatar {
                width: 120px;
                height: 120px;
            }
            
            .username {
                font-size: 1.7rem;
            }
            
            .profile-content {
                padding: 1.5rem;
            }
            
            .badge {
                font-size: 0.7rem;
                padding: 0.2rem 0.6rem;
            }
            
            .social-links {
                gap: 1rem;
            }
            
            .music-player {
                padding: 0.8rem;
            }
            
            .modal-content {
                padding: 1.5rem;
            }
            
            .modal-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Модальное окно для включения звука -->
    <div class="modal-overlay" id="modal-overlay">
        <div class="modal-content">
            <h2 class="modal-title">Нажмите, чтобы продолжить</h2>
            <button class="modal-button" id="modal-button">Продолжить</button>
        </div>
    </div>

    <div class="main-container">
        <div class="profile-card" id="profile-card">
            <!-- Banner -->
            <img src="https://i.postimg.cc/N0mBkY6c/1-2.png" alt="Banner" class="banner">
            
            <div class="profile-content">
                <!-- Avatar -->
                <div class="avatar-container">
                    <img src="https://i.postimg.cc/GtqcTQkT/photo-2025-03-26-04-58-38.jpg" alt="Avatar" class="avatar">
                </div>
                
                <!-- Username -->
                <h1 class="username">timaha</h1>
                
                <!-- Badges -->
                <div class="badges-container">
                    <span class="badge">MINECRAFT</span>
                    <span class="badge">DEVELOPER</span>
                    <span class="badge">HVH</span>
                </div>
                
                <!-- Location -->
                <div class="location">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="var(--theme-color)">
                        <path d="M12 0c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z"></path>
                    </svg>
                    <span>Russia</span>
                </div>
                
                <!-- Views Counter -->
                <div class="views-counter">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="var(--theme-color)">
                        <path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"/>
                        <path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"/>
                    </svg>
                    <span id="views-count"><?= $views ?> просмотров</span>
                </div>
                
                <!-- Social Links -->
                <div class="social-links">
                    <a href="https://t.me/flourhaa" class="social-link" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"></path>
                        </svg>
                        <span class="tooltip">Telegram</span>
                    </a>
                    
                    <a href="https://discord.gg/ukZ8HghWmE" class="social-link" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127.14 96.36">
                            <path d="M107.7,8.07A105.15,105.15,0,0,0,81.47,0a72.06,72.06,0,0,0-3.36,6.83A97.68,97.68,0,0,0,49,6.83,72.37,72.37,0,0,0,45.64,0,105.89,105.89,0,0,0,19.39,8.09C2.79,32.65-1.71,56.6.54,80.21h0A105.73,105.73,0,0,0,32.71,96.36,77.7,77.7,0,0,0,39.6,85.25a68.42,68.42,0,0,1-10.85-5.18c.91-.66,1.8-1.34,2.66-2a75.57,75.57,0,0,0,64.32,0c.87.71,1.76 1.39,2.66,2a68.68,68.68,0,0,1-10.87,5.19,77,77,0,0,0,6.89,11.1A105.25,105.25,0,0,0,126.6,80.22h0C129.24,52.84,122.09,29.11,107.7,8.07ZM42.45,65.69C36.18,65.69,31,60,31,53s5-12.74,11.43-12.74S54,46,53.89,53,48.84,65.69,42.45,65.69Zm42.24,0C78.41,65.69,73.25,60,73.25,53s5-12.74,11.44-12.74S96.23,46,96.12,53,91.08,65.69,84.69,65.69Z" fill="currentColor"/>
                        </svg>
                        <span class="tooltip">Discord</span>
                    </a>
                </div>
                
                <!-- Music Player -->
                <div class="music-player">
                    <div class="song-info">
                        <div class="song-title" id="song-title">НИКТО НЕ ХОЧЕТ - Yeschapskii</div>
                        <div class="song-time" id="song-time">0:00 / 0:00</div>
                    </div>
                    <div class="player-controls">
                        <button class="play-btn" id="play-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M2 6q-.1-2.7.6-3.4T6 2q2.7-.1 3.4.6.8.7.6 3.4v12q.2 2.7-.6 3.4-.7.8-3.4.6-2.7.1-3.4-.6T2 18zm12 0q-.2-2.7.6-3.4.7-.7 3.4-.6 2.7-.1 3.4.6.8.7.6 3.4v12q.1 2.7-.6 3.4-.7.8-3.4.6-2.7.1-3.4-.6T14 18z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="progress-container" id="progress-container">
                        <div class="progress-bar" id="progress-bar"></div>
                    </div>
                    <div class="volume-control">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.84-5 6.7v2.07c4-.91 7-4.49 7-8.77s-3-7.86-7-8.77M16.5 12c0-1.77-1-3.29-2.5-4.03V16c1.5-.71 2.5-2.24 2.5-4M3 9v6h4l5 5V4L7 9z"/>
                        </svg>
                        <input type="range" class="volume-slider" id="volume-slider" min="0" max="1" step="0.01" value="0.5">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            © 2025 timaha | All Rights Reserved | dev by <a href="https://derk.sp1n.fun/" target="_blank">eto1111</a>
        </div>
    </div>
    
    <audio id="audio" preload="auto" loop>
        <source src="https://www.dropbox.com/scl/fi/7v6fk8wkeumk2pmohwjsg/Yeschapskii_-_NIKTO_NE_KHOCHET_78092532.mp3?rlkey=4vaw94h7hctq6mc2ash4w5dei&st=8myyni1c&dl=1" type="audio/mpeg">
    </audio>
    
    <script>
        // Music player elements
        const playBtn = document.getElementById('play-btn');
        const progressContainer = document.getElementById('progress-container');
        const progressBar = document.getElementById('progress-bar');
        const volumeSlider = document.getElementById('volume-slider');
        const songTitle = document.getElementById('song-title');
        const songTime = document.getElementById('song-time');
        const audio = document.getElementById('audio');
        const profileCard = document.getElementById('profile-card');
        const modalOverlay = document.getElementById('modal-overlay');
        const modalButton = document.getElementById('modal-button');
        
        let isPlaying = false;
        
        // Функция для инициализации аудио после взаимодействия
        function initAudio() {
            // Плавное исчезновение модального окна
            modalOverlay.style.opacity = '0';
            modalOverlay.style.transition = 'opacity 0.3s ease';
            
            setTimeout(() => {
                modalOverlay.style.display = 'none';
                
                // Пытаемся запустить аудио
                audio.play().then(() => {
                    isPlaying = true;
                    playBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M5.7 3a.7.7 0 0 0-.7.7v16.6a.7.7 0 0 0 .7.7h2.6a.7.7 0 0 0 .7-.7V3.7a.7.7 0 0 0-.7-.7H5.7zm10 0a.7.7 0 0 0-.7.7v16.6a.7.7 0 0 0 .7.7h2.6a.7.7 0 0 0 .7-.7V3.7a.7.7 0 0 0-.7-.7h-2.6z"/>
                        </svg>
                    `;
                }).catch(e => {
                    console.error("Error playing audio:", e);
                    isPlaying = false;
                });
            }, 300);
        }
        
        // Обработчик для модальной кнопки
        modalButton.addEventListener('click', initAudio);
        
        // Обработчик для любого клика на странице (после появления модального окна)
        document.addEventListener('click', function() {
            if (modalOverlay.style.display !== 'none') {
                initAudio();
            }
        }, { once: true });
        
        // Update progress bar
        function updateProgress(e) {
            const { duration, currentTime } = e.srcElement;
            const progressPercent = (currentTime / duration) * 100;
            progressBar.style.width = `${progressPercent}%`;
            
            // Update time
            const durationMinutes = Math.floor(duration / 60);
            let durationSeconds = Math.floor(duration % 60);
            if (durationSeconds < 10) durationSeconds = `0${durationSeconds}`;
            
            const currentMinutes = Math.floor(currentTime / 60);
            let currentSeconds = Math.floor(currentTime % 60);
            if (currentSeconds < 10) currentSeconds = `0${currentSeconds}`;
            
            if (duration) {
                songTime.textContent = `${currentMinutes}:${currentSeconds} / ${durationMinutes}:${durationSeconds}`;
            }
        }
        
        // Set progress
        function setProgress(e) {
            const width = this.clientWidth;
            const clickX = e.offsetX;
            const duration = audio.duration;
            audio.currentTime = (clickX / width) * duration;
        }
        
        // Set volume
        function setVolume() {
            audio.volume = this.value;
        }
        
        // Play/pause toggle
        function togglePlay() {
            if (isPlaying) {
                audio.pause();
                playBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M2 6q-.1-2.7.6-3.4T6 2q2.7-.1 3.4.6.8.7.6 3.4v12q.2 2.7-.6 3.4-.7.8-3.4.6-2.7.1-3.4-.6T2 18zm12 0q-.2-2.7.6-3.4.7-.7 3.4-.6 2.7-.1 3.4.6.8.7.6 3.4v12q.1 2.7-.6 3.4-.7.8-3.4.6-2.7.1-3.4-.6T14 18z"/>
                    </svg>
                `;
            } else {
                audio.play().then(() => {
                    isPlaying = true;
                    playBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M5.7 3a.7.7 0 0 0-.7.7v16.6a.7.7 0 0 0 .7.7h2.6a.7.7 0 0 0 .7-.7V3.7a.7.7 0 0 0-.7-.7H5.7zm10 0a.7.7 0 0 0-.7.7v16.6a.7.7 0 0 0 .7.7h2.6a.7.7 0 0 0 .7-.7V3.7a.7.7 0 0 0-.7-.7h-2.6z"/>
                        </svg>
                    `;
                }).catch(e => {
                    console.error("Error playing audio:", e);
                });
            }
            isPlaying = !isPlaying;
        }
        
        // Mouse move effect for profile card
        function handleMouseMove(e) {
            const { left, top, width, height } = profileCard.getBoundingClientRect();
            const x = e.clientX - left;
            const y = e.clientY - top;
            
            profileCard.style.setProperty('--mouse-x', `${x}px`);
            profileCard.style.setProperty('--mouse-y', `${y}px`);
        }
        
        // Event listeners
        playBtn.addEventListener('click', togglePlay);
        audio.addEventListener('timeupdate', updateProgress);
        progressContainer.addEventListener('click', setProgress);
        volumeSlider.addEventListener('input', setVolume);
        profileCard.addEventListener('mousemove', handleMouseMove);
        
        // Set initial volume
        audio.volume = 0.5;
        
        // Load audio metadata
        audio.addEventListener('loadedmetadata', function() {
            const duration = audio.duration;
            const durationMinutes = Math.floor(duration / 60);
            let durationSeconds = Math.floor(duration % 60);
            if (durationSeconds < 10) durationSeconds = `0${durationSeconds}`;
            songTime.textContent = `0:00 / ${durationMinutes}:${durationSeconds}`;
        });
    </script>
</body>
</html>