// drug and drop
// button click to select file
let button = document.getElementById("browsButton");
let input = document.getElementById("browsInput");
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
    // input.click();
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(file);
    output.onload = function() {
        document.getElementById('selectimage').style="display:none";
        document.getElementById('preview').style="display:block";
        URL.revokeObjectURL(output.src) // free memory
    }

    // input.file = file;
    let fileType = file.type;
    // console.log(fileType)
    let validExtansions = ["image/gif", "image/png", "image/img", "image/jpg", "image/jpeg", "image/ico"];
    if (validExtansions.includes(fileType)) {
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileURL = fileReader.result;
            // input.file  = fileURL;
        }
        fileReader.readAsDataURL(file);
        // console.log(fileReader.readAsDataURL(file));
    } else {
        console.log("232");
    }

});


button.onclick = (e) => {
    e.preventDefault()
    input.click();
}

input.addEventListener("change", (e) => {

    file = e.target.files[0];
    let validExtansions = ["image/gif", "image/png", "image/img", "image/jpg", "image/jpeg", "image/ico"];
    if (validExtansions.includes(file.type)) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            document.getElementById('selectimage').style="display:none";
            document.getElementById('preview').style="display:block";
            URL.revokeObjectURL(output.src) // free memory
        }
    }else{
        console.log('outside')
        // if (!target.files.length) return;
        // Create a blob that we can use as an src for our audio element
        const urlObj = URL.createObjectURL(event.target.files[0]);

        // Create an audio element
        const audio = document.createElement("audio");

        // Clean up the URL Object after we are done with it
        audio.addEventListener("load", () => {
            URL.revokeObjectURL(urlObj);
        });

        // Append the audio element
        document.getElementById('preview mt-3').appendChild(audio);

        // Allow us to control the audio
        audio.controls = "true";

        // Set the src and start loading the audio from the file
        audio.src = urlObj;
    }



    e.preventDefault()
    // let costIn = document.getElementById('customInput');
    // costIn.value = e.target;
})

function changeHandler({
                           target
                       }) {
    // Make sure we have files to use
    if (!target.files.length) return;


}

