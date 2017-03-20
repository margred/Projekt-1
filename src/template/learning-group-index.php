<h1>Available learning groups</h1>
<?php foreach ($learningGroups as $learningGroup) : ?>
    <div class="card">
        <div class="card__content">
            <h4 class="card__heading"><?= $learningGroup->getLecture() ?></h4>
            <div class="card__row">
                <div class="card__row__key">Location</div>
                <div class="card__row_value"><?= $learningGroup->getLocation() ?></div>
            </div>
        </div>
        <form>
            <input type="hidden" value="<?= $learningGroup->getId() ?>">
            <button class="button card__button">Join</button>
        </form>
    </div>
<?php endforeach; ?>
