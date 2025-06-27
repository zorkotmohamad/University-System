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
            <p>Are you sure you want to delete the semester from the list</p>
        </div>
        <div class="modal-btn">
            <form action="delete_semester.php" method="POST">
                <input id="hidden_input_semester" type="hidden" value="" name="semester_name">
                <button id="confirm-btn" type="submit">Confirm</button>
            </form>
            <button id="cancel-btn">Cancel</button>
        </div>
    </div>
</div>