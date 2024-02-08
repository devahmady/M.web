<p align="center"><a href="" target="_blank"><img src="https://github.com/devahmady/devahmady.github.io/blob/main/assets/images/mikman.png" width="400" alt="mikrotikweb Logo"></a></p>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <h1>MikManV1 - MikroTik Management</h1>
        <p>Selamat datang di dokumentasi proyek MikMan, di mana kami menggunakan Laravel untuk berintegrasi dengan API MikroTik untuk manajemen jaringan yang efisien.</p>
        <p align="center"><a href="" target="_blank"><img src="https://github.com/devahmady/devahmady.github.io/blob/main/assets/images/mikweb.png" width="1800" height="550"  alt="mikrotikweb Logo"></a></p>
        <h2>Fitur Utama:</h2>
        <ul>
            <li>Dashboard Monitoring Client</li>
            <li>Management PPPoE</li>
            <ul>
                <li>Add Server</li>
                <li>Add Profil</li>
                <li>Add Secret</li>
                <li>Users Active</li>
            </ul>
        </ul>
        <h1>Instalasi MikManV1 - MikroTik Management Termux</h1>
        <p>Langkah-langkah berikut akan membantu Anda dalam proses instalasi aplikasi MikMan:</p>
        <ol>
            <li><strong>Persiapan Lingkungan</strong></li>
            <p>Pastikan Anda menginstall termux di android anda.</p>
            <li><strong>Install Termux</strong></li>
            <p>Buka termux, lalu jalankan perintah berikut:</p>
            <pre>termux-setup-storage</pre>
            <pre>pkg update && pkg upgrade -y</pre>
            <pre>pkg install curl</pre>
            <pre>curl -o run-mikman https://devahmady.github.io/mikman.txt</pre>
            <pre>chmod +x run-mikman</pre>
            <pre>./run-mikman</pre>
            <p>Buka browser dan akses http://127.0.0.1:8000 untuk melihat aplikasi MikMan.</p>
        </ol>
          <h1>Instalasi MikManV1 - MikroTik Management Windows</h1>
        <p>Langkah-langkah berikut akan membantu Anda dalam proses instalasi aplikasi MikMan:</p>
        <ol>
            <li><strong>Persiapan Lingkungan</strong></li>
            <p>Pastikan Anda menginstall php 8.x dan composer pada system anda.</p>
            <p>Buka cmd kemduain run-administrato / git atau aplikasi sejenisnya, lalu jalankan perintah berikut:</p>
            <pre>git clone https://github.com/devahmady/mikman.git</pre>
            <pre>cd mikman</pre>
            <pre>composer install</pre>
            <pre>cp .env.example .env</pre>
            <pre>php artisan serve</pre>
            <p>Buka browser dan akses http://127.0.0.1:8000 untuk melihat aplikasi MikMan.</p>
        </ol>
       <h2>Kesimpulan:</h2>
        <p>Integrasi API MikroTik kami dengan Laravel memberdayakan Anda untuk mengelola dan memonitor infrastruktur jaringan dengan efisien.</p>
    </div>
</body>
</html>

