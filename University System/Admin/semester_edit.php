<?php
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<div class="container hidden-edit-modal">
    <div class="edit-modal">
        <div class="modal-title">Edit Semester</div>
            <form method="POST" action="update_semester.php">
                <div class="edit-form">
                    <div class="modal-lbl-input">
                        <label for="semester">Semester Name</label>
                        <input id="newsemester" type="text" placeholder="Semester Name" name="new_semester"><br/><br/>
                        <input id="oldsemester" type="hidden" value="" name="old_semester">
                    </div>
                    <div class="edit-btns">
                        <button type="submit" class="edit-modal-btn">Save changes</button>
                        <button class="cancel-btn" type="button">Cancel</button>
                    </div>
                </div>
            </form>
    </div>
</div>