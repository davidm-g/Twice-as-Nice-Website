document.getElementById('photoPreview').addEventListener('click', function() {
    document.getElementById('removePhoto').style.display = 'none';
    const choice = confirm("Cancel to upload a photo or OK to take a photo.");
    if (choice) {
        if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                window.stream = stream;
                const video = document.getElementById('webcamStream');
                const photoPreview = document.getElementById('photoPreview');
                video.srcObject = stream;
                video.style.display = 'block'; // Show the webcam stream
                photoPreview.style.display = 'none'; // Hide the photo preview
                document.getElementById('capturePhoto').style.display = 'block';
            });
        }
    } else {
        document.getElementById('photoInput').click();
    }
});

document.getElementById('photoInput').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('photoPreview').src = e.target.result;
        document.getElementById('picture').value = document.getElementById('photoPreview').src;
    }
    reader.readAsDataURL(e.target.files[0]); 
});

document.getElementById('capturePhoto').addEventListener('click', function() {
    const video = document.getElementById('webcamStream');
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    document.getElementById('photoPreview').src = canvas.toDataURL();
    if (window.stream) {
        window.stream.getTracks().forEach(track => track.stop());
        window.stream = null;
    }
    document.getElementById('webcamStream').style.display = 'none'; // Hide the webcam stream
    document.getElementById('photoPreview').style.display = 'block'; // Show the photo preview
    document.getElementById('capturePhoto').style.display = 'none';
    document.getElementById('removePhoto').style.display = 'block';

    document.getElementById('picture').value = document.getElementById('photoPreview').src;
});

document.getElementById('removePhoto').addEventListener('click', function() {
    document.getElementById('photoPreview').src = 'database/images/PROFILE_PIC.jpg';
    document.getElementById('photoInput').value = '';
    document.getElementById('removePhoto').style.display = 'none';

    document.getElementById('picture').value = '';
});