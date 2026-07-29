<?php
// Simple portfolio page (single-file entry)
// Handle contact form submission
$status = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $status = 'Please fill all fields.';
    } else {
        $safe_name = strip_tags($name);
        $safe_email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $safe_message = strip_tags($message);
        $entry = sprintf("[%s] %s <%s>: %s\n", date('Y-m-d H:i:s'), $safe_name, $safe_email, $safe_message);
        @file_put_contents(__DIR__ . '/data/messages.txt', $entry, FILE_APPEND | LOCK_EX);
        $status = 'Thanks! Your message was received.';
        // clear form
        $name = $email = $message = '';
    }
}

$projects = [
    [
        'title' => 'Rotten Night',
        'desc' => 'Pyschological horror game, You play as Simon, Try to survive the night from Mysterious Spirits.',
        'img'  => '/assets/images/Rotten.png',
        'link' => 'https://rigy-game-studio.itch.io/rotten-night'
    ],
    [
        'title' => 'Aplikasi Jadwal',
        'desc' => 'My first Mobile Apps created in Android Studio, used for viewing current school schedules, subjects, rooms efficiently. This application is currently on work in progress, and the schedule data can be synced from the supabase server, in case of changed school schedules, instead of making a local schedule data that requires a lot of hard work just to updating it.',
        'img'  => '/assets/images/Jadwal.png',
        'link' => 'https://fsrquezmqqopbmpjymbn.supabase.co/storage/v1/object/public/App/Jadwal_Prototype_0.1.apk'
    ],
    [
        'title' => 'Digital Soundboard',
        'desc' => 'A simple soundboard desktop application contains 4 channel for playing Music,SFX,Voicelines,Ambience simultaneously. Used for arrange an adaptive musical drama sound in schools, instead of using pre-rendered audio',
        'img'  => '/assets/images/Soundboard.png',
        'link' => 'https://drive.google.com/uc?export=download&id=1UULK24ec7vusfzdgQ8Cy9N-WYJQ9zRW3'
    ],
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Portfolio — Riffat</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="#">Riffat</a>
            <button id="nav-toggle" class="nav-toggle" aria-label="Toggle navigation">☰</button>
            <nav class="nav" id="nav">
                <a href="#projects">Projects</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container hero-inner">
                <div class="hero-copy">
                    <h1>Hi, I’m Riffat — Software & Game Developer</h1>
                    <p>I design and build believable Desktop Apps, Mobile Apps, and Games.</p>
                    <p><a class="btn" href="#projects">See my work</a></p>
                </div>
                <div class="hero-photo">
                    <img src="assets/images/profile.jpeg" alt="Profile">
                </div>
            </div>
        </section>

        <section id="projects" class="projects container">
            <h2>My Projects</h2>
            <div class="grid">
                
                <?php foreach ($projects as $p): ?>
                    <article class="card">
                        <img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['title']) ?>">
                        <h3><?= htmlspecialchars($p['title']) ?></h3>
                        <p><?= htmlspecialchars($p['desc']) ?></p>
                        <p><a class="link" href="<?= htmlspecialchars($p['link']) ?>">Try it</a></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="about" class="about container">
            <h2>About</h2>
            <p>I specialize in creating 3D Games, Desktop Apps, and Mobile Apps. I combine artistic skills with front-end tools to showcase work interactively on the web.</p>
        </section>

        <section id="contact" class="contact container">
            <h2>Contact</h2>
            <?php if ($status): ?>
                <p class="status"><?= htmlspecialchars($status) ?></p>
            <?php endif; ?>
            <form id="contactForm" method="post" action="#contact">
                <label>Name
                    <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required>
                </label>
                <label>Email
                    <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
                </label>
                <label>Message
                    <textarea name="message" required><?= htmlspecialchars($message ?? '') ?></textarea>
                </label>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <small>&copy; <?= date('Y') ?> Riffat — Built with PHP, HTML, CSS, JS</small>
        </div>
    </footer>

    <script src="/assets/js/main.js"></script>
</body>
</html>
<?php
// Simple portfolio page in a single PHP file
// If contact form submitted, handle and show a simple message
$sent = false;
$name = '';
$email = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$name = trim($_POST['name'] ?? '');
		$email = trim($_POST['email'] ?? '');
		$message = trim($_POST['message'] ?? '');
		// Very small validation
		if ($name !== '' && $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
				// In a real site you'd send an email or store the message.
				$sent = true;
		}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Portfolio - Riffat</title>
	<style>
		:root{--bg:#0f1724;--card:#0b1220;--accent:#06b6d4;--muted:#94a3b8;color-scheme:dark}
		*{box-sizing:border-box}
		body{margin:0;font-family:Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;background:linear-gradient(180deg,#071023 0%,#07121a 100%);color:#e6eef6}
		.container{max-width:960px;margin:40px auto;padding:20px}
		header{display:flex;align-items:center;gap:16px}
		.avatar{width:96px;height:96px;border-radius:12px;background:linear-gradient(135deg,var(--accent),#8b5cf6);display:flex;align-items:center;justify-content:center;font-weight:700;color:#052023}
		h1{margin:0;font-size:1.6rem}
		p.lead{margin:6px 0;color:var(--muted)}
		.grid{display:flow;grid-template-columns:1fr 320px;gap:20px;margin-top:24px}
		.card{background:rgba(255,255,255,0.03);padding:18px;border-radius:12px}
		.projects{display:flow;grid-template-columns:repeat(2,1fr);gap:14px}
		.project{background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);padding:12px;border-radius:8px}
		.project h3{margin:0;font-size:1rem}
		.project p{margin:6px 0 0;color:var(--muted);font-size:.9rem}
		form label{display:block;margin:8px 0 6px;font-size:.9rem}
		input[type=text], input[type=email], textarea{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:inherit}
		textarea{min-height:110px;resize:vertical}
		button{background:var(--accent);color:#022;border:0;padding:10px 14px;border-radius:8px;cursor:pointer;margin-top:10px}
		footer{margin-top:28px;color:var(--muted);font-size:.9rem;text-align:center}
		@media(max-width:800px){.grid{grid-template-columns:1fr}.projects{grid-template-columns:1fr}}
	</style>
</head>
<body>
	

	<script>
		// small client-side enhancements
		document.getElementById('contactForm')?.addEventListener('submit', function(e){
			// simple UI feedback
			this.querySelector('button').textContent = 'Sending...';
		});
	</script>
</body>
</html>
