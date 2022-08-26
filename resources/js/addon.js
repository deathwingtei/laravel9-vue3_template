const sendmailform = document.querySelector("#contactForm");
sendmailform.addEventListener('submit', (event) => {
    const formdatax = new FormData(sendmailform);
    let formData = new FormData();
    const name = document.querySelector("#name");
    const email = document.querySelector("#email");
    const tel = document.querySelector("#tel");
    const message = document.querySelector("#message");
    formData.append('name', name);
    formData.append('email', email);
    formData.append('tel', tel);
    formData.append('message', message);
    document.querySelector("#loader-container").style.display = "block";
    fetch('/api/send-email/',{
        method: "POST",
        body: formdatax,
    }).then(res=>res.json())
    .then(data => {
        console.log(data)
        alert(data.msg);
    })
    .catch(err => {
        console.log(err);
    }).finally(function(){
        document.querySelector("#loader-container").style.display = "none";
    });

    event.preventDefault();
});