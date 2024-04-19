const openLogin = document.querySelector('#login');
const closeLogin = document.querySelector('#closebtn');
const loginModal = document.querySelector('#loginmodal');
const fadeLogin = document.querySelector('#fadeLogin');

const ToggleLogin = () => { 
     [loginModal,fadeLogin].forEach((el) => el.classList.toggle('hide'));
};

[openLogin, closeLogin, fadeLogin].forEach((el) => {
    if (el) el.addEventListener('click', () => ToggleLogin());
});