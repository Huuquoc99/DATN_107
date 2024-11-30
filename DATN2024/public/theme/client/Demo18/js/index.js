const registerButton = document.getElementById('register1');
const loginButton = document.getElementById('login1');
const container = document.getElementById('container1');

registerButton.addEventListener('click', () => {
    container.classList.add("right-panel-active1");
});

loginButton.addEventListener('click', () => {    
    container.classList.remove("right-panel-active1");
});


