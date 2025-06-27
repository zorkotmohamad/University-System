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
            <p>Are you sure you want to drop the course for this student ?</p>
        </div>
        <div class="modal-btn">
            <form action="Enrollments.php" method="POST">
                <input id="coursecode" type="hidden" value="" name="coursecode">
                <input id="studentid" type="hidden" value="" name="studentid">
                <button id="confirm-btn" type="submit">Confirm</button>
            </form>
            <button id="cancel-btn">Cancel</button>
        </div>
    </div>
</div>