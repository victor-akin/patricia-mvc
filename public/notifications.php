<?php if(isset($this->message)){ ?>
    <button
        class="uk-button uk-button-default notification-btn" 
        type="button" 
        onclick="UIkit.notification({message: '<?= $this->message ?>', status: '<?= $this->status ?? '' ?>'})"
        hidden
    >
    </button>
<?php } ?>