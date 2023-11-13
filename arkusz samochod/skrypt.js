const formularz = document.querySelector("form")
console.log("dziala")

formularz.addEventListener("submit", (e) => {
    e.preventDefault()

    const typPaliwa = Number(document.querySelector("#rodzaj-paliwa").value)
    const litry = Number(document.querySelector("#litry").value)
    const poleWyniku = document.querySelector(".wynik")
    let kosztLitru

    if (typPaliwa === 1) {
        kosztLitru = 4
    } else if (typPaliwa === 2) {
        kosztLitru = 3.5
    } else {
        kosztLitru = 0
    }

    poleWyniku.textContent = `koszt paliwa: ${litry * kosztLitru} zł`
})