/**
 * Delete information message if displayed
 * 
 */

function deleteInfo() {
    if (document.getElementById("info")) {
        setTimeout(() => {
            document.getElementById("info").style.display = "none";
        }, 3000)
    }
}

/**
 * Check every regex of every input with the "needRegex" class
 * 
 */

function checkRegex() {
    if (document.querySelectorAll(".needRegex")) {
        const listRegex = document.querySelectorAll(".needRegex");

        listRegex.forEach(input => {
            const label = input.previousElementSibling;
            input.addEventListener("change", () => {
                (!input.checkValidity()) ? label.classList.add("incorrect"): label.classList.remove("incorrect");
            });
        });
    }
}

/**
 * Copy the data attribute of an element with the "clipboard" class
 * 
 * @param array
 */

 function copyToClipboard(array) {
    array.forEach(line => {
        line.addEventListener("click", () => {
            const temp = document.createElement("input");
            const copy = line.attributes.data.value;

            temp.setAttribute("value", copy);
            document.body.appendChild(temp);
            temp.select();
            document.execCommand("copy");
            document.body.removeChild(temp);
        });
    });
}