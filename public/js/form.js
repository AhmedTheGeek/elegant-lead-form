(() => {
    let submit_button = document.querySelector(".elegant_lead_form button");
    if (submit_button && elegant_lead) {
        let formData = new FormData(submit_button.closest('form'));
        formData.append('action', 'elegant_form_action');

        submit_button.addEventListener('click', (event) => {
            event.preventDefault();

            const data = [...formData.entries()];
            const asString = data
                .map(x => `${encodeURIComponent(x[0])}=${encodeURIComponent(x[1])}`)
                .join('&');
            console.log(asString);
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
            }).then(function (data) {
                console.log(data);
            }).catch(function (error) {
                console.warn(error);
            });
        });
    }
})();
