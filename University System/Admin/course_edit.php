<?php
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
    header("Location:Login.php");
    exit();
}
?>
<div class="container hidden-edit-modal">
    <div class="edit-modal">
        <div class="modal-title">Edit Course</div>
            <form method="POST" action="update_course.php">
                <div class="edit-form">
                    <div class="modal-lbl-input">
                        <label for="coursename">Course Name</label>
                        <input id="course_name" type="text" placeholder="Course Name" name="new_course"><br/><br/>
                        <input id="hidden-edit-coursename" type="hidden" value="" name="old_course">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="coursecode">Course Code</label>
                        <input id="coursecode" type="text" placeholder="Course Code" name="new_coursecode"><br/><br/>
                        <input id="hidden-edit-coursecode" type="hidden" value="" name="old_coursecode">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="course_credits">Course Credits</label>
                        <input id="course_credits" type="number" placeholder="Course Credits" name="new_coursecredits"><br/><br/>
                        <input id="old_credits" type="hidden" value="" name="old_coursecredits">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="course_semester">Semester</label>
                        <input id="new_semester" type="text" placeholder="Semester" name="new_semester"><br/><br/>
                        <input id="old_semester" type="hidden" value="" name="old_semester">
                    </div>
                    <div class="modal-lbl-input">
                        <label for="course_major">Course Major</label>
                        <input id="course_major" type="text" placeholder="Course Major" name="new_coursemajor"><br/><br/>
                        <input id="hidden-edit-coursemajor" type="hidden" value="" name="old_coursemajor">
                    </div>
                    <div class="edit-btns">
                        <button type="submit" class="edit-modal-btn">Save changes</button>
                        <button class="cancel-btn" type="button">Cancel</button>
                    </div>
                </div>
            </form>
    </div>
</div>