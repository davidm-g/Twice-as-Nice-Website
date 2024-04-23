const openRegister = document.querySelector('#register');
const closeRegister = document.querySelector('#closebtnR');
const registerModal = document.querySelector('#registermodal');
const fadeRegister = document.querySelector('#fadeRegister');

const ToggleRegister = () => { 
     [registerModal,fadeRegister].forEach((el) => el.classList.toggle('hide'));

     // If the webcam stream is open, close it
    if (window.stream) {
        window.stream.getTracks().forEach(track => track.stop());
        window.stream = null;
    }
    document.getElementById('webcamStream').style.display = 'none'; // Hide the webcam stream
    document.getElementById('photoPreview').style.display = 'block'; // Show the photo preview
    document.getElementById('capturePhoto').style.display = 'none';
};

[openRegister, closeRegister, fadeRegister].forEach((el) => {
    if (el) el.addEventListener('click', () => ToggleRegister());
});