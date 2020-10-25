let clearRune = "death";
let spaceRune = "journey";


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
    highlightRuneBtn(rune);

    if(rune == clearRune) { clearRunes(); }
    // if spaceRune { addSpaceRune(); }
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
    if ($('#acceptedRunes > img').length == 12) { return }

    let imgUrl = "../assets/rune/" + rune + ".png";
    $('#acceptedRunes').append('<img class="acceptedRune" src="' + imgUrl + '"/>')

    if ($('#acceptedRunes > img').length == 4 ||
        $('#acceptedRunes > img').length == 8) {
        $('#acceptedRunes').append("-")
    }
}


function highlightRuneBtn(rune) {
    let runeBtn = $("#" + rune);

    if (runeBtn == null) { return; }

    if (!runeBtn.hasClass('selected-rune')) {
        runeBtn.attr('class', runeBtn.prop('class') + ' selected-rune');
    }
}
