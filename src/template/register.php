<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="./css/style.css" rel="stylesheet">
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
        <div class="registration">
            <form method="post" class="registration__form">
                <div class="input-group">
                    <label class="label">Email</label>
                    <input type="email" class="input" name="email">
                </div>
                <div class="input-group">
                    <label class="label">Password</label>
                    <input type="password" class="input" name="password">
                </div>
                <div class="input-group">
                    <label class="label">Firstname</label>
                    <input type="text" class="input" name="firstName">
                </div>
                <div class="input-group">
                    <label class="label">Lastname</label>
                    <input type="text" class="input" name="lastName">
                </div>
                <div class="input-group">
                    <label class="label">University</label>
                    <select class="select" name="universityId">
                        <option>Please select</option>
                        <?php foreach ($universities as $university) : ?>
                            <option value="<?= $university->getId() ?>"><?= $university->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group">
                    <label class="label">Course</label>
                    <select class="select" name="courseId">
                        <option>Please select</option>
                        <?php foreach ($courses as $course) : ?>
                            <option value="<?= $course->getId() ?>"><?= $course->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="button">Sign up</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
