
/**
 *
 * @param obj
 */
function displayname(obj) {
    const fileInput = document.getElementById('img');
    const fileName = fileInput.files[0]?.name;
    const fileNameDisplay = document.getElementById('loadedimage');

    // Если файл выбран, показываем его имя
    if (fileName) {
        fileNameDisplay.textContent = "Selected file: " + fileName;
    } else {
        fileNameDisplay.textContent = "No file selected";
    }
}


/**
 *
 */
