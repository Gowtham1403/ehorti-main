// selling post

const postUploadBtn = document.getElementById("postUploadBtn"),
postImg = document.getElementById("postImgName"),
postName = document.getElementById("postName"),
postPrice = document.getElementById("postPrice"),
postQua = document.getElementById("postQuantity"),
postCate = document.getElementById("postCategory"),
postUnit = document.getElementById("postUnit"),
postDes = document.getElementById("postDescription"),
postErr = document.getElementById("postErr"),
postSellingForm = document.getElementById("postSellingForm");

postSellingForm.onsubmit = (e) => {
    e.preventDefault();
    if( postName.value !== "" && postPrice.value !== "" && postQua.value !== "" && postCate.value !== "" && postUnit.value !== "" && postImg.value !== ""){
        var formData = new FormData(postSellingForm);
        $.ajax({
            url: '../server/receive/selling-post.php',
            type:'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false, 
            processData:false,
            success: function(result){
                console.log(result);
            },
            error : function(res){
                if(res.responseText === "success"){
                    window.location.href = "../component/selling.php";
                    window.alert("Success Uploaded");

                }
                console.log(response);
                
            }
        });
    }
    else{
        postErr.innerText = "All Feilds are Required !.";
    }
}