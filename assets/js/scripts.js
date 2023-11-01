function previewImage() {
    const inputImage = document.getElementById("inputImage");
    const preview = document.getElementById("preview");
    const image = inputImage.files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
        preview.style.display = "block";
        document.getElementById("image").value = reader.result; // Met à jour la valeur du champ "image"
    }, false);

    if (image) {
        reader.readAsDataURL(image);
    }
}

function updateImageSrc() {
    const imageSrc = document.getElementById("image").value;
    const preview = document.getElementById("preview");

    if (imageSrc) {
        preview.src = imageSrc;
        preview.style.display = "block";
    } else {
        preview.style.display = "none";
    }
}
