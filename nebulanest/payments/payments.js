// Fungsi untuk menampilkan popup dengan instruksi pembayaran
function showPaymentInstructions(data) {
    document.getElementById('package').textContent = "Paket: NebulaNest - " + data.package;
    document.getElementById('amount').textContent = "Harga: Rp " + new Intl.NumberFormat('id-ID').format(data.amount);
    document.getElementById('email').textContent = "Email: " + data.email;
    document.getElementById('account_number').textContent = "Nomor Rekening: " + data.account_number;
    document.getElementById('account_name').textContent = "Nama Pemilik Rekening: " + data.account_name;

    // Tampilkan popup
    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'), {});
    paymentModal.show();
}

// Fungsi untuk mengunduh instruksi pembayaran sebagai file teks
function downloadInstructions(data) {
    var element = document.createElement('a');
    var fileContent = "Instruksi Pembayaran BCA\n\n";
    fileContent += "Package: NebulaNest - " + data.package + "\n";
    fileContent += "Amount: Rp " + new Intl.NumberFormat('id-ID').format(data.amount) + "\n";
    fileContent += "Email: " + data.email + "\n";
    fileContent += "Nomor Rekening: " + data.account_number + "\n";
    fileContent += "Nama Pemilik Rekening: " + data.account_name + "\n";
    fileContent += "Setelah melakukan transfer, mohon kirim bukti pembayaran ke email kami.";

    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(fileContent));
    element.setAttribute('download', 'instruksi_pembayaran.txt');

    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

// Fungsi untuk menangani submit form pembayaran
async function handlePaymentForm(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    const response = await fetch('', {
        method: 'POST',
        body: formData
    });
    const data = await response.json();
    showPaymentInstructions(data);
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('paymentForm').addEventListener('submit', handlePaymentForm);
});