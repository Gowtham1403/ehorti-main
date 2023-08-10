// open login Modal
$(document).ready(function(){
    $("#loginModal").modal('show');
});
setTimeout(function (){
    $('#emailPhone').focus();
}, 1000);

// navbar

const navBtn = document.getElementById("navBtn");
const navTarget = document.getElementById("navbarSupportedContent");
if(navBtn){
    navBtn.onclick = () => {
        if (navTarget.classList[0] === "navShow"){
            navTarget.classList.remove("navShow");
        }
        else{
            navTarget.classList.add("navShow");
        }
    }
}

// show-hide password

const showPass = document.getElementById("show-pass"),
hidePass = document.getElementById("hide-pass"),
password = document.getElementById("passEle");

if(hidePass){
    hidePass.onclick = () =>{
        if(password.getAttribute('type') === "password"){
            password.setAttribute('type','text');
            hidePass.classList.add('d-none');
            showPass.classList.add('d-block');
        }
    }
} 
if(showPass) {
    showPass.onclick = () => {
        if(password.getAttribute('type') === "text"){
            password.setAttribute('type','password');
            hidePass.classList.remove('d-none');
            showPass.classList.remove('d-block');
        }
    }
}

// login to create account

const createAccBtn = document.getElementById("createAccBtn"),
loginAccBtns = document.querySelectorAll("#loginAccBtn"),
createAcc = document.getElementById("createAcc"),
loginAcc = document.getElementById("loginAcc");

if(createAccBtn){
    createAccBtn.onclick = () => {
        loginAcc.classList.add("d-none");
        createAcc.classList.remove("d-none");
    }
}

loginAccBtns.forEach(loginAccBtn => {
    loginAccBtn.onclick = (e) => {
        signupEmailPhone.value = "";
        errorMsg.innerHTML = "";
        signupEmailPhone.classList.remove("input-error");
        signup.classList.remove("d-none");
        continuePage.classList.add("d-none");
        loginAcc.classList.remove("d-none");
        createAcc.classList.add("d-none")
    }
});

function loginBtnFun(){
    loginAcc.classList.remove("d-none");
    createAcc.classList.add("d-none")
}

function createBtnFun(){
    loginAcc.classList.add("d-none");
    createAcc.classList.remove("d-none");
}

// post img Preview

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }


// searchbar 

const searchInput = document.getElementById("main-search"),
searchBtn = document.getElementById("searchBtn"),
searchOpt = document.getElementById("searchSuggestion");

if(searchInput){
searchInput.onkeyup = () => {
    var searchVal = searchInput.value;
    searchOpt.innerHTML = "";
    if(searchVal === ''){
        searchOpt.style.display = "none";
    }
    else{
        $.ajax({
            type: "post",
            url: "server/receive/search-post.php",  
            data:{
                key : "productSearch",
                searchTerm : searchVal
            } ,
            dataType: "json",
            success: function (response) {
                if(response.length === 0){
                    searchOpt.innerHTML = `<option>No Search Result Found.</option>`;  
                }
               else if(response.length > 0){
                    searchOpt.style.display = "block";
                    searchOpt.style.padding = "10px";
                    searchOpt.style.border= "1px";
                    searchOpt.style.borderColor = "rgba(0,0,0,0.3)";
                    searchOpt.style.borderStyle = "solid";
                }
                else{
                    searchOpt.innerHTML = `<option>No Search Result Found.</option>`;  
                }
                console.log(response);
                for (let index = 0; index < response.length; index++) {
                    searchOpt.innerHTML += `<option>${response[index]}</option>`;                             
                }
            }
        });
    }
}
}

if(searchBtn){
searchBtn.onclick = (e) => {
    e.preventDefault();
    if(searchInput.value === ""){
        window.location.href = "index.php";
    }
    else
        window.location.href = "index.php?q=" + searchInput.value;
}
}


// other nav
const search_input = document.getElementById("searchInput"),
seaBtn = document.getElementById("seaBtn"),
seaOpt = document.getElementById("searchSug");

if(search_input){
search_input.onkeyup = (e) => {
    var searchVal = search_input.value;
    seaOpt.innerHTML = "";
    if(searchVal === ''){
        seaOpt.style.display = "none";
    }
    else{
        $.ajax({
            type: "post",
            url: "../server/receive/search-post.php",
            data:{
                key : "productSearch",
                searchTerm : searchVal
            } ,
            dataType: "json",
            success: function (response) {
                if(response.length === 0){
                    seaOpt.innerHTML = `<option class="disabled" aria-disabled="true">No Search Result Found.</option>`;  
                }
                else if(response.length > 0){
                    seaOpt.style.display = "block";
                    seaOpt.style.padding = "10px";
                    seaOpt.style.border= "1px";
                    seaOpt.style.borderColor = "rgba(0,0,0,0.3)";
                    seaOpt.style.borderStyle = "solid";
                }
                else{
                    seaOpt.innerHTML = `<option class="disabled" aria-disabled="true">No Search Result Found.</option>`;
                }
                for (let index = 0; index < response.length; index++) {
                    seaOpt.innerHTML += `<option>${response[index]}</option>`;                             
                }
            }
        });
    }
}
}

if(seaBtn){
seaBtn.onclick = (e) => {
    e.preventDefault();
    if(search_input.value === ""){
        window.location.href = "../index.php";
    }
    else
        window.location.href = "../index.php?q=" + search_input.value;
}
}

// location and Address bar

const locInput = document.getElementById("loc-search"),
locBtn = document.getElementById("locBtn"),
locOpt = document.getElementById("locSearchSuggestion"),
identifyInnerNav = document.getElementById("identify-innerNav");

if(locInput){
locInput.onkeyup = () => {
    var searchVal = locInput.value;
    locOpt.innerHTML = "";
    if(searchVal === ''){
        locOpt.style.display = "none";
    }
    else{
        $.ajax({
            type: "post",
            url: (identifyInnerNav)? "../server/receive/search-post.php" : "server/receive/search-post.php",  
            data:{
                key : "addressSearch",
                locSearchTerm : searchVal
            } ,
            dataType: "json",
            success: function (response) {
                if(response.length === 0){
                    locOpt.innerHTML = `<option>No Search Result Found.</option>`;  
                }
               else if(response.length > 0){
                    locOpt.style.display = "block";
                    locOpt.style.padding = "10px";
                    locOpt.style.border= "1px";
                    locOpt.style.borderColor = "rgba(0,0,0,0.3)";
                    locOpt.style.borderStyle = "solid";
                }
                else{
                    locOpt.innerHTML = `<option>No Search Result Found.</option>`;  
                }
                console.log(response);
                for (let index = 0; index < response.length; index++) {
                    locOpt.innerHTML += `<option class="text-truncate">${response[index]}</option>`;                             
                }
            }
        });
    }
}
}

if(locBtn){
locBtn.onclick = (e) => {
    e.preventDefault();
    if(locInput.value === ""){
        (identifyInnerNav)? window.location.href = "../index.php" : window.location.href = "index.php";
    }
    else
    (identifyInnerNav)? window.location.href = "../index.php?lq=" + locInput.value : window.location.href = "index.php?lq=" + locInput.value;
    }
}