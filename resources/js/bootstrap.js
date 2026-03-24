import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher=Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,      
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  
    forceTLS: true,       // use ws://
   
});
console.log("app js loading");


window.Echo.private('admin.notifications').listen('.role.permission.updated',(e)=>{

// *****************SKIP THE USER WHO EDIT THE ROLE******************************
if(e.updatedBy===window.AUTH_USER_ID)
{
    return;
}


console.log('Admin Notification:', e.message);

           
        Toastify({
            text: e.message,
            duration: 4000,
            gravity: "top",
            position: "right",
            close: true,
            backgroundColor: "#4f46e5"
        }).showToast();
})
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
