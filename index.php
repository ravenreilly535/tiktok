<!DOCTYPE html>
<html>
<head>
    <title>TikTok Profile Fetcher</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .container { max-width: 600px; margin: auto; }
        input { padding: 10px; width: 70%; }
        button { padding: 10px; background: #FF0050; color: white; border: none; }
        .profile { margin-top: 20px; padding: 15px; border: 1px solid #ddd; }
        .profile img { width: 100px; height: 100px; border-radius: 50%; }
    </style>
</head>
<body>
    <div class="container">
        <h1>TikTok Profile Check</h1>
        <form method="GET">
            <input type="text" name="username" placeholder="Enter TikTok Username (e.g., khaby.lame)" value="<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>">
            <button type="submit">Search</button>
        </form>
        
        <?php
        if (isset($_GET['username']) {
            $username = trim($_GET['username']);
            $url = "https://www.tiktok.com/@$username";
            
            // cURL se HTML fetch karein
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
            $html = curl_exec($ch);
            curl_close($ch);
            
            echo '<div class="profile">';
            if (preg_match('/"avatar":"(.*?)"/', $html, $avatar)) {
                $profile_pic = str_replace('\\', '', $avatar[1]);
                $name = preg_match('/"nickname":"(.*?)"/', $html, $name) ? $name[1] : 'N/A';
                
                echo '<img src="' . $profile_pic . '" alt="Profile">';
                echo '<h2>' . htmlspecialchars($name) . '</h2>';
                echo '<p>Followers: N/A (Advanced scraping required)</p>';
            } else {
                echo '<p style="color:red;">Profile not found or blocked by TikTok!</p>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
