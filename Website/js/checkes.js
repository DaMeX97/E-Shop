function checkAdmin(){
  checkUtente();
  if(sessionStorage.getItem("Admin") != 1){
    window.location.href = "../";
  }
}

function checkUtente(){
  if(sessionStorage.getItem("Logged") != "true"){
    window.location.href = "../";
  }
}