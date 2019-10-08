document.querySelectorAll('form').forEach(function (form) {
    if (!form.action) {
        form.action = 'https://form.ponomarev.studio';
        form.method = 'POST';
    }
    form.onsubmit = function (event) {
        event.target.querySelector('[type="submit"]').disabled = true;
        let parameters = new URLSearchParams(new FormData(event.target));
        if (new URLSearchParams(window.location.search).has('debugForms')) parameters.set('debug', 'mode'); // TODO: Debug mode
        fetch(event.target.action + '?' + parameters.toString(), {mode: "no-cors"})
            .then(function () {
                event.target.parentNode.classList.toggle('form-result', true);
                event.target.querySelector('[type="submit"]').disabled = false;
                alert('Спасибо, скоро мы свяжемся с вами');
            });
        return false;
    };
});