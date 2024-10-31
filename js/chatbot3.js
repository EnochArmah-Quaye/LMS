var sendBtn = document.getElementById('sendBtn');
var textbox = document.getElementById('textbox');
var chatContainer = document.getElementById('chatContainer');



function generateresponse(){
    
    fetch("response.php",{
        method: "post",
        body: JSON.stringify({
            text: textbox.value,
        }),
    })
    .then((res) => res.text())
    .then((res) => {
        var messageElement = document.createElement('div');
    messageElement.classList.add('w-50');
    messageElement.classList.add('float-right');
    messageElement.classList.add('shadow-sn');
    messageElement.style.margin = "10px";
    messageElement.style.padding = "5px";

    messageElement.innerHTML = "<span> Chatbot: </span>"+
    "<span style="+"margin-top:10px; padding:10px"+">"+ res +"</span>";

    messageElement.animate([{easing:"ease-in",opacity:0.4},{opacity:1}],{duration:1000});   

    chatContainer.appendChild(messageElement);

    chatContainer.scrollTop = chatContainer.scrollHeight;
    })
}

function sendMessage(messageText){
    
    var messageElement = document.createElement('div');
    messageElement.classList.add('w-50');
    messageElement.classList.add('float-right');
    messageElement.classList.add('shadow-sn');
    messageElement.style.margin = "10px";
    messageElement.style.padding = "5px";

    messageElement.innerHTML = "<span> Me: </span>"+
    "<span style="+"margin-top:10px; padding:10px"+">"+ messageText +"</span>";

    messageElement.animate([{easing:"ease-in",opacity:0.4},{opacity:1}],{duration:1000});

    chatContainer.appendChild(messageElement);

    chatContainer.scrollTop = chatContainer.scrollHeight;

   generateresponse();
};

sendBtn.addEventListener('click',function(e){

    if(textbox.value == ""){
        alert('Please type in a message');
    }
    else{
    let messageText = textbox.value;
    sendMessage(messageText);
    textbox.value = "";
    }
});