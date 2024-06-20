document.addEventListener('DOMContentLoaded', function() {

    const urlParams = new URLSearchParams(window.location.search);


const emailParameter = urlParams.get('email');

 
console.log(emailParameter);
document.getElementById('profileName').innerHTML = emailParameter;

});