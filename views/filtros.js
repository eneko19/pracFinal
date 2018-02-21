

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
//Añadir y quitar unidades en el carrito

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
      if (names.value != "") {
        if (email.value.match(formEmail)) {
          if (address.value != ""){
            if (postalcode.value.match(postalCode)){
              if (user.value != ""){
            if (password.value.match(formPass)) {
              if (password.value == passwordConfirm.value) {
                  document.getElementById("submit").submit();
                echo("Todos los datos correctos.");
            } else {
              passwordConfirmErr.innerHTML = "Las contraseñas no coinciden.";
              passwordConfirm.focus();
            }

          } else {
            passwordErr.innerHTML = "Contraseña inválida.";
            password.focus();
          }
        }else{
          userErr.innerHTML = "Usuario vacío.";
          user.focus();
        }
        }else{
          postalcodeErr.innerHTML = "Codigo postal incorrecto.";
          postalcode.focus();
        }
        }else {
          addressErr.innerHTML = "Dirección vacía.";
          address.focus();
        }
        } else {
          emailErr.innerHTML = "Email incorrecto.";
          email.focus();
        }
      } else {
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
    
    function sumarUnidad(x){
        x = document.getElementById("a"+x);
        valor = parseInt(x.value);
        x.value = valor+1;

    }
        function restarUnidad(x){
        x = x = document.getElementById("a"+x);
        valor = parseInt(x.value);
        if(valor <= 1){
            x.value = 1;
        }else{
         x.value = valor-1;
        }
 
    }