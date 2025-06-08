document.addEventListener('DOMContentLoaded', function () {
    const checkButtons = document.querySelectorAll('.check-availability-btn');

    checkButtons.forEach(button => {
        button.addEventListener('click', function () {
            const bookingFormDiv = this.closest('.booking-form');
            const roomId = bookingFormDiv.dataset.roomId;
            const startDate = bookingFormDiv.querySelector('.start-date').value;
            const endDate = bookingFormDiv.querySelector('.end-date').value;
            const statusDiv = bookingFormDiv.querySelector('.availability-status');
            const bookNowForm = bookingFormDiv.querySelector('.book-now-form');

            if (!startDate || !endDate) {
                statusDiv.textContent = 'Будь ласка, виберіть обидві дати.';
                statusDiv.style.color = 'orange';
                return;
            }

            const apiUrl = `${BASE_URL}/booking/checkAvailability?room_id=${roomId}&start_date=${startDate}&end_date=${endDate}`;

            statusDiv.textContent = 'Перевірка...';
            bookNowForm.style.display = 'none';

            fetch(apiUrl)
                .then(response => response.json()) // Парсимо відповідь як JSON
                .then(data => {
                    // Оновлюємо інтерфейс на основі відповіді
                    statusDiv.textContent = data.message;
                    if (data.available) {
                        statusDiv.style.color = 'green';
                        bookNowForm.style.display = 'block';
                        bookingFormDiv.querySelector('.hidden-start-date').value = startDate;
                        bookingFormDiv.querySelector('.hidden-end-date').value = endDate;
                    } else {
                        statusDiv.style.color = 'red';
                        bookNowForm.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    statusDiv.textContent = 'Сталася помилка. Спробуйте пізніше.';
                    statusDiv.style.color = 'red';
                });
        });
    });

    const burger = document.querySelector('.admin-burger');
    const sidebar = document.querySelector('.admin-sidebar');
    const overlay = document.querySelector('.admin-overlay');

    if (burger && sidebar && overlay) {

        const closeMenu = () => {
            burger.classList.remove('is-open');
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-open');
        };

        burger.addEventListener('click', function () {
            this.classList.toggle('is-open');
            sidebar.classList.toggle('is-open');
            overlay.classList.toggle('is-open');
        });

        overlay.addEventListener('click', closeMenu);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('is-open')) {
                closeMenu();
            }
        });
    }
});