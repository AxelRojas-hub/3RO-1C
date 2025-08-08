let cards = document.querySelectorAll(".card")
let modal = document.querySelector(".modal");
let modalImg = document.querySelector('.modal-img')
let modalBtn = document.querySelector('.modal-btn')
for (let c of cards) {
    c.addEventListener('click', function (e) {
        modal.style.display = 'initial';
        modalImg.src = `${c.id}.png`
    })
}
modalBtn.addEventListener('click', function () {
    modal.style.display = 'none'


})

modal.addEventListener('contextmenu', function (e) {
    e.preventDefault();
})
