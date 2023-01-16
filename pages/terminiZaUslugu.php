<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Termini usluga</title>
  <link rel="stylesheet" href="global.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>



  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="naslovModala">Dodavanje novog termina</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- sadrzaj modala -->
          <form>
            <div class="form-group">
              <label for="klijent">Klijent:</label>
              <input type="text" class="form-control" id="klijent" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="datum">Datum:</label>
              <input type="text" class="form-control" id="datum" placeholder="" required>
            </div>

            <div class="form-group">
              <label for="prostorija">Prostorija:</label>
              <input type="text" class="form-control" id="prostorija" placeholder="" required>
            </div>

          </form>

        </div>
        <div class="modal-footer align_center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #b6c059;">Zatvori</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="button_sacuvaj" style="background-color: #7d8f01;">Sacuvaj</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" hidden id="button_delete" style="background-color: #404902;">Obrisi</button>
        </div>
      </div>
    </div>
  </div>



  <?php include 'header.php'; ?>
  <div class='centerDiv'>

    <div class='left_div grid-item'>

    </div>

    <div class='middle_div grid-item'>

      <div class='h_div'>
        <h1 class='h1_text' id='usluga_naziv'>Usluga: nazivUsluge</h1>
        <h2 class='h1_text'>Termini</h2>
      </div>

      <div class='table_div'>
        <table class="table table-hover">
          <thead class="thead-red" style="background-color: #f3c9bc ;">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Klijent</th>
              <th scope="col">Datum</th>
              <th scope="col">Prostorija</th>
            </tr>
          </thead>
          <tbody id='termini'>

          </tbody>
        </table>
      </div>

      <div class="button_div1">
        <button data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-id='-1' type="button"
          class="btn btn-secondary btn-lg btn-block">NOVI TERMIN</button>
      </div>

    </div>

    <div class='right_div grid-item'>
      <input type="text" id='uslugaId' value="<?php echo $_GET['id']; ?>" hidden>
      </input>
    </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script>
    let usluga = undefined;
    let termini = [];
    let trenutniTerminId = -1;

    $(document).ready(function () {

        const uslugaId = $('#uslugaId').val();
        console.log(uslugaId);

      $('#button_sacuvaj').click(function () {
        const klijent = $('#klijent').val();
        const datum = $('#datum').val();
        const prostorija = $('#prostorija').val();
        if(klijent == "" || datum == "" || prostorija == "") {
          alert("Morate popuniti sva polja!");
          return false;
        }
        if (trenutniTerminId == -1) {
          $.post('../terminHandlers/add.php', { klijent: klijent, datum: datum, prostorija: prostorija, usluga: usluga.id }, function (data) {
            vratiTermine();
          })
        } else {
          $.post('../terminHandlers/update.php', { id: trenutniTerminId, klijent: klijent, datum: datum, 
            prostorija: prostorija, usluga: usluga.id }, function (data) {
            vratiTermine();
          })
        }

      });

      $('#button_delete').click(function () {
        if (trenutniTerminId == -1) {
          return;
        }
        $.post('../terminHandlers/delete.php', { id: trenutniTerminId }, function (data) {
            vratiTermine();
        })
      })


      $("#exampleModal").on('show.bs.modal', function (e) {
        const tr = $(e.relatedTarget);
        trenutniTerminId = tr.data('id');
        if (trenutniTerminId == -1) {
          $('#naslovModala').html('Dodavanje novog termina');
          $('#button_delete').attr('hidden', true);
          $('#klijent').val('');
          $('#datum').val('');
          $('#prostorija').val('');
        } else {
          const termin = termini.find(function (element) { return element.id == trenutniTerminId });
          $('#naslovModala').html('Izmena termina');
          $('#button_delete').attr('hidden', false);
          $('#klijent').val(termin.klijent);
          $('#datum').val(termin.datum);
          $('#prostorija').val(termin.prostorija);
        }
      })

      $.getJSON('../uslugaHandlers/getById.php', { id: uslugaId }, function (data) {
        console.log(data);
        if (data.status != 1) {
          alert(data.greska);
          // window.location.replace('./');
          return;
        }
        usluga = data.usluga;
        console.log(usluga);
        $('#usluga_naziv').html('Usluga: ' + usluga.naziv);
        vratiTermine();
      })
    })


    function vratiTermine() {
      $.getJSON('../terminHandlers/getAllByUsluga.php', { id: usluga.id }, function (data) {
        if (data.status != 1) {
          alert(data.greska);
          // window.location.replace('./');
          return;
        }
        $("#termini").html(data);
        termini = data.termini;
        termini.sort(function (a, b) {
          return a.datum.localeCompare(b.datum);

        })
        napuniTabelu();
      })
    }

    function napuniTabelu() {
      $('#termini').html('');
      let i = 0;
      for (let termin of termini) {
        $('#termini').append(`
            <tr data-toggle='modal' data-target='#exampleModal' data-backdrop="static" data-id=${termin.id} >
              <td>${++i}</td>
              <td>${termin.klijent}</td>
              <td>${termin.datum}</td>
              <td>${termin.prostorija}</td>
            </tr>
          `)
      }
    }
  </script>


</body>

</html>