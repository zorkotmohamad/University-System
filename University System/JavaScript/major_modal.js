document.addEventListener("DOMContentLoaded",()=>{
    const modal = document.querySelector('.modal');
    const del = document.querySelectorAll('.delete-btn');
    const cancel = document.getElementById('cancel-btn');
    const confirm_button = document.getElementById('confirm-btn');
    const hidden_input = document.getElementById('hidden_input');
    const edit_btn  = document.querySelectorAll('.edit-btn');
    const edit_modal = document.querySelector('.container');
    const cancel_edit = document.querySelector('.cancel-btn');
    const new_major = document.getElementById('newmajor');
    const old_major = document.getElementById('oldmajor');
    [...del].forEach(function(btn){
        btn.addEventListener("click",()=>{
        if(modal.classList.contains('hidden-modal')){
            modal.classList.remove('hidden-modal');
            modal.classList.add('show-modal');
        }
        confirm_button.addEventListener("click",()=>{
            hidden_input.value = btn.getAttribute('data-major');
            });

        });
    });
    [...edit_btn].forEach(function(edit){
        edit.addEventListener("click",()=>{
            if(edit_modal.classList.contains('hidden-edit-modal')){
                edit_modal.classList.remove('hidden-edit-modal');
                edit_modal.classList.add('show-edit-modal');
            }
            new_major.value = edit.getAttribute('data-major_name');
            old_major.value = edit.getAttribute('data-major_name');
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