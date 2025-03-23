document.addEventListener('DOMContentLoaded', () => {
    const message = document.querySelector('.signup-success-message');
    if (message) {
        setTimeout(() => {
            message.style.display = 'none';
        }, 5000);
    }
});
