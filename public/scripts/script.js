let mainImage = document.querySelector("#singleProductImage");

const replaceImage = (e) => {
    console.log(e.id);
    mainImage.style.backgroundImage = `url("http://127.0.0.1:8000/images/products/${e.id}")`;
}
