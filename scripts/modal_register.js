const openRegister = document.querySelector('#register');
const closeRegister = document.querySelector('#closebtnR');
const registerModal = document.querySelector('#registermodal');
const fadeRegister = document.querySelector('#fadeRegister');

const ToggleRegister = () => { 
     [registerModal,fadeRegister].forEach((el) => el.classList.toggle('hide'));
};

[openRegister, closeRegister, fadeRegister].forEach((el) => {
    if (el) el.addEventListener('click', () => ToggleRegister());
});