<?php
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<div class="container hidden-edit-modal">
    <div class="edit-modal">
        <div class="modal-title">Edit Major</div>
            <form method="POST" action="update_major.php">
                <div class="edit-form">
                    <div class="modal-lbl-input">
                        <label for="newmajor">Major Name</label>
                        <input id="newmajor" type="text" value="" name="newmajor"><br/><br/>
                        <input id="oldmajor" type="hidden" value="" name="oldmajor">
                    </div>
                    <div class="edit-btns">
                        <button type="submit" class="edit-modal-btn">Save changes</button>
                        <button class="cancel-btn" type="button">Cancel</button>
                    </div>
                </div>
            </form>
    </div>
</div>