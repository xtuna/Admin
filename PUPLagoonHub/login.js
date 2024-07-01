$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault();
        const username = $('#username').val();
        const password = $('#password').val();

        if(username === 'admin' && password === 'admin123') {
            window.location.href = 'admin.html';
        } else {
            alert('Invalid login credentials');
        }
    });
});
