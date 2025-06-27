document.addEventListener("DOMContentLoaded",()=>{
    const del = document.querySelectorAll('.delete-btn');
    const modal = document.querySelector('.modal');
    const cancel = document.getElementById('cancel-btn');
    const hidden_input = document.getElementById('hidden_input');
    const edit = document.querySelectorAll('.edit-btn');
    const edit_modal = document.querySelector('.container');
    const cancel_edit = document.querySelector('.cancel-btn');
    const course_name = document.getElementById('course_name');
    const course_code = document.getElementById('coursecode');
    const old_coursename = document.getElementById('hidden-edit-coursename');
    const old_coursemajor = document.getElementById('hidden-edit-coursemajor');
    const old_coursecode = document.getElementById('hidden-edit-coursecode');
    const course_major = document.getElementById('course_major');
    const new_credits = document.getElementById('course_credits');
    const old_credits = document.getElementById('old_credits');
    const new_semester = document.getElementById('new_semester');
    const old_semester = document.getElementById('old_semester');
    [...del].forEach(function(delbtn){
        delbtn.addEventListener("click",()=>{
            if(modal.classList.contains('hidden-modal')){
                modal.classList.remove('hidden-modal');
                modal.classList.add('show-modal')
            }
            hidden_input.value = delbtn.getAttribute('data-course');
        });
    });
    [...edit].forEach(function(edit){
        edit.addEventListener("click",()=>{
            if(edit_modal.classList.contains('hidden-edit-modal')){
                edit_modal.classList.remove('hidden-edit-modal');
                edit_modal.classList.add('show-edit-modal');
            }
            course_name.value = edit.getAttribute('data-course_name');
            course_code.value = edit.getAttribute('data-course_code');
            old_coursename.value = edit.getAttribute('data-course_name');
            old_coursecode.value = edit.getAttribute('data-course_code');
            course_major.value = edit.getAttribute('data-course_major');
            old_coursemajor.value = edit.getAttribute('data-course_major');
            new_credits.value = edit.getAttribute('data-course_credits');
            old_credits.value = edit.getAttribute('data-course_credits');
            new_semester.value = edit.getAttribute('data-course_semester');
            old_semester.value = edit.getAttribute('data-course_semester');
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