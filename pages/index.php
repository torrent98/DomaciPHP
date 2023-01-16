<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Modern Beauty Salon</title>

    <link rel="stylesheet" href="global.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
          crossorigin="anonymous">


</head>

<body>
  <!-- MODAL IZMENA -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Izmena usluge</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <!-- FORMA PRILIKOM IZMENE-->

          <form>

            <div class="form-group centered">
              <label for="naziv_usluge">Naziv usluge:</label>
              <input type="text" class="form-control" id="naziv_usluge" value='' required>
            </div>

            <div class="form-group">
              <label for="pruzalac">Pruzalac usluge:</label>
              <select type="text" class="form-control" id="pruzalac" value='' required></select>
            </div>

            <fieldset disabled>

              <div class="form-group">
                <label for="broj_termina">Broj termina</label>

                <!-- POCETAN BROJ TERMINA -->
                <input type="text" id="broj_termina" class="form-control" placeholder="0">
              </div>

            </fieldset>

            <div class="d-grid gap-2">

                <a href='./terminiZaUslugu.php' id='sviTermini'>
                    <button class="btn btn-warning" style="color: #ffffff ;" type="button">Svi termini</button>
                </a>

            </div>

          </form>

        </div>

        <div class="modal-footer align_center">

          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #ffffff;">Zatvori</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="button_sacuvaj" style="color: #ffffff;">Sacuvaj</button>
          <button type='button' class="btn btn-danger" data-dismiss="modal" id="button_delete" style="color: #ffffff;">Obrisi</button>

        </div>

      </div>
    </div>
  </div>

  <!--MODAL DODAVANJE-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Dodavanje nove usluge</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <div class="modal-body">

          <!--FORMA PRILIKOM UNOSA-->

          <form>

            <div class="form-group">
              <label for="naziv_usluge_dodaj">Naziv usluge:</label>
              <input type="text" class="form-control" id="naziv_usluge_dodaj" placeholder="" required>
            </div>

            <div class="form-group">
              <label for="pruzalac_dodaj">Pruzalac usluge:</label>
              <select class="form-control" id="pruzalac_dodaj" placeholder="" required></select>
            </div>

            <fieldset disabled>

              <div class="form-group">
                <label for="broj_termina_dodaj">Broj termina</label>
                <input type="text" id="broj_termina_dodaj" class="form-control" placeholder="0">
              </div>

            </fieldset>

          </form>

        </div>

        <div class="modal-footer align_center">

          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: #ffffff;">Zatvori</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="button_dodaj" style="color: #ffffff;">Dodaj</button>

        </div>

      </div>
    </div>
  </div>


  <?php include 'header.php'; ?>

  <div class='centerDiv'>

    <div class='left_div grid-item'></div>

    <div class='middle_div grid-item'>

      <div class='h_div'>
        <h1 class='h1_text' style="color:#cfaa41">Usluge</h1>
      </div>

      <div class='table_div table-hover'>

      <!-- TABELA USLUGA-->

        <table class="table">
          <thead class="thead-red" style="color: #ffffff;">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Usluga</th>
              <th scope="col">Pruzalac</th>
              <th scope="col">Broj termina</th>
            </tr>
          </thead>
          <tbody id='usluge'></tbody>
        </table>

      </div>

      <div class="button_div1">
        <button data-toggle="modal" data-target="#exampleModal" type="button" data-backdrop="static"
          class="btn btn-secondary btn-lg btn-block" style="background-color:#cfaa41">NOVA USLUGA</button>
      </div>

    </div>

    <div class='right_div grid-item'></div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

  <script>
    let usluge = [];
    let pruzaoci = [];
    let trenutniId = -1;

    $(document).ready(function () {

        ucitajUsluge();
        ucitajPruzaoce();

      // Dugme za cuvanje izmena
      $('#button_sacuvaj').click(function () {
        if (trenutniId == -1) {
          return;
        }
        const naziv = $('#naziv_usluge').val();
        if(naziv === "") {
            alert("Morate uneti naziv usluge!");
            return false;
        }
        const pruzalac = $('#pruzalac').val();
        $.post('../uslugaHandlers/update.php', { id: trenutniId, naziv: naziv, pruzalac: pruzalac }, function (data) {
          console.log(data);
          if (data != 1) {
            alert(data);
            return;
          }
          ucitajUsluge();
          trenutniId = -1;
        })
      })

      // Dugme za brisanje
      $('#button_delete').click(function () {
        if (trenutniId == -1) {
          return;
        }
        $.post('../uslugaHandlers/delete.php', { id: trenutniId }, function (data) {
          if (data != 1) {
            alert(data);
            return;
          }
          console.log({ trenutniId: trenutniId });
          if (data == 1) {
            console.log('filter')
            usluge = usluge.filter(function (elem) { return elem.id != trenutniId });
            iscrtajTabelu();
          }

          trenutniId = -1;
        })
      })
      
      // Dugme za dodavanje
      $('#button_dodaj').click(function (e) {
        const naziv = $('#naziv_usluge_dodaj').val();
        if(naziv === "") {
            alert("Morate uneti naziv usluge!");
            return false;
        }
        const regex = '/^([^0-9]*)$/';
        if(naziv===1) {
          alert("Naizv usluge ne sme sadrzati cifre!");
            return false;
        }
        else {
            const pruzalac = $('#pruzalac_dodaj').val();
            $.post('../uslugaHandlers/add.php', { naziv: naziv, pruzalac: pruzalac }, function (data) {
            console.log(data);
            if (data != 1) {
            alert(data);
            return;
          }
          ucitajUsluge();
        })
        }
      })

      // Modal za dodavanje
      $('#exampleModal').on('show.bs.modal', function (e) {
        $('#pruzalac_dodaj').html('');
        for (let pruzalac of pruzaoci) {
          $('#pruzalac_dodaj').append(`
            <option value='${pruzalac.id}'>${pruzalac.imePrezime}</option>
          `)
        }
      })

      // Modal za izmenu
      $('#exampleModal2').on('show.bs.modal', function (e) {
        const button = $(e.relatedTarget);
        const id = button.data('id');
        trenutniId = id;
        
        $('#pruzalac').html('');
        for (let pruzalac of pruzaoci) {
          $('#pruzalac').append(`
            <option value='${pruzalac.id}'>${pruzalac.imePrezime}</option>
          `)
        }

        const usluga = usluge.find(function (elem) {
          return elem.id == id;
        });
        if (!usluga) {
          return;
        }
        $('#sviTermini').attr('href', 'terminiZaUslugu.php?id=' + id)
        $('#pruzalac').val(usluga.pruzalac);
        $('#naziv_usluge').val(usluga.naziv);
        $('#broj_termina').val(usluga.broj_termina);
      })

    })


    // Definicije funkcija
    function ucitajPruzaoce() {
      $.getJSON('../pruzalacHandlers/getAll.php', function (data) {
        if (!data.status) {
          alert(data.greska);
          return;
        }
        pruzaoci = data.pruzaoci;
        console.log(pruzaoci);
      })
    }

    function ucitajUsluge() {
      $.getJSON('../uslugaHandlers/getAll.php', function (data) {
        if (!data.status) {
          alert(data.greska);
          return;
        }
        console.log(data.usluge)
        usluge = data.usluge;
        iscrtajTabelu();
      })
    }

    function iscrtajTabelu() {
      $('#usluge').html('');
      let index = 1;
      for (let usluga of usluge) {
        $('#usluge').append(`
          <tr data-toggle="modal" data-target="#exampleModal2" data-backdrop="static" data-id=${usluga.id}  >
              <th scope="row">${index++}</th>
              <td>${usluga.naziv}</td>
              <td>${usluga.pruzalac_imePrezime}</td>
              <td>${usluga.broj_termina}</td>
            </tr>
          `)
      }
    }
  </script>

</body>

</html>
