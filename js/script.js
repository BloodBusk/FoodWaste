/****Hamburger Menu*****/

let menuIcon = document.getElementById("hamburgerMenuIcon");
let toggleMenu = document.getElementById("toggleMenu");
let closeMenu = document.getElementById("closeMenu");

menuIcon.addEventListener("click", () => {
  toggleMenu.classList.toggle("displayMenu");
});

closeMenu.addEventListener("click", () => {
  toggleMenu.classList.toggle("displayMenu");
});

/****Shopping Cart*****/

let addToShoppingCart = document.getElementsByClassName("addToShoppingCart");
let shoppingCartNum = document.getElementById("shoppingCartNum");
let removeFromCart = document.getElementById("removeFromCart");
let incrementCart = 0;

for (let i = 0; i < addToShoppingCart.length; i++) {
  addToShoppingCart[i].addEventListener("click", () => {
    incrementCart++;
    shoppingCartNum.innerHTML = incrementCart;
  });
}
