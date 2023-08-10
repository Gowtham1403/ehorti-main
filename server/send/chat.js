const chatInput = document.getElementById("chatInput"),
sendBtn = document.getElementById("sendBtn"),
chatBtn = document.getElementById("chatBtn"),
sellerEmail = document.getElementById("sellerEmail"),
productID = document.getElementById("productID"),
chatBody = document.getElementById("chat-body"),
customerChatinput = document.getElementById("customerChatInput"),
customerChatBody = document.getElementById("customerChat-body"),
customerSendBtn = document.getElementById("customerSendBtn"),
customerChatBtn = document.getElementById("customerChatBtn") ,
customerSellerEmail = document.getElementById("cusSellerEmail"),
customerProductId = document.getElementById("cusproductID");
if(chatBody){
    scrollToBottom(chatBody);
}
if(customerChatBody){
    scrollToBottom(customerChatBody);
}
if(chatInput){
    chatInput.addEventListener("keyup",()=>{
        if(chatInput.value !== "" && chatInput.value.trim().length !== 0){
            chatBtn.classList.add("my-d-block");
        }
        else{
            chatBtn.classList.remove("my-d-block");
    
        }
    }); 
}

if(customerChatinput){
    customerChatinput.addEventListener("keyup",()=>{
        if(customerChatinput.value !== "" && customerChatinput.value.trim().length !== 0){
            customerChatBtn.classList.add("my-d-block");
        }
        else{
            customerChatBtn.classList.remove("my-d-block");
        }
    }); 
}

if(sendBtn){
    sendBtn.onclick = (e) =>{
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "../server/receive/chat.php",
            data:{
                key : "chatSend",
                productID : productID.value,
                customerMsg : chatInput.value,
                sellerEmail : sellerEmail.value
            } ,
            dataType: "text",
            success: function (response) {
                chatBody.innerHTML = response;
                scrollToBottom(chatBody);
            }
        });
        chatInput.value = "";
    }
}

if(customerSendBtn){
    customerSendBtn.onclick = (e) =>{
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "../server/receive/chat.php",
            data:{
                key : "customerChatSend",
                productID : customerProductId.value,
                sellerMsg : customerChatinput.value,
                customerEmail : customerSellerEmail.value
            } ,
            dataType: "text",
            success: function (response) {
                customerChatBody.innerHTML = response;
                scrollToBottom(customerChatBody);
            }
        });
        customerChatinput.value = "";
    }
}

if(sellerSendBtn){
    sellerSendBtn.onclick = (e) =>{
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "../server/receive/chat.php",
            data:{
                key : "chatSend",
                productID : customerProductId.value,
                customerMsg : customerChatinput.value,
                sellerEmail : customerSellerEmail.value
            } ,
            dataType: "text",
            success: function (response) {
                customerChatBody.innerHTML = response;
                scrollToBottom(customerChatBody);
            }
        });
        customerChatinput.value = "";
    }
}
// auto loaded
$(document).ready(function(){
    setInterval(function(){
        $("#chat-body").load(" #chat-body > *");
        $("#customerChat-body").load(" #customerChat-body > *");
        $("#buyingchat-body").load(" #buyingchat-body > *");
    }, 1000);
});

function scrollToBottom(bodyChat) {
    bodyChat.scrollTop = bodyChat.scrollHeight;
}
