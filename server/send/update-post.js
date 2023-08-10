// update post

const updatePostBtn = document.getElementById("updatePostBtn"),
updatePostForm = document.getElementById("upatePostForm"),
upPrice = document.getElementsByName("upprice")[0],
upQuantity = document.getElementsByName("upquantity")[0],
updatePostError = document.getElementById('updatePostError'),
updatePostId = document.getElementById('updatePostId')
console.log();
if(updatePostBtn){
    updatePostBtn.onclick = (e) =>{
        e.preventDefault();
        if(upPrice.value !== "" && upPrice.value.trim().length !== 0 && upQuantity.value !== "" && upQuantity.value.trim().length !== 0){
            $.ajax({
                url: '../server/receive/update-post.php',
                type:'POST',
                data: {
                    key : "updatePost",
                    updatePostId : updatePostId.value,
                    updatePrice : upPrice.value, 
                    updateQuan : upQuantity.value
                },
                dataType: 'text',
                success : function(res){
                    if(res === "success"){
                        window.location.href = "sales.php";
                    }
                }
            });
        }
        else{
            updatePostError.innerHTML = "All Feild are Required !.";
        }
    }
}