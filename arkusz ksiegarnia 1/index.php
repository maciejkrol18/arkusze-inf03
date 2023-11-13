<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteka</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Biblioteka w Książkowiczach Małych</h1>
    </header>
    <main>
        <section id="left">
            <h4>Dodaj czytelnika</h4>
            <form method="post">
                <label for="imie">
                    imię: <input type="text" id="imie" name="imie">
                </label>
                <label for="nazwisko">
                    nazwisko: <input type="text" id="nazwisko" name="nazwisko">
                </label>
                <label for="symbol">
                    symbol: <input type="text" id="symbol" name="symbol">
                </label>
                <button>AKCEPTUJ</button>
            </form>
            <?php
                if (!empty($_POST["imie"]) 
                    && !empty($_POST["nazwisko"]) 
                    && !empty($_POST["symbol"])
                ) {
                    $connection = mysqli_connect("localhost", "root", "", "biblioteka");
                    $imie = $_POST["imie"];
                    $nazwisko = $_POST["nazwisko"];
                    $symbol = $_POST["symbol"];
                    $nowyUser = mysqli_query(
                        $connection,
                        "INSERT INTO czytelnicy (imie, nazwisko, kod) VALUES ('$imie', '$nazwisko', '$symbol')"
                    );
                    if (!empty($nowyUser)) {
                        echo "
                            <p>Dodano czytelnika $imie $nazwisko</p>
                        ";
                    }
                    mysqli_close($connection);
                }
            ?>
        </section>
        <section id="middle">
            <span>
                <img src="./biblioteka.png" alt="biblioteka">
                <h6>ul.&nbsp;Czytelników&nbsp;15; Książkowice Małe</h6>
                <p>
                    <a href="mailto:biuro@bib.pl">
                        Czy masz jakieś uwagi?
                    </a>
                </p>
            </span>
        </section>
        <div style="clear: both;"></div>
        <section id="right">
            <h4>Nasi czytelnicy</h4>
            <ol>
                <?php
                    $connection = mysqli_connect("localhost", "root", "", "biblioteka");
                    $wynikZapytania = mysqli_query(
                        $connection,
                        "SELECT imie, nazwisko FROM czytelnicy ORDER BY nazwisko"
                    );
                    while ($row = mysqli_fetch_row($wynikZapytania)) {
                        echo "
                            <li>$row[0] $row[1]</li>
                        ";
                    }
                    mysqli_close($connection);
                ?>
            </ol>
        </section>
    </main>
    <footer>
        <p>Projekt witryny: 2311331321</p>
    </footer>
</body>
</html>