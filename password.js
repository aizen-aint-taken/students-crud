function myPassword(){
    const password = document.getElementById("mypass");
   
    if(password.type === "password"){
        return password.type = "text";
    } else {
        return password.type = "password";
    }
}