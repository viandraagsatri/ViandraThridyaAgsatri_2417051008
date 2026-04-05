// A. Event Handler
// const tombol = document.getElementById('tombol');
// tombol.onclick = function() {
//     alert('Tombol telah diklik');
// }

// const form = document.querySelector('form');
// form.addEventListener('submit', function(event) {
//     event.preventDefault();
//     const nama = document.querySelector('input[name="nama"]').value;
//     alert('Nama yang dimasukkan: ' + nama);
// });

// B. Manipulasi HTML
// function ubah() {
//     document.getElementById("judul").textContent = "Judul telah diubah";

//     document.getElementById("paragraf").innerHTML = "Paragraf ini telah diubah menggunakan <strong>innerHTML</strong>";
// }

// function ubahStyle() {
//     const element = document.getElementById("judul");
//     element.style.color = "red";
//     element.style.fontSize = "24px";
//     element.style.fontWeight = "bold";
// }

// C. DOM Traversal
function cekAngka() {
    let x = document.getElementById("angka").value;
    let hasil = document.getElementById("hasil");

    if (isNaN(x) || x < 1 || x > 100) {
        hasil = "Input tidak valid";
    } else {
        hasil = "Input valid";
    }
    document.getElementById("hasil").textContent = hasil;
}