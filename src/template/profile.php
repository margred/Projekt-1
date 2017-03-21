<h1 class="title title--hasButton">
    Profile
    <a href="/learning-group" class="button">Join</a>
</h1>
<?php if (count($learningGroups) > 0): ?>
    <?php foreach ($learningGroups as $learningGroup) : ?>
        <div class="card">
            <h4 class="card__heading"><?= $learningGroup->getLecture() ?></h4>
            <div class="card__content">
                <div class="card__row">
                    <div class="card__row__key">Location</div>
                    <div class="card__row_value"><?= $learningGroup->getLocation() ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php if (!count($learningGroups) > 0): ?>
    <p>You didn't join any learning groups, <a href="/learning-group">join one now.</a></p>
<?php endif; ?>
