(() => {

    let original_button_text = "";
    let submit_button = document.querySelector(".elegant_lead_form button");
    let notice = document.querySelector(".elegant_lead_form .notice");
    const showNotice = (message, className) => {
        notice.innerText = message;
        notice.style.display = 'block';
        notice.classList.add(className);
        setTimeout(() => {
            notice.style.display = 'none';
            notice.classList.remove(className);
        }, 5000);
    };

    if (submit_button && elegant_lead) {
        // easter-egg
        submit_button.addEventListener('dragstart', (event) => {
            const dragged = event.target;
            original_button_text = dragged.innerText;
            dragged.innerText = 'Elegant Themes ♥';
        });
        submit_button.addEventListener('dragend', (event) => {
            const dragged = event.target;
            dragged.innerText = original_button_text;
        });

        submit_button.addEventListener('click', (event) => {
            event.preventDefault();
            const formData = new FormData(submit_button.closest('form'));
            formData.append('action', 'elegant_form_action');

            const data = [...formData.entries()];
            const asString = data
                .map(x => `${encodeURIComponent(x[0])}=${encodeURIComponent(x[1])}`)
                .join('&');

            fetch(elegant_lead.ajax_url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
                body: asString,
            }).then(function (response) {
                if (response.ok) {
                    return response.json();
                }
                return Promise.reject(response);
            }).then(function ({data}) {
                showNotice(data.message, 'success');
            }).catch(function (error) {
                showNotice(error, 'error');
            });
        });
    }
})();
