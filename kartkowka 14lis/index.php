<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Z4K2</title>
</head>
<body>
  <main>
    <fieldset>
      <legend>
        <h3>Nasi czytelnicy</h3>
      </legend>
      <h4>tu coś było napisane nie pamiętam co</h4>
      <ul>
        <?php
          $conn = mysqli_connect("localhost","root","","biblioteka");
          $czytelnicy = mysqli_query(
            $conn,
            "SELECT imie, nazwisko FROM czytelnicy"
          );
          while ($row = mysqli_fetch_row($czytelnicy)) {
            echo "
              <li>
                $row[0] $row[1]
              </li>
            ";
          }
        ?>
      </ul>
    </fieldset>
    <fieldset>
      <legend>
        <h3>Nowy czytelnik</h3>
      </legend>
      <h4>tu chyba tak samo</h4>
      <form method="post">
        <label for="imie">
          Imię: <input type="text" name="imie">
        </label>
        <label for="nazwisko">
          Nazwisko: <input type="text" name="nazwisko">
        </label>
        <button>Prześlij</button>
      </form>
      <?php
        if (!empty($_POST["imie"]) && !empty($_POST["nazwisko"])) {
          $conn = mysqli_connect("localhost","root","","biblioteka");
          $czytelnicy = mysqli_query(
            $conn,
            "SELECT imie, nazwisko FROM czytelnicy"
          );

          $noweImie = $_POST["imie"];
          $noweNazwisko = $_POST["nazwisko"];
          $czyIstnieje = false;

          while ($row = mysqli_fetch_row($czytelnicy)) {
            if ($noweImie == $row[0] && $noweNazwisko == $row[1]) {
              $czyIstnieje = true;
            }
          }

          if ($czyIstnieje) {
            echo "Informacja zwrotna - czytelnik z tym imieniem i nazwiskiem już istnieje";
          } else {
            mysqli_query(
              $conn,
              "INSERT INTO czytelnicy (imie, nazwisko) VALUES ('$noweImie', '$noweNazwisko')"
            );
            echo "Informacja zwrotna - dodano czytelnika $noweImie $noweNazwisko";
          }
        }
      ?>
    </fieldset>
  </main>
</body>
</html>