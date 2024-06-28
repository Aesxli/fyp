
function domReady(fn) {
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {
    // Function to validate the QR code content
    function isValidQrCodeContent(content) {
        // Add your validation logic here
        // For example, checking if the content is a valid URL
        try {
            new URL(content);
            return true;
        } catch (e) {
            return false;
        }
    }

    // If found your QR code
    function onScanSuccess(decodeText, decodeResult) {
        // Validate the QR code content
        if (isValidQrCodeContent(decodeText)) {
            // Redirect to the URL found in the QR code
            window.location.href = decodeText;
        } else {
            // Show an error message
            document.getElementById('error-message').style.display = 'block';
        }
    }

    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbox: 250 },
        { showTorchButtonIfSupported: true, supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA] }
    );
    htmlscanner.render(onScanSuccess);
});
//check if QR code has been used
//check address attribute of QR code to see if it is valid
//expiray date of QR code
