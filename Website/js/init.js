function checkAdmin(){
  checkUtente();
  if(sessionStorage.getItem("Admin") != 1){
    window.location.href = "progettobasi2018.altervista.org";
  }
}

function checkUtente(){
  if(sessionStorage.getItem("Logged") == "true"){
    window.location.href = "progettobasi2018.altervista.org";
  }
}


function loadNavBar(){
  $.get("../navbar.html", function(data) {
    $("#navbar").html(data);

    if(sessionStorage.getItem("Logged") == "true"){
      $("#menuNavBar").html('<li><div class="input-field cerca"><input id="search" placeholder="Cerca" type="search" required><label for="search"></label><i class="material-icons">close</i></div></li><li><a class="dropdown-trigger" href="#" id="btnProfilo" data-target="profilo">' + sessionStorage.getItem("Nome") + " " + sessionStorage.getItem("Cognome") + ' ▼</a></li><li><a href="carrello.html">Carrello</a></li>');
      if(sessionStorage.getItem("Admin") != 1){
        $('#pannelloAdmin').remove();
      }	

      $('#btnProfilo').dropdown();    
    }

    $("#search").keyup(function(event) {
      if (event.keyCode === 13) {
        window.location.href = "cerca.html?q=" + $("#search").val();
      }
    });

  });
}

function loadFooter(){
  $.get("../footer.html", function(data) {
    $("#footer").html(data);
  });
}

function initialize(){
  //initialize all modals           
  $('.modal').modal();

  // initialize select
  $(document).ready(function(){
    $('select').formSelect();
  });

  $('.sidenav').sidenav();

  // INIZIALIZZAZIONE TABS
  $(document).ready(function(){
    $('.tabs').tabs();
  });

  // inizializzazione slider
  $(document).ready(function(){
    $('.slider').slider();
  });

  // inizializzazione conta caratteri textarea
  $('input#input_text, textarea#descrizione').characterCounter();

  // cambio colore dropdown
  $(".dropdown-content>li>a").css("color", "#1565c0"); 

  loadNavBar();
  loadFooter();
}

function caricaCategorieHome(){
  // caricamento categoria elettronica
  $.getJSON('/API/categorieHome.php?idCategoria=3', function(data) {
    var inner = "<tbody class='categoria'><tr>";
    for(var i = 0; i < data.length; i++){
      inner += "<td><div class='row'><div class='col'><a href='prodotto.html?id=" + data[i].idProdotto + "'><div class='card'><div class='card-image'><img class='card-img' src='img/prodotti/" + data[i].idProdotto + "'  onerror='defaultImage(this);'><a onclick='aggiungiAlCarrello("+data[i].idProdotto+", 1);' class='btn-floating pulse halfway-fab waves-effect waves-light blue'><i class='material-icons'>local_grocery_store</i></a></div><div class='card-content'><p>" +  data[i].Marca + " - " + data[i].Modello + "</p><br><div class='chip blue lighten-4 prezzo'>" + data[i].Prezzo + " €</div></div></a></div></div></td>";
    }

    inner += "</tr></tbody>";

    $("#categoriaElettronica").html(inner);
  });

  // caricamento categoria telefoni
  $.getJSON('/API/categorieHome.php?idCategoria=2', function(data) {
    var inner = "<tbody class='categoria'><tr>";
    for(var i = 0; i < data.length; i++){
      inner += "<td><div class='row'><div class='col'><a href='prodotto.html?id=" + data[i].idProdotto + "'><div class='card'><div class='card-image'><img class='card-img' src='img/prodotti/" + data[i].idProdotto + "'  onerror='defaultImage(this);'><a onclick='aggiungiAlCarrello("+data[i].idProdotto+", 1);' class='btn-floating pulse halfway-fab waves-effect waves-light blue' onclick ='aggiungiAlCarrello("+ data[i].idProdotto +");'><i class='material-icons'>local_grocery_store</i></a></div><div class='card-content'><p>" +  data[i].Marca + " - " + data[i].Modello + "</p><br><div class='chip blue lighten-4 prezzo'>" + data[i].Prezzo + " €</div></div></a></div></div></td>";
    }

    inner += "</tr></tbody>";

    $("#categoriaTelefoni").html(inner);
  });
}


// default image in caso di caricamento assente
function defaultImage(me){
  me.src="/img/prodotti/non_disponibile.jpg";
}	

// log out
function esci(){
  sessionStorage.clear();
  location.reload();
}

// aggiunta al carrello del prodotto
function aggiungiAlCarrello(idProdotto, Quantita){
  if(sessionStorage.getItem("Logged") != "true"){
    M.toast({html: 'Devi effettuare il login per poter aggiungere al carrello!', classes: 'rounded'} );
  }
  else{
    var idUtente = sessionStorage.getItem("idUtente");

    $.ajax({
      type: "GET",
      url: "/API/aggiungiCarrello.php?idUtente=" + idUtente + "&idProdotto=" + idProdotto + "&quantita=" + Quantita ,
      success : function() { 
        M.toast({html: 'Aggiunto al carrello!', classes: 'rounded'} );
      }
    });
  }
}

function caricaCategorie(){
  $.getJSON("/API/categorie.php", function(data){
    var inner = "";
    for(var i=0; i<data.length; i++){
      inner += '<option value="'+data[i].idCategoria+'">'+data[i].Nome+'</option>';
    }
    $("#categoria").html(inner);
    $('select').formSelect();
  });
}

$(document).ready(function() {
  initialize();
});

function reverse(s){
    var arr = s.split("/")
    var temp = arr[0];
    arr[0] = arr[2];
    arr[2] = temp;
    return arr.join("/");
}