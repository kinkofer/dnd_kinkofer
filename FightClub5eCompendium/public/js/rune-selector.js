let clearRune = "death";
let acceptRune = "journey";


/// The user selects a rune button
function selectRune(runeBtn) {
    let rune = $(runeBtn).prop('id')

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post('/skyreach/rune', { "rune": rune });
}


/// A rune was selected from the Pusher event
function didSelectRune(rune) {
    if(rune == clearRune) { 
        clearRunes();
    }
    else if(rune == acceptRune) { 
        acceptRunes();
    }
    else {
        addRune(rune);
    }
}


function clearRunes() {
    $('.rune').each((index, element) => {
        $(element).attr('class', 'rune');
    });

    $('#acceptedRunes').empty();
}


function addRune(rune) {
    let acceptedRunesLength = $('#acceptedRunes > .acceptedRune').length;
    let separatorsLength = $('#acceptedRunes > .separator').length;

    // Validation
    if (acceptedRunesLength == 12) { return }
    if ((acceptedRunesLength == 4 && separatorsLength == 0) ||
        (acceptedRunesLength == 8 && separatorsLength == 1)) { return }

    highlightRuneBtn(rune);

    let imgUrl = "../assets/rune/" + rune + ".png";
    $('#acceptedRunes').append('<img class="acceptedRune" src="' + imgUrl + '"/>');
}


function acceptRunes() {
    let acceptedRunesLength = $('#acceptedRunes > .acceptedRune').length;

    if (acceptedRunesLength == 12) { return }

    if (acceptedRunesLength % 4 == 0) {
        $('#acceptedRunes').append('<span class="separator">-</span>');
        highlightRuneBtn(acceptRune);
    }
}


function highlightRuneBtn(rune) {
    let runeBtn = $("#" + rune);

    if (runeBtn == null) { return; }

    if (!runeBtn.hasClass('selected-rune')) {
        runeBtn.attr('class', runeBtn.prop('class') + ' selected-rune');
    }
}
