async function checkPasswordStrength() {
    const cname = document.getElementById("name").value;
    const csurname = document.getElementById("surname").value;
    const cemail = document.getElementById("email").value;
    const cpassword = document.getElementById("password").value;
    const strength_text = document.getElementById("password-strength-text");
    const json = {
        "name" : cname,
        "surname": csurname,
        "email": cemail,
        "password": cpassword
    }

    await fetch('http://127.0.0.1:5000/evaluate-password', {
        method: 'POST',                
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(json)
    }).then(response => {

        if(!response.ok){
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    }).then(data=>
        {console.log(data.classification);
            const strength_bar = document.getElementById('strength_bar');
            strength_bar.classList.remove("weak");
            strength_bar.classList.remove("medium");
            strength_bar.classList.remove("strong");
            strength_bar.classList.add(data.classification.toLowerCase());
            const recm = data.recommendations; 
            const text = recm.join("\n");
            const pass = data.strong_password;
            document.querySelectorAll(".messageBox").forEach(el => el.remove());
            message_box("Password Recommendations", text, pass );
        }
    );
}


function message_box(status, message,strong_password){ 
    const messageBox = document.createElement('div');
    messageBox.className= "messageBox";
    messageBox.style.color = 'red'; 
    messageBox.style.position = 'fixed';
    messageBox.style.bottom = '20px';
    messageBox.style.right = '20px';
    messageBox.style.width = '300px';
    messageBox.style.padding = '15px';
    messageBox.style.border = '1px solid #ccc';
    messageBox.style.borderRadius = '8px';
    messageBox.style.backgroundColor = '#f9f9f9';
    messageBox.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
    messageBox.style.fontFamily = 'Arial, sans-serif';
    messageBox.style.fontSize = '25px';
    messageBox.style.zIndex = '1000';

    const strip = document.createElement('div');    
    strip.textContent = status.toUpperCase();
    strip.style.padding = '15px';
    strip.style.width = '300px';
    strip.style.height = '60px';
    strip.style.marginLeft = '-15px';
    strip.style.marginTop = '-15px';
    strip.style.borderTopLeftRadius = '8px';
    strip.style.borderTopRightRadius = '8px';
    strip.style.position= 'relative';
    strip.style.zIndex = '-150';
    strip.style.backgroundColor = ' #00000014';
    messageBox.appendChild(strip);

    const messageContent = document.createElement('div');
    messageContent.textContent = message;
    messageContent.style.color = 'black';
    messageContent.style.fontSize = '20px';
    messageBox.appendChild(messageContent);
    
    const closeButton = document.createElement('button');
    closeButton.textContent = 'X';
    closeButton.style.position = 'absolute';
    closeButton.style.top = '5px';
    closeButton.style.right = '5px';
    closeButton.style.border = 'none';
    closeButton.style.backgroundColor = 'transparent';
    closeButton.style.cursor = 'pointer';
    closeButton.style.fontSize = '16px';
    closeButton.style.fontWeight = 'bold';
    closeButton.style.color = '#999';
    
    closeButton.addEventListener('click', () => {
        document.body.removeChild(messageBox);
    });
    
    messageBox.appendChild(closeButton);
    
    const strong_pass = document.createElement('div');
    
    strong_pass.textContent ="Strong password example: "+ strong_password;

    messageBox.appendChild(strong_pass);
    
    // Mesaj kutusunu sayfaya ekle
    document.body.appendChild(messageBox);
    }