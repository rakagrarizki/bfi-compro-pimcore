<a href="https://api.whatsapp.com/send?phone=<?= $this->input('wa-number') ?>&text=<?= $this->input('message') ?>" class="wa-button" target="_blank">
    <div class="chat-icon">
        <span><i class="fab fa-whatsapp fa-lg" aria-hidden="true"></i></span>
    </div>
    <div class="chat-text">
        <?= $this->input('title-text') ?>
    </div>
</a>