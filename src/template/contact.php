<div class="contact">
    <h1>Contact</h1>
    <?php if($success): ?>
        <div class="alert alert--success">
            <?= $success ?>
        </div>
    <?php endif; ?>
    <?php if($errors): ?>
        <div class="alert alert--error">
            <?= $errors ?>
        </div>
    <?php endif; ?>
    <form method="post" class="contact__form">
        <div class="input-group">
            <label class="label">Name</label>
            <input type="text" class="input" name="name">
        </div>

        <div class="input-group">
            <label class="label">Email</label>
            <input type="email" class="input" name="email">
        </div>

        <div class="input-group">
            <label class="label">Message</label>
            <textarea id="contactmsg" name="message" class="textarea"></textarea>
        </div>
        <button class="button">Send</button>
    </form>
</div>
