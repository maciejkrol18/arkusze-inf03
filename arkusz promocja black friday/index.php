<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep dla uczniów</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Dzisiejsze promocje naszego sklepu</h1>
    </header>
    <main>
        <section id="left">
            <h2>Taniej o 30%</h2>
            <ol type="a">
                <?php
                    $connection = mysqli_connect("localhost", "root", "", "sklep5bt29wrz");
                    $queryResult = mysqli_query($connection, 
                        "SELECT nazwa FROM towary WHERE promocja=1"
                    );
                    while ($row = mysqli_fetch_array($queryResult)) {
                        echo '<li>'.$row['nazwa'].'</li>';
                    }
                ?>
            </ol>
        </section>
        <section id="middle">
            <h2>Sprawdź cenę</h2>
            <form method="GET">
                <select name="produkt" id="produkt">
                    <option value="Gumka do mazania">Gumka do mazania</option>
                    <option value="Cienkopis">Cienkopis</option>
                    <option value="Pisaki 60 szt.">Pisaki 60szt.</option>
                    <option value="Markery 4 szt.">Markery 4szt.</option>
                </select>
                <button>SPRAWDŹ</button>
                <div id="result">
                    <?php
                        if (isset($_GET["produkt"])) {
                            $connection = mysqli_connect("localhost", "root", "", "sklep5bt29wrz");
                            $nazwa = $_GET["produkt"];
                            $queryResult = mysqli_query($connection, 
                                "SELECT nazwa, cena FROM towary WHERE nazwa='$nazwa'"
                            );
                            $row = mysqli_fetch_array($queryResult);
                            echo "cena regularna: ".$row["cena"]."<br/>".
                            "cena w promocji 30%: ".$row["cena"] - ($row["cena"] * 0.3) ;
                        }
                    ?>
                </div>
            </form>
        </section>
        <section id="right">
            <h2>Kontakt</h2>
            <p>
                email: <a href="mailto:bok@sklep.pl">bok@sklep.pl</a>
            </p>
            <img src="./promocja.png" alt="promocja">
        </section>
    </main>
    <footer>
        <h4>Autor strony: 903290318930</h4>
    </footer>
</body>
</html>