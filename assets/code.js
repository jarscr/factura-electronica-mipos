;(function ($) {
  console.log('hh')
  $('#mipos-close-alert').click(function () {
    $('#mipos-alert').hide()
  })
  $('#mipos-close-alert-test').click(function () {
    $('#mipos-alert-test').hide()
  })

  $('#mipos_btn_advance_options').click(function () {
    console.log('hey')
    $('#mipos_advance_options').toggle()
  })

  $('.save_order').click(function () {
    $(this).hide()
    $(
      "<span class='mipos_msg'>Procesando por favor espere...</span>"
    ).insertAfter('.save_order')
  })

  $('#mipos_select2').select2({
    delay: 200,
    minimumInputLength: 3,
    language: {
      noResults: function () {
        return 'No hay resultados'
      },
      searching: function () {
        return 'Buscando...'
      },
      errorLoading: function () {
        return 'Buscando...'
      },
      inputTooShort: function () {
        return 'Ingresa al menos 3 caracteres...'
      },
    },
    ajax: {
      url: function (params) {
        return 'https://api.hacienda.go.cr/fe/cabys?q=' + params.term
      },
      data: function (params) {
        var query = {
          //q: params.term,
        }

        // Query parameters will be ?search=[term]&type=public
        return query
      },
      processResults: function (data) {
        console.log(data)
        let results = []
        data.cabys.forEach(function (i) {
          results.push({
            id: i.codigo + '-' + i.descripcion,
            value: i.codigo + '-' + i.descripcion,
            text: i.codigo + '-' + i.descripcion,
          })
        })
        // Transforms the top-level key of the response object from 'items' to 'results'
        return {
          results: results,
        }
      },
    },
  })
})(jQuery)
