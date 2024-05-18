document.getElementById('payment_method').addEventListener('change', function() {
    const method = this.value;
    document.getElementById('credit_card_info').style.display = (method == 'credit_card' || method == 'debit_card') ? 'block' : 'none';
    document.getElementById('paypal_info').style.display = (method == 'paypal') ? 'block' : 'none';
    document.getElementById('bank_transfer_info').style.display = (method == 'bank_transfer') ? 'block' : 'none';
});