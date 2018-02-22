

$(document).ready(function() {
// Agrandar imagen del producto
    $('.zoom').hover(function() {
        $(this).addClass('agrandarImg');
    }, function() {
        $(this).removeClass('agrandarImg');
    });

// Hover dropdown
$('ul.nav li.dropdown, div.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});

// Filtros de producto
  $(".filtro").change(function() {
    if ($(this).hasClass("activated")) {
      $(this).removeClass("activated");
    } else {
      $(this).addClass("activated");
    }
    $idBrands = [];

    $(".activated").each(function() {
      $idBrands.push($(this).attr("id"));
    });

    $(".card").each(function() {
      $prodPrice = parseInt($(this).find(".card-text").text());
      $priceMin = $("#price-min").val();
      $priceMax = $("#price-max").val();

      if ($idBrands.length && jQuery.inArray($(this).attr("id"), $idBrands) === -1) {
          //alert($prodPrice);

          $(this).parent().hide();
      } else {
          $(this).parent().show();
      }
    });
  });
});

// Funciones de formulario
    // Función que comprueba si los campos son correctos
    function comprobar() {
      var formEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var formPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
      var postalCode = /^(?:0?[1-9]|[1-4]\d|5[0-2])\d{3}$/;

      // Si los valores de los campos son correctos mostrará un alert
      // si no escribirá un mensaje de incorrecto y pasará a color rojo
      if (names.value != "") {document.getElementById("nameErr").classList.add("invisible");
        if (email.value.match(formEmail)) {document.getElementById("emailErr").classList.add("invisible");
          if (address.value != ""){document.getElementById("addressErr").classList.add("invisible");
            if (postalcode.value.match(postalCode)){document.getElementById("postalcodeErr").classList.add("invisible");
              if (user.value != ""){document.getElementById("userErr").classList.add("invisible");
            if (password.value.match(formPass)) {document.getElementById("passwordErr").classList.add("invisible");
              if (password.value == passwordConfirm.value) {document.getElementById("passwordConfirmErr").classList.add("invisible");
                  document.getElementById("submit").submit();
            } else {
              document.getElementById("passwordConfirmErr").classList.remove("invisible");
              passwordConfirmErr.innerHTML = "Las contraseñas no coinciden.";
              passwordConfirm.focus();
            }

          } else {
            document.getElementById("passwordErr").classList.remove("invisible");
            passwordErr.innerHTML = "Contraseña inválida.";
            password.focus();
          }
        }else{
          document.getElementById("userErr").classList.remove("invisible");
          userErr.innerHTML = "Usuario vacío.";
          user.focus();
        }
        }else{
          document.getElementById("postalcodeErr").classList.remove("invisible");
          postalcodeErr.innerHTML = "Código postal incorrecto.";
          postalcode.focus();
        }
        }else {
          document.getElementById("addressErr").classList.remove("invisible");
          addressErr.innerHTML = "Dirección vacía.";
          address.focus();
        }
        } else {
          document.getElementById("emailErr").classList.remove("invisible");
          emailErr.innerHTML = "Email incorrecto.";
          email.focus();
        }
      } else {
        document.getElementById("nameErr").classList.remove("invisible");
        nameErr.innerHTML = "Nombre vacío.";
        names.focus();
      }
    }

    // Función que limpia los campos de error.
    function limpiar() {
      // Guardamos los campos de error en un array
      var arr = [nameErr, emailErr, addressErr, postalcodeErr, userErr,passwordErr,passwordConfirmErr];

      // Bucle que cambia los campos de error a vacío
      for (var i = 0; i < arr.length; i++) {
        arr[i].innerHTML = "";
      }
    }
// Función que suma una unidad en la vista de carrito
    function sumarUnidad(x){
        x = document.getElementById("a"+x);
        valor = parseInt(x.value);
        x.value = valor+1;

    }

    // Función que resta una unidad en la vista de carrito
        function restarUnidad(x){
        x = x = document.getElementById("a"+x);
        valor = parseInt(x.value);
        if(valor <= 1){
            x.value = 1;
        }else{
         x.value = valor-1;
        }
    }

/** Filtros precio **/
var preciosC = document.getElementsByClassName("precios");
var precios = [];
for (var i = 0; i < preciosC.length; i++) {
  // precios = precios + Number(document.getElementsByClassName("precios")[i].innerHTML.replace("€",""));
       precios.push(Number(document.getElementsByClassName("precios")[i].innerHTML.replace("€","")));
}
function checkMax(pre) {
    var precio = document.getElementById("priceMin").value;
    return pre >= precio;
}
function checkMin(pre) {
  var precio = document.getElementById("priceMax").value;
    return pre <= precio;
}

function filtrarPrecio() {
    document.getElementById("demo").innerHTML = precios.filter(checkMax);
    document.getElementById("demo").innerHTML = precios.filter(checkMin);
}
