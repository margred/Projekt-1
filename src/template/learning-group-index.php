<h1 class="title title--hasButton">
    Available learning groups
    <a href="/learning-group/add" class="button">Create</a>
</h1>
<?php foreach ($learningGroups as $learningGroup) : ?>
    <div class="card">
        <div class="card__content">
            <h4 class="card__heading"><?= $learningGroup->getLecture() ?></h4>
            <div class="card__row">
                <div class="card__row__key">Location</div>
                <div class="card__row_value"><?= $learningGroup->getLocation() ?></div>
            </div>
        </div>
        <form method="post">
            <input type="hidden" name="learningGroupId" value="<?= $learningGroup->getId() ?>">
            <button class="button card__button">Join</button>
        </form>
    </div>
<?php endforeach; ?>
