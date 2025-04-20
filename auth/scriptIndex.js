

const loginForm=document.getElementById('login-form');
const registerForm=document.getElementById('register-form');
const loginBtn= document.getElementById('login');
const registerBtn=document.getElementById('signup');
loginBtn.addEventListener('click',()=>{
    loginForm.style.display='flex';
    registerForm.style.display='none';
  });
 registerBtn.addEventListener('click', ()=>{
    registerForm.style.display='flex';
    loginForm.style.display='none';
      });
