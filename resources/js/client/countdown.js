// Fungsi untuk memulai countdown
function startCountdown(endtime, container) {
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endtime - now;

        if (distance < 0) {
            clearInterval(interval);
            container.querySelector('.days > span').style.setProperty('--value', 0);
            container.querySelector('.hours > span').style.setProperty('--value', 0);
            container.querySelector('.minutes > span').style.setProperty('--value', 0);
            container.querySelector('.seconds > span').style.setProperty('--value', 0);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        container.querySelector('.days > span').style.setProperty('--value', days);
        container.querySelector('.hours > span').style.setProperty('--value', hours);
        container.querySelector('.minutes > span').style.setProperty('--value', minutes);
        container.querySelector('.seconds > span').style.setProperty('--value', seconds);
    }

    const interval = setInterval(updateCountdown, 1000);
    updateCountdown();
}

// Inisialisasi semua countdown
document.querySelectorAll('.countdown-container').forEach(container => {
    const endtime = new Date(container.getAttribute('data-endtime')).getTime();
    startCountdown(endtime, container);
});
