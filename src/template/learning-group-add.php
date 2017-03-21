<h1>Create new learning group</h1>
<?php if($successMsg): ?>
    <div class="alert alert--success">
        <?= $successMsg ?>
    </div>
<?php endif; ?>
<form method="post">
    <div class="input-group">
        <label class="label">Course</label>
        <select class="select" name="lectureId">
            <option value="-1">Please select</option>
            <?php foreach ($lectureCourses as $lectureCourses) : ?>
                <option value="<?= $lectureCourses->getId() ?>"><?= $lectureCourses->getName() ?></option>
            <?php endforeach; ?>
        </select>
        <p class="learning-group-add__form__create-new">or create a new one</p>
        <input type="text" class="input" name="lectureName">
    </div>
    <div class="input-group">
        <label class="label">Meeting point</label>
        <input type="text" class="input" name="location">
    </div>
    <button class="button">Login</button>
</form>
