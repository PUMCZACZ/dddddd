var current_nr = 0, nrs = [];

function saveNumber() {
    var value = $('input[name=phone]').val();
    nrs[current_nr] = value;
    if ($('.nr_' + current_nr).length === 0) {
        $('.nrs').append('<input type="hidden" name="nrs[]" class="nr_' + current_nr + '" value="' + current_nr + '"/>');
        $('.nrs').append('<input type="hidden" name="nr[' + current_nr + ']" id="nr_input_' + current_nr + '" class="nr_' + current_nr + '" value="' + value + '"/>');
        $('.nrs').append('\n' +
            '                                <div class="d-flex nr_' + current_nr + '">\n' +
            '                                    <span id="nr_' + current_nr + '"></span>\n' +
            '                                    <span class="ml-2" onclick="removeNumber(' + current_nr + ')"><em class="fa fa-trash text-danger"></em></span>\n' +
            '                                    <div class="ml-4 d-flex">\n' +
            '                                        Kontakt dla:\n' +
            '                                        <div class="d-flex ml-2 lang-list">\n' +
            '                                            <div class="form-check">\n' +
            '                                                <input type="checkbox" class="form-check-input" name="nr_pl[' + current_nr + ']" id="nr_pl_' + current_nr + '">\n' +
            '                                                <label class="form-check-label" for="nr_pl_' + current_nr + '">\n' +
            '                                                    <span class="pl"></span>\n' +
            '                                                </label>\n' +
            '                                            </div>\n' +
            '                                            <div class="form-check">\n' +
            '                                                <input type="checkbox" class="form-check-input" name="nr_ru[' + current_nr + ']" id="nr_ru_' + current_nr + '">\n' +
            '                                                <label class="form-check-label" for="nr_ru_' + current_nr + '">\n' +
            '                                                    <span class="ru"></span>\n' +
            '                                                </label>\n' +
            '                                            </div>\n' +
            '                                            <div class="form-check">\n' +
            '                                                <input type="checkbox" class="form-check-input" name="nr_en[' + current_nr + ']" id="nr_en_' + current_nr + '">\n' +
            '                                                <label class="form-check-label" for="nr_en_' + current_nr + '">\n' +
            '                                                    <span class="en"></span>\n' +
            '                                                </label>\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </div>');
    }
    $('#nr_input_' + current_nr).val(value);
    $('#nr_' + current_nr).html(value);
}

function removeNumber(id) {
    $('.nr_' + id).remove();
    nrs.splice(id, 1);
    if (current_nr === id) {
        setCurrentNumber(0);
    }
}

function setCurrentNumber(id) {
    $('input[name=phone]').val(nrs.length - 1 >= id ? nrs[id] : '');
    current_nr = id;
}
var current_addr = 0, addrs = [];

function saveAddress() {
    var value = $('input[name=website]').val();
    addrs[current_addr] = value;
    if ($('.addr_' + current_addr).length === 0) {
        $('.addrs').append('<input type="hidden" name="addrs[]" class="addr_' + current_addr + '" value="' + current_addr + '"/>');
        $('.addrs').append('<input type="hidden" name="addr[' + current_addr + ']" id="addr_input_' + current_addr + '" class="addr_' + current_addr + '" value="' + value + '"/>');
        $('.addrs').append('\n' +
            '<div class="d-flex addr_' + current_addr + '">\n' +
            '    <span id="addr_' + current_addr + '"></span>\n' +
            '    <span class="ml-2" onclick="removeAddress(' + current_addr + ')"><em class="fa fa-trash text-danger"></em></span>\n' +
            '</div>');
    }
    $('#addr_input_' + current_addr).val(value);
    $('#addr_' + current_addr).html(value);
}

function removeAddress(id) {
    $('.addr_' + id).remove();
    addrs.splice(id, 1);
    if (current_addr === id) {
        setCurrentAddress(0);
    }
}

function setCurrentAddress(id) {
    $('input[name=website]').val(addrs.length - 1 >= id ? addrs[id] : '');
    current_addr = id;
}
$(function () {
    $('#next_nr').click(function () {
        saveNumber();
        setCurrentNumber(current_nr + 1);
    });
    $('#next_addr').click(function () {
        saveAddress();
        setCurrentAddress(current_addr + 1);
    });
});
