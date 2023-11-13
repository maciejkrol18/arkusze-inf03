<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hurtownia szkolna</title>
  <link rel="stylesheet" href="styl.css">
</head>
<body>
  <header>
    <h1>Hurtownia z najlepszymi cenami</h1>
  </header>
  <main>
    <div id="left">
      <h2>Nasze ceny</h2>
      <table>
        <?php
          $connection = mysqli_connect(
            "localhost", "root", "", "sklep"
          );
          $wynikZapytania = mysqli_query(
            $connection,
            "SELECT nazwa, cena FROM towary LIMIT 4"
          );
          while ($row = mysqli_fetch_row($wynikZapytania)) {
            echo "
              <tr>
                <td>$row[0]</td>
                <td>$row[1]</td>
              </tr>
            ";
          }
          mysqli_close($connection);
        ?>
      </table>
    </div>
    <div id="middle">
      <h2>Koszt zakupów</h2>
      <form method="post">
        <label for="produkty">
          wybierz artykuł:
        <select name="produkty" id="">
          <option value="Zeszyt 60 kartek">Zeszyt 60 kartek</option>
          <option value="Zeszyt 32 kartki">Zeszyt 32 kartki</option>
          <option value="Cyrkiel">Cyrkiel</option>
          <option value="Linijka 30 cm">Linijka 30 cm</option>
        </select>
        </label>
        <label for="sztuki">
          liczba sztuk:
          <input type="number" name="sztuki" id="sztuki">
        </label>
        <button type="submit">OBLICZ</button>
        <?php
          if (isset($_POST["produkty"]) && isset($_POST["sztuki"]) && $_POST["sztuki"] !== "") {
            $wybranyProdukt = $_POST["produkty"];
            $sztuki = $_POST["sztuki"];

            $connection = mysqli_connect(
              "localhost", "root", "", "sklep"
            );
            $wynikZapytania = mysqli_query(
              $connection,
              "SELECT cena FROM towary WHERE nazwa='$wybranyProdukt'"
            );
            $cena = mysqli_fetch_row($wynikZapytania)[0];
            echo "wartość zakupów: ".$cena * $sztuki;
            mysqli_close($connection);
          }
        ?>
      </form>
    </div>
    <div id="right">
      <h2>Kontakt</h2>
      <img src="./zakupy.png" alt="hurtownia">
      <p>e-mail: <a href="mailto:hurt@poczta2.pl">hurt@poczta2.pl</a></p>
    </div>
  </main>
  <footer>
    <h4>Witrynę wykonał: Piotr Zenger</h4>
  </footer>
</body>
</html>