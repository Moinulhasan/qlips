// drug and drop

const droparea = document.getElementById("dragWrapper");
// global vaiable
let file;
// if user drag over the div
droparea.addEventListener("dragover", (e) => {
    e.preventDefault();
});
// if user leave file over div
droparea.addEventListener("dragleave", () => {
});
// drop over the div
droparea.addEventListener("drop", (e) => {
    e.preventDefault();
    file = e.dataTransfer.files[0];
    let fileType = file.type;
    let validExtansions = ["image/gif", "image/png", "image/img", "image/jpg", "image/ico"];
    if (validExtansions.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            console.log(fileURL);
        }
        fileReader.readAsDataURL(file);
    } else {
        console.log("232");
    }

});
// button click to select file
let button = document.getElementById("browsButton");
let input = document.getElementById("browsInput");

button.onclick = () => {
    input.click();
}

input.addEventListener("change", (e) => {
    console.log(e.target.files[0]);
})