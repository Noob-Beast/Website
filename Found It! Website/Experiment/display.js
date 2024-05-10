function displayImage() {
    const fileInput = document.getElementById('imageInput');
    const file = fileInput.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const imgSrc = event.target.result;

            // Create a new HTML file dynamically
            const newWindow = window.open();
            newWindow.document.write(`
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Image Display</title>
                </head>
                <body>
                    <h2>Image Display</h2>
                    <img src="${imgSrc}" style="max-width: 100%;">
                </body>
                </html>
            `);
        };
        reader.readAsDataURL(file);
    } else {
        alert('Please select an image.');
    }
}
