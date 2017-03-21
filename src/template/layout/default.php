<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Amatic+SC' rel='stylesheet' type='text/css'>
</head>
<div class="layout">
    <div class="layout__topbar topbar">
        <div class="topbar__logo">Grouper</div>
        <nav class="navigation">
            <a href="/contact" class="navigation__link">Contact</a>
            <?php if (!$this->isLoggedIn()): ?>
                <a href="signup" class="navigation__link">Sign up</a>
                <a href="login" class="navigation__link">Login</a>
            <?php endif; ?>
            <?php if ($this->isLoggedIn()): ?>
                <a href="/learning-group" class="navigation__link">Learning Groups</a>
                <a href="/profile" class="navigation__link">Profile</a>
            <?php endif; ?>
        </nav>
    </div>
    <div class="layout__content">
        <?= $this->content() ?>
    </div>
</div>
</body>
</html>
