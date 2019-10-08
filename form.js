document.querySelectorAll('form').forEach(function (form) {
    if (!form.action) {
        form.action = 'https://orderrouter-git-dev.ponomarevlad.now.sh'; // TODO: Replace this before production
        form.method = 'POST';
    }
    form.onsubmit = function (event) {
        event.target.querySelector('[type="submit"]').disabled = true;
        fetch(event.target.action + '?' + new URLSearchParams(new FormData(event.target)).toString(), {mode: "no-cors"})
            .then(function () {
                event.target.parentNode.classList.toggle('form-result', true);
                event.target.querySelector('[type="submit"]').disabled = false;
                alert('Спасибо, ваш заказ отправлен, скоро мы свяжемся с вами');
            });
        return false;
    };
});
console.log('Order forms ready ! 😉');