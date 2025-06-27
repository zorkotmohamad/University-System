<?php
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<div class="container hidden-edit-modal">
    <div class="edit-modal">
        <div class="modal-title">Edit Student</div>
            <form method="POST" action="update_student.php">
                <div class="edit-form">
                    <div class="modal-lbl-input">
                        <label for="student_id">Student ID</label>
                        <input id="student_id" type="text" value="" name="id_student" readonly><br/><br/>
                    </div>
                    <div class="modal-lbl-input">
                        <label for="student_name">Student Name</label>
                        <input id="student_name" placeholder="Student Name" type="text" value="" name="new_name"><br/><br/>
                        <input id="oldname" type="hidden" value="" name="old_name">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="student_major">Student Major</label>
                        <input id="student_major" placeholder="Student Major" type="text" value="" name="new_major"><br/><br/>
                        <input id="oldmajor" type="hidden" value="" name="old_major">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="student_email">Student Email</label>
                        <input id="student_email" placeholder="Student Email" type="text" value="" name="new_email"><br/><br/>
                        <input id="oldemail" type="hidden" value="" name="old_email">
                    </div>
                    <div class="edit-btns">
                        <button type="submit" class="edit-modal-btn">Save changes</button>
                        <button class="cancel-btn" type="button">Cancel</button>
                    </div>
                </div>
            </form>
    </div>
</div>