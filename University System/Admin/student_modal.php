<?php
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)){
        header("Location:Login.php");
        exit();
    }
?>
<div class="modal hidden-modal">
    <div class="modal-child">
        <div class="modal-image">
            <img class="warning" src="../Images/warning.png" alt="Warning">
        </div>
        <div class="modal-text">
            <p>Are you sure you want to delete the student ?</p>
        </div>
        <div class="modal-btn">
            <form action="delete_student.php" method="POST">
                <input id="hidden_input_student" type="hidden" value="" name="student_id">
                <button id="confirm-btn" type="submit">Confirm</button>
            </form>
            <button id="cancel-btn">Cancel</button>
        </div>
    </div>
</div>