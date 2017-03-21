<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
</head>
<div class="layout">
    <div class="layout__topbar topbar">
        <div class="topbar__logo">Projektname</div>
        <nav class="navigation">
            <a href="signup" class="navigation__link">Sign up</a>
            <a href="login" class="navigation__link">Login</a>
        </nav>
    </div>
    <div class="layout__content">
        <?= $this->content() ?>
    </div>
</div>
</body>
</html>
