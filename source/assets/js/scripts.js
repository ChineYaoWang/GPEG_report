function CheckPassword(){
    let message = document.getElementById("message");
    console.log(message.innerText);
    if(message == "Matching"){
        return true;
    }
    else{
        
        return false;
    }
}
function test(){
    console.log("test");
    return;
}
