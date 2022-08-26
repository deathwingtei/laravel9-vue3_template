const sendmailform = document.querySelector("#contactForm");
sendmailform.addEventListener('submit', (event) => {
    const formdatax = new FormData(sendmailform);
    let formData = new FormData();
    const name = document.querySelector("#name");
    const email = document.querySelector("#email");
    const phone = document.querySelector("#phone");
    const message = document.querySelector("#message");
    formData.append('name', name);
    formData.append('email', email);
    formData.append('tel', phone);
    formData.append('message', message);
    fetch('/api/send-email/',{
        method: "POST",
        body: formdatax,
    }).then(res=>res.json())
    .then(data => {
        console.log(data)
        alert(data.msg);
    })
    // .catch(err => {
    //     console.log(err);
    // })
    // return false;
    event.preventDefault();
});