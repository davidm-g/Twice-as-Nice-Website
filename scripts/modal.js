const openModalButton = document.querySelector('#logbtn');
const closeModalButton = document.querySelector('#closebtn');
const modal = document.querySelector('#loginmodal');
const fade = document.querySelector('#fade');

const ToggleModal = () => { 
    [modal,fade].forEach((el) => el.classList.toggle('hide'));
};

[openModalButton, closeModalButton, fade].forEach((el) => {
    el.addEventListener('click', () => ToggleModal());
});