const sendmailform = document.querySelector("#contactForm");
sendmailform.addEventListener('submit', (event) => {
    // stop form submission
    const name = document.querySelector("#name");
    const email = document.querySelector("#email");
    const phone = document.querySelector("#phone");
    const message = document.querySelector("#message");
    // const formdata = new FormData(this);
    let formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('tel', phone);
    formData.append('message', message);
    fetch('/api/send-email/',{
        method: "POST",
        mode: 'no-cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        headers: {
            "Access-Control-Allow-Origin": "*",
            'Content-Type': 'application/x-www-form-urlencoded'
            
          },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: formData,
    }).then(res=>res.json())
    .then(data => {
        console.log(data)
        alert(data.msg);
    })

    event.preventDefault();
});