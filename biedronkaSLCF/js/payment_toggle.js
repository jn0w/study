document.addEventListener('DOMContentLoaded', function() {
    var cardRadio = document.getElementById('pay_card');
    var cashRadio = document.getElementById('pay_cash');
    var cardDetails = document.getElementById('card_details');

    function toggleCardDetails(display) {
        cardDetails.style.display = display;
    }

    cardRadio.addEventListener('change', function() {
        if (cardRadio.checked) {
            toggleCardDetails('block');
        }
    });

    cashRadio.addEventListener('change', function() {
        if (cashRadio.checked) {
            toggleCardDetails('none');
        }
    });

    
    if (cardRadio.checked) {
        toggleCardDetails('block');
    }
});