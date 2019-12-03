/* HELPERS */
function enableBox(box) {
    if(box.find('.overlay').length) {
        box.find('.overlay').remove();
    }
}
function disableBox(box, icone) {
    if(!box.find('.overlay').length) {
        if (icone !== '')
            box.append('<div class="overlay"><i class="fa fa-' + icone + ' fa-spin"></i></div>');
        else
            box.append('<div class="overlay"></div>');
    }
}

//SET OPTIONS IN SELECT
function setSelectOptions(select, options, valueField, textField) {
    var valueField = valueField === undefined ? 'id' : valueField;
    var textField = textField === undefined ? 'nome' : textField;

    var html = '';
    $.each(options, function (i) {
        html += '<option value="' + options[i][valueField] + '">' + options[i][textField] + '</option>';
    });

    $(select).html(html);
}

//SET OPTIONS IN SELECT BY PLUCK
function setSelectPluckOptions(select, options) {
    var html = '';
    $.each(options, function (i, val) {
        html += '<option value="' + i + '">' + val + '</option>';
    });
    select.html(html);
}

function disableButton(button, icone) {
    var $this = button;
    var tag = $this[0].tagName.toLowerCase();

    if(icone === "" || icone === undefined)
        icone = "spinner";

    if(tag === 'a') {
        $this.prepend('<i class="fa fa-fw fa-' + icone + ' fa-spin"></i> ').addClass('disabled');
    } else if (tag === 'button') {
        $this.prop('disabled', true);
        $this.prepend('<i class="fa fa-fw fa-' + icone + ' fa-spin"></i> ');
    }

}

function enableButton(button) {
    var $this = button;

    $this.prop('disabled', false);
    $this.html($this.text());
}
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

jQuery(document).ready(function ($) {
    // BLOQUEIA BOTAO SUBMIT ON CLICK
    $('.btn-toggle').on('click', function(){
        disableButton($(this));
    });


    // SELECIONA VÁRIOS ITENS
    $("#select-all-items").change(function () {
        $(".select-item").prop('checked', $(this).prop("checked"));
    });


    // EXCLUI ITEMS SELECIONADOS
    $(".btn-delete-all").on('click', function (e) {
        e.preventDefault();

        var $this = $(this);
        var url = $this.attr('href');

        var data = $(".select-item:checked").serialize();

        if (!data) {
            swal("Atenção!", "Escolha ao menos um item para excluir!", "warning");
            return false;
        }

        swal({
            title: "Deseja realmente excluir?",
            text: "Essa ação é irreversível!",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Excluir",
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                disableButton($this, 'spinner');

                $.ajax({
                    method: "DELETE",
                    url: url,
                    data: data + "&_method=DELETE"
                }).done(function (response) {
                    if (response.success) {
                        window.location = response.redirect;
                    } else {
                        swal("Erro ao tentar excluir!", "Tente novamente mais tarde.", "warning");
                    }
                });
            }
        });

        return false;
    });

    // EXCLUI UM ITEM
    $('.btn-delete').on('click', function(){
        $('.select-item').prop('checked', false);
        $(this).parent().parent().find('.select-item').prop('checked', true);
        $(".btn-delete-all").trigger('click');
    });

    // MÁSCARAS
    var PhoneMaskBehavior = function (val) {
        val2 = val.replace(/\D/g, '');

        if (val2.length === 11 && val2.substr(0, 4) == '0800')
            return '0000-000-0000';
        else if (val2.length === 11)
            return '(00) 0 0000-0000';
        else
            return '(00) 0000-00009';
    };

    var phoneMaskOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(PhoneMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.phone-mask').mask(PhoneMaskBehavior, phoneMaskOptions);
    $('.date-mask').mask("00/00/0000");
    $('.cpf-mask').mask("999.999.999-99");
    $('.cnpj-mask').mask("99.999.999/9999-99");
    $('.integer-mask').mask("#");
    $('.number-mask').mask("#.###.###.###", {reverse: true});
    $('.cep-mask').mask("99999-999");
    $('.money-mask').mask('000.000.000.000.000,00', {reverse: true});
    $('.money-mask-unitario').mask('000.000.000.000.000,000', {reverse: true});

    // INICIALIZA SELECT 2
    $(".select2").select2({
        placeholder: "Marque um ou mais itens",
        closeOnSelect: false,
        language: 'pt-BR'
    });

    // INICIALIZA BS SWITCH
    $(".bs-switch").bootstrapSwitch();

    //INICIALIZA CKEDITOR
    if($('#ckeditor').length)
        CKEDITOR.replace('ckeditor');

    //SLIMSCROLL
    $('.slimscroll').slimScroll({
        size  : '5px',
        railVisible: true,
        railOpacity: 1,
        wheelStep: 5
    });

    // BS DUALISTBOX
    $(".bs-duallistbox").bootstrapDualListbox({
        filterTextClear: 'Mostrar todos',
        filterPlaceHolder: 'Digite para pesquisar',
        moveSelectedLabel: 'Mover item selecionado',
        moveAllLabel: 'Mover todos os itens',
        removeSelectedLabel: 'Remover item selecionado',
        removeAllLabel: 'Remover todos os itens',
        preserveSelectionOnMove: 'all',
        nonSelectedListLabel: 'Itens',
        selectedListLabel: 'Itens selecionados',
        helperSelectNamePostfix: '_select',
        selectorMinimalHeight: 200,
        infoText: 'Mostrando {0} itens',
        infoTextFiltered: 'Mostrando {0} de {1} itens',
        infoTextEmpty: 'Nenhum item selecionado',
        sortByInputOrder: true
    });

});