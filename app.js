// app.js

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

document.querySelector(".sign-in-form").addEventListener("submit", (event) => {
  event.preventDefault();

  const email = document.querySelector('.sign-in-form input[name="email"]').value;
  const password = document.querySelector('.sign-in-form input[name="password"]').value;

  const formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);

  fetch('login.php', {
    method: 'POST',
    body: formData,
  })
    .then(response => response.text())
    .then(data => {
      if (data === 'Login bem-sucedido') {
        window.location.href = "dashboard.html";
      } else {
        alert(data);
      }
    })
    .catch(error => {
      console.error('Erro ao processar a solicitação:', error);
    });
});

document.querySelector(".sign-up-form").addEventListener("submit", (event) => {
  event.preventDefault();

  const nome = document.querySelector('.sign-up-form input[name="nome"]').value;
  const email = document.querySelector('.sign-up-form input[name="email"]').value;
  const senha = document.querySelector('.sign-up-form input[name="password"]').value;

  const formData = new FormData();
  formData.append('nome', nome);
  formData.append('email', email);
  formData.append('senha', senha);

  fetch('cadastro.php', {
    method: 'POST',
    body: formData,
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'sucesso') {
        alert('Cadastro realizado com sucesso!');
      } else {
        alert(data.mensagem);
      }
    })
    .catch(error => {
      console.error('Erro ao processar a solicitação:', error);
    });
});
