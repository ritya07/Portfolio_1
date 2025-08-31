document.getElementById('convertBtn').addEventListener('click', function () {
    const fileInput = document.getElementById('imageInput');
    if (!fileInput.files.length) {
        alert('Please select an image file first.');
        return;
    }

    const file = fileInput.files[0];
    const fileName = file.name.split('.')[0]; // Get the file name without extension
    const reader = new FileReader();

    reader.onload = function (event) {
        const img = new Image();
        img.src = event.target.result;

        img.onload = function () {
            const canvas = document.getElementById('imageCanvas');
            const ctx = canvas.getContext('2d');

            // Set canvas size to match image size
            canvas.width = img.width;
            canvas.height = img.height;

            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0);

            // Convert the image to a data URL (base64 string)
            const imgData = canvas.toDataURL('image/jpeg');

            // Create a jsPDF instance (A4 size: 210mm x 297mm, default unit: mm)
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Get image and page dimensions
            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();
            const imageWidth = img.width;
            const imageHeight = img.height;

            // Calculate aspect ratio of the image
            const imageAspectRatio = imageWidth / imageHeight;
            const pageAspectRatio = pageWidth / pageHeight;

            let finalWidth, finalHeight;

            if (imageAspectRatio > pageAspectRatio) {
                // Image is wider in comparison to the page
                finalWidth = pageWidth - 20; // Leave margin of 10mm on each side
                finalHeight = (finalWidth / imageWidth) * imageHeight;
            } else {
                // Image is taller in comparison to the page
                finalHeight = pageHeight - 20; // Leave margin of 10mm on top and bottom
                finalWidth = (finalHeight / imageHeight) * imageWidth;
            }

            // Center the image on the PDF
            const x = (pageWidth - finalWidth) / 2;
            const y = (pageHeight - finalHeight) / 2;

            // Add the image to the PDF with calculated width and height
            pdf.addImage(imgData, 'JPEG', x, y, finalWidth, finalHeight);

            // Save the PDF with the same name as the image
            pdf.save(`${fileName}.pdf`);
        };
    };

    reader.readAsDataURL(file);
});
