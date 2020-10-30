
/// The user selects a rune button
function selectRune(runeBtn) {
    let rune = $(runeBtn).prop('id');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post('/skyreach/rune', { "rune": rune });
}


/// A rune was selected from the Pusher event
function didSelectRune(rune) {
    if(rune == Action.CLEAR) { 
        clearRunes();
    }
    else if(rune == Action.ACCEPT) { 
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
    $('#acceptedRunes').css('background-color', '#ccc');
}


function addRune(rune) {
    let acceptedRunesLength = $('#acceptedRunes > .acceptedRune').length;
    let separatorsLength = $('#acceptedRunes > .separator').length;

    // Validation
    if (acceptedRunesLength == 12) {
        showInvalidInput();
        return;
    }
    if ((acceptedRunesLength == 4 && separatorsLength == 0) ||
        (acceptedRunesLength == 8 && separatorsLength == 1)) {
        showInvalidInput();
        return;
    }

    highlightRuneBtn(rune);

    let imgUrl = "../assets/rune/" + rune + ".png";
    $('#acceptedRunes').append('<img class="acceptedRune" src="' + imgUrl + '"/>');
}


function acceptRunes() {
    let acceptedRunes = $.map($('#acceptedRunes > .acceptedRune'), (value, index) => { 
        return $(value).attr('src').match(/[-_\w]+[.][\w]+$/i)[0].split('.').shift();
    });

    let validationCallback = function(success) {
        if (success) {
            $('#acceptedRunes').append('<span class="separator">-</span>');
        }
        else {
            showInvalidInput();
        }
    };

    switch (acceptedRunes.length) {
        case 4:
            highlightRuneBtn(Rune.ACCEPT);

            let actionRunes = acceptedRunes.slice(0, 5);
            validateAction(actionRunes, validationCallback);
            break;
        case 8:
            highlightRuneBtn(Rune.ACCEPT);

            let itemRunes = acceptedRunes.slice(4, 8);
            validateItem(itemRunes, validationCallback);
            break;
        case 12:
            highlightRuneBtn(Rune.ACCEPT);

            let locationRunes = acceptedRunes.slice(8, 12);
            validateLocation(locationRunes, (success) => {
                (success) ? showValidInput() : showInvalidInput();
            });
            break;
        default:
            showInvalidInput();
            break;
    }
}


function highlightRuneBtn(rune) {
    let runeBtn = $("#" + rune);

    if (runeBtn == null) { return; }

    if (!runeBtn.hasClass('selected-rune')) {
        runeBtn.attr('class', runeBtn.prop('class') + ' selected-rune');
    }
}


function validateAction(runes, callback) {
    callback(JSON.stringify(runes) == JSON.stringify(Action.OPEN));
}


function validateItem(runes, callback) {
    callback(JSON.stringify(runes) == JSON.stringify(Item.DOOR));
}


function validateLocation(runes, callback) {
    callback(JSON.stringify(runes) == JSON.stringify(SkyreachLocation.REZMIR));
}


function showInvalidInput() {
    let bgColor = $('#acceptedRunes').css('background-color');
    setTimeout(() => {
        $('#acceptedRunes').css('background-color', bgColor);
    }, 1000);
    $('#acceptedRunes').css('background-color', 'red');
}


function showValidInput() {
    $('#acceptedRunes').css('background-color', 'green');
}
