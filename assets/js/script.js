//========= DOM SELECTION===
let query = (sel) => document.querySelector(sel);
let queryAll = (sel) => document.querySelectorAll(sel);
let togglePsd = false;
let lock = query('.input-group-text');
let Psd = document.getElementById('password');
let lockUnlockIcon = query('#lockUnlockIcon');

let userSection = query('.dropdown-toggle');
let userDropDown = query('.dropdown');
let userDropDownMenu = query('.dropdown-menu');
let userMenuToggle = false;

let adminPageUserNameInput = query('#userName');
let adminPageUserPasswordInput = query('#password');





function showHidePassword() {

   if (Psd.value == '') { return; }
    if (!togglePsd) {
        Psd.type = 'text';
        togglePsd = true;
        lockUnlockIcon.setAttribute("class", "bi bi-unlock2")
    } else {
        Psd.type = 'password';
        togglePsd = false;
        lockUnlockIcon.setAttribute("class", "bi bi-lock");
    }
}

function showUserMenu() {
    console.log('function calling....');
    userDropDownMenu.classList.toggle('show');
    userDropDown.classList.toggle('show');
}
