let mainImage = document.querySelector("#singleProductImage");

const replaceImage = (e) => {
    console.log(e.id);
    mainImage.style.backgroundImage = `url("https://so-crates.nl/images/products/${e.id}")`;
}
