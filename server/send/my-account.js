const nameUpdateInput = document.getElementById("nameUpdateInput"),
nameUpdateBtn = document.getElementById("nameUpdateBtn"),
nameUpdateErr = document.getElementById("nameUpdateErr"),
updateKey = document.getElementById("updateKey");

nameUpdateBtn.onclick = (e) => {
    e.preventDefault();
    if(nameUpdateInput.value !== ""){
        $.ajax({
            method : "POST",
            url: "../server/receive/my-account.php",
            data: {
                key : "updateUsername",
                updateEmail : updateKey.value,
                updateUsername : nameUpdateInput.value          
            },
            async : false,
            dataType: "text",
            success: function (response) {                            
                if(response === "success"){
                    location.href = "../component/edit-profile.php";
                }
                console.log(response);
            }
        });
    }
    else{
        nameUpdateErr.innerHTML = "Username Should Not be Empty.";
    }
}

const updateProfileBtn = document.getElementById("updateProfileBtn"),
upMobile = document.getElementById("upMobile"),
upGenderMale =document.querySelector("#upGenderMale"),
upGenderFemale =document.querySelector("#upGenderFemale"),
upGenderOthers =document.querySelector("#upGenderOthers"),
upPincode = document.getElementById("upPincode"),
upAddress = document.getElementById("upAddress"),
upDistrict = document.getElementById("upDistrict"),
upState = document.getElementById("upState"),
updateErr = document.getElementById("updateErr");

updateProfileBtn.onclick = (e) => {
    e.preventDefault();
    if(upMobile.value !== "" && upPincode.value !== "" && upAddress.value !== "" && upDistrict.value !== "" && upState.value !== "" && (upGenderMale.checked === true || upGenderFemale.checked === true || upGenderOthers.checked === true)){
            $.ajax({
                method : "POST",
                url: "../server/receive/my-account.php",
                data: {
                    key : "updateProfile",
                    mobile : upMobile.value,
                    gender : {
                        male : (upGenderMale.checked === true)? upGenderMale.value : "",
                        female : (upGenderFemale.checked === true)? upGenderFemale.value : "",
                        others :(upGenderOthers.checked === true)? upGenderOthers.value : "",
                    },
                    pincode : upPincode.value,
                    address : upAddress.value,
                    district : upDistrict.value,
                    state : upState.value,
                    updateUseremail : updateKey.value          
                },
                async : false,
                dataType: "text",
                success: function (response) {                            
                    if(response === "success"){                        
                        location.href = "../component/edit-profile.php";
                    }
                    console.log(response);
                }
            });
    }    
    else{
        updateErr.innerText = "All Feilds are Required !.";
    }
}
