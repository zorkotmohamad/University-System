document.addEventListener("DOMContentLoaded",()=>{
    const del = document.querySelectorAll('.delete-btn');
    const modal = document.querySelector('.modal');
    const cancel = document.getElementById('cancel-btn');
    const student_input = document.getElementById('hidden_input_student');
    const edit = document.querySelectorAll('.edit-btn');
    const edit_modal = document.querySelector('.container');
    const cancel_edit = document.querySelector('.cancel-btn');
    const studentid = document.getElementById('student_id');
    const studentname = document.getElementById('student_name');
    const studentmajor = document.getElementById('student_major');
    const studentemail = document.getElementById('student_email');
    const oldname = document.getElementById('oldname');
    const oldmajor = document.getElementById('oldmajor');
    const oldemail = document.getElementById('oldemail');
    [...del].forEach(function(del){
        del.addEventListener("click",()=>{
            if(modal.classList.contains('hidden-modal')){
                modal.classList.remove('hidden-modal');
                modal.classList.add('show-modal');
            }
            student_input.value = del.getAttribute('data-student_id');
        });
    });
    [...edit].forEach(function(edit){
        edit.addEventListener("click",()=>{
            if(edit_modal.classList.contains('hidden-edit-modal')){
                edit_modal.classList.remove('hidden-edit-modal');
                edit_modal.classList.add('show-edit-modal');
            }
            studentid.value = edit.getAttribute('data-student_id');
            studentname.value = edit.getAttribute('data-student_name');
            studentmajor.value = edit.getAttribute('data-student_major');
            studentemail.value = edit.getAttribute('data-student_email');
            oldname.value = edit.getAttribute('data-student_name');
            oldmajor.value = edit.getAttribute('data-student_major');
            oldemail.value = edit.getAttribute('data-student_email');
        });
    });
    cancel_edit.addEventListener("click",()=>{
        if(edit_modal.classList.contains('show-edit-modal')){
                edit_modal.classList.remove('show-edit-modal');
                edit_modal.classList.add('hidden-edit-modal');
            }
    });
    cancel.addEventListener("click",()=>{
        if(modal.classList.contains('show-modal')){
            modal.classList.remove('show-modal');
            modal.classList.add('hidden-modal');
        }
    });
});