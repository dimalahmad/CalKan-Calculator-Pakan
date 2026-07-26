@echo off
title CalKan Local Server Manager
echo ==================================================
echo         CalKan Local Server Manager
echo ==================================================
echo.

echo [1/2] Memeriksa dan menghentikan server lama di port 8000...
for /f "tokens=5" %%a in ('netstat -aon ^| findstr :8000 ^| findstr LISTENING') do (
    echo Menghentikan proses PID %%a yang menggunakan port 8000...
    taskkill /f /pid %%a >nul 2>&1
)

echo.
echo [2/2] Memulai server lokal CalKan baru...
echo Silakan buka browser Anda dan akses:
echo.
echo         http://127.0.0.1:8000
echo.
echo ==================================================
echo Tekan CTRL + C untuk menghentikan server.
echo.

php artisan serve --port=8000
pause
