@echo off
tasklist /FI "IMAGENAME eq xampp-control.exe" | findstr /I "xampp-control.exe" && (
    taskkill /IM chrome.exe
    taskkill /IM notepad++.exe
    cd "C:\xampp"
    call apache_stop.bat
    call mysql_stop.bat
    taskkill /f /IM xampp-control.exe
) || (
    cd "C:\Program Files\Google\Chrome\Application"
    start C:\xampp\xampp-control.exe
    start chrome.exe http://localhost/MSP_Team7_Codes/  
    cd "C:\Program Files\Notepad++"C:\xampp\htdocs\MSP_Team7_Codes
    ::start notepad++.exe
    ::cd "C:\Users\USER\AppData\Local\Programs\Microsoft VS Code"
    ::start Code.exe
    ::start %SystemRoot%\explorer.exe "C:\xampp\htdocs\MSP"
)
exit

