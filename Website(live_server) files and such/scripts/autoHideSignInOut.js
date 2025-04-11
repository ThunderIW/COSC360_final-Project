document.addEventListener('DOMContentLoaded', () => {
    const message = document.querySelector('.signup-success-message');
    if (message) {
        // Optional fade-out effect using a class
        setTimeout(() => {
            message.classList.add('hide');
        }, 4000); // Start fading after 4 seconds

        setTimeout(() => {
            message.style.display = 'none';
        }, 5000); // Hide completely after 5 seconds
    }
});