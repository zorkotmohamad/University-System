<?php
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<div class="container hidden-edit-modal">
    <div class="edit-modal">
        <div class="modal-title">Edit Student</div>
            <form method="POST" action="update_student_enrolled.php">
                <div class="edit-form">
                    <div class="modal-lbl-input">
                        <label for="student_id">Student ID</label>
                        <input id="student_id" type="text" value="" name="student_id" readonly><br/><br/>
                    </div>
                    <div class="modal-lbl-input">
                        <label for="newname">Student Name</label>
                        <input id="newname" type="text" value="" name="newname"><br/><br/>
                        <input id="oldname" type="hidden" value="" name="oldname">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="newmajor">Student Major</label>
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