<?php 
$notify_mesg = $_SESSION['ESHOP_MESG'] ?? "";
?>
<?php if(!empty($notify_mesg)) { ?>
    <div class="notify-container">
        <div class="notify">
            <div class="notify-header">
                <b>Thông báo</b>
                <label>
                    <input type="checkbox">
                    &times;
                </label>
            </div>
            <div class="notify-body">
                <?= $notify_mesg ?>
            </div>
        </div>
    </div>
<?php
// clear message
$_SESSION['ESHOP_MESG'] = "";

} ?>