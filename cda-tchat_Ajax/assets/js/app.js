document.addEventListener('DOMContentLoaded', function () {
    const div_container = document.querySelector('.container__chat');
    const button = document.querySelector('button');
    const alert = document.querySelector('.alert');
    const p_alert = document.createElement('p');

    function refresh() {
        fetch(`index.php?loc=home&action=read`)
            .then(response => response.json())
            .then(json => {
                //console.log(json.time * 1000, ':', Date.now() - 5000, json.time * 1000 < Date.now() - 5000)
                if (json.time * 1000 < Date.now() - 5000) {
                    p_alert.textContent = "Aucun message n'a été transmis durant les 5 dernières secondes";
                    alert.appendChild(p_alert);
                } else {
                    alert.innerHTML = "";
                }
                template(json.data);
            });
    }

    setInterval(refresh, 5000)


    button.addEventListener('click', function (e) {
        e.preventDefault();
        let input_pseudo = document.querySelector('#pseudo')
        let text_area = document.querySelector('#message');
        let message = text_area.value;
        let pseudo = input_pseudo.value;
        let formData = new FormData();
        formData.append('pseudo', input_pseudo.value);
        formData.append('message', text_area.value);


        fetch(`index.php?loc=home&action=ajax`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(json => refresh()); //pour raffraichir le contenu des l'envoie du message
    })

    function template(json) {
        div_container.innerHTML = "";
        json.forEach(element => {
            const p_message = document.createElement('p');
            p_message.textContent = element.pseudo_conversation + " : " + element.message_conversation;
            div_container.appendChild(p_message);
        });
    }


})