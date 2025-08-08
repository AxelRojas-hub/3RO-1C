function userCounter(username) {
    const visits = localStorage.getItem(username) || 0;
    const newVisits = parseInt(visits) + 1;
    localStorage.setItem(username, newVisits);
    return newVisits;
}

// Al cargar la pág recupera la lista de localStorage y la muestra
function getLocalList() {
    const listContainer = document.getElementById('list-container');
    const list = localStorage.getItem('list') || '[]';
    const parsedList = JSON.parse(list);
    for (let item of parsedList) {
        const listElement = document.createElement('li');
        listElement.textContent = item;
        listContainer.appendChild(listElement);
    }
};
function main() {
    const loginForm = document.getElementById('login-form');
    const loginMsg = document.querySelector('.login-msg');
    const userMsg = document.querySelector('.login-usermsg');
    const visitCounter = document.querySelector('.visit-counter');

    const listForm = document.getElementById('list-form');
    const listContainer = document.getElementById('list-container');
    const listBtn = document.querySelector('.list-form__btn');
    const listInput = document.querySelector('.list-form__input');
    const listResetBtn = document.querySelector('.list-reset-btn');
    //Recupera el nombre, actualiza el msg de bienvenida, el contador de visitas y oculta el formulario de visita.
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const username = event.target["nombre-usuario"].value;
        loginForm.removeAttribute('required');
        loginForm.style.display = 'none';
        loginMsg.style.display = 'block';
        userMsg.innerHTML = `Bienvenido ${username}`
        visitCounter.innerHTML = userCounter(username);
        listBtn.removeAttribute('disabled');
        listInput.removeAttribute('disabled');
        listResetBtn.removeAttribute('disabled');
        listInput.focus();
    });

    // Recupera el valor del input, lo añade a la lista y limpia el input. Habilita el boton de borrar la lista.
    listForm.addEventListener('submit', (event) => {
        event.preventDefault();
        if (event.target["list-item"].value === '') {
            alert('El campo no puede estar vacío');
            return;
        }
        if (listResetBtn.hasAttribute('disabled')) {
            listResetBtn.removeAttribute('disabled');
        }
        const listItem = event.target["list-item"].value;
        // Persiste el valor en localStorage.
        const list = localStorage.getItem('list') || '[]';
        const parsedList = JSON.parse(list);
        parsedList.push(listItem);
        localStorage.setItem('list', JSON.stringify(parsedList));
        // Añade el valor a la lista de la página.
        const listElement = document.createElement('li');
        listElement.textContent = listItem;
        listContainer.appendChild(listElement);
        listInput.value = '';
        listInput.focus();
    });
    // Elimina la lista de elementos y deshabilita el boton de borrar la lista.
    listResetBtn.addEventListener('click', (event) => {
        event.preventDefault();
        if (confirm('¿Estás seguro de que queres borrar la lista?')) {
            localStorage.removeItem('list');
        }
        listContainer.innerHTML = '';
        listResetBtn.setAttribute('disabled', 'disabled');
        listInput.focus();
    });

};

main();