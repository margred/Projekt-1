<h1>Create new learning group</h1>
<form method="post">
    <div class="input-group">
        <label class="label">Course</label>
        <select class="select" name="lectureCourseId">
            <option>Please select</option>
            <?php foreach ($lectureCourses as $lectureCourses) : ?>
                <option value="<?= $lectureCourses->getId() ?>"><?= $lectureCourses->getName() ?></option>
            <?php endforeach; ?>
        </select>
        <p class="learning-group-add__form__create-new">or create a new one</p>
        <input type="text" class="input" name="lectureCourseName">
    </div>
    <div class="input-group">
        <label class="label">Meeting point</label>
        <input type="text" class="input" name="location">
    </div>
    <button class="button">Login</button>
</form>
