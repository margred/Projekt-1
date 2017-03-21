<h1 class="title title--hasButton">
    Profile
    <a href="/learning-group" class="button">Join</a>
</h1>
<?= var_dump($learningGroups) ?>
<?php foreach ($learningGroups as $learningGroup) : ?>
    <div class="card">
        <div class="card__content">
            <h4 class="card__heading"><?= $learningGroup->getLecture() ?></h4>
            <div class="card__row">
                <div class="card__row__key">Location</div>
                <div class="card__row_value"><?= $learningGroup->getLocation() ?></div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
