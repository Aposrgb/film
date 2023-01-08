document.querySelector('#login').onclick = openLogin;
document.querySelector('#close_login').onclick = openLogin;
document.querySelector('#signup').onclick = openSignup;
document.querySelector('#close_signup').onclick = openSignup;
document.querySelector('#toLogin').onclick = () =>{
  openLogin();
  openSignup();
};
document.querySelector('#toSignup').onclick = () =>{
  openLogin();
  openSignup();
};

function openPass(){
  let type = document.getElementById('regPassword').type
  document.getElementById('regPassword').type = type === 'password' ? 'text' : 'password'
}

document.querySelector('#login_burger').onclick = openLogin;
document.querySelector('#signup_burger').onclick = openSignup;

/*Открыть меню бургер*/
document.querySelector('.burger').addEventListener('click', ()=>{
  document.querySelector('.burger').classList.toggle('active');
  document.querySelector('.list_burger').classList.toggle('hidden');
});

function openLogin(){
  document.querySelector('.wrapper_login').classList.toggle('hidden');
  document.querySelector('.modal.login').classList.toggle('hidden');
}

function openSignup(){
  document.querySelector('.wrapper_signup').classList.toggle('hidden');
  document.querySelector('.modal.signup').classList.toggle('hidden');
}

/*Вход в аккаунт из регистрации*/

/*Вход в аккаунт из регистрации*/
// document.querySelector('#in').addEventListener('click', (e) => {
//   e.preventDefault();
//   if (document.documentElement.clientWidth < 450) {
//     document.querySelector('.login_burger').classList.toggle('hidden');
//     document.querySelector('.account_burger').classList.toggle('hidden');
//   } else {
//     document.querySelector('.login').classList.toggle('hidden');
//     document.querySelector('.account').classList.toggle('hidden');
//   }
//   openLogin();
// });

/*Выход из аккаунта десктоп версия*/
// document.querySelector('#logOut').addEventListener('click', (e) => {
//   e.preventDefault();
//   document.querySelector('.login').classList.toggle('hidden');
//   document.querySelector('.account').classList.toggle('hidden');
//   document.querySelector('#menu').classList.toggle('hidden');
// });
/*Выход из аккаунта мобильная версия*/
// document.querySelector('#logOut_burger').addEventListener('click', (e) => {
//   e.preventDefault();
//   document.querySelector('.login_burger').classList.toggle('hidden');
//   document.querySelector('.account_burger').classList.toggle('hidden');
// });

/*Каталог обычная версия*/
function catalogOn() {
  document.querySelector('#catalog').classList.remove('hidden');
};
function catalogOff() {
  document.querySelector('#catalog').classList.add('hidden');
};
document.querySelector('#catalog_button').onmouseenter = catalogOn;
document.querySelector('nav').onmouseleave = catalogOff;


/*Меню обычная версия*/
document.querySelector('.account').onclick = menu;
function menu(){
  document.querySelector('#menu').classList.toggle('hidden');
}

/*Каталог мобильная версия*/
document.querySelector('#catalog_button_burger').addEventListener('click', ()=>{
  document.querySelector('#catalog_burger').classList.toggle('hidden');
});

/*Избранное*/
document.querySelectorAll('.fav').forEach(e => e.addEventListener('click', () => {
  e.classList.toggle('active');
}));

/*Согласие на обработку в форме*/
document.querySelector('.check').onclick = () =>{
  document.querySelector('.check').classList.toggle('active');
}
