
function getValueByPath(obj, path) {
  return path.split('.').reduce((o, key) => (o ? o[key] : ''), obj);
}
function initAjaxSearch(config) {
  let form = $(config.formId);
  let input = $(config.inputId);
  let results = $(config.resultsId);
  let table = $(config.tableId);
  let pagination = $(config.paginationId);
  let cardTitle = $(config.cardTitleId);
  let clearBtn = $(config.clearBtnId);
  let countBox = $(config.countId);

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  let noResultsHtml = '<tr><td colspan="' + config.columns.length + '">No Results Found</td></tr>';

  form.submit(function (e) {
    e.preventDefault();
    results.html('');
    table.hide();
    clearBtn.show();

    $.ajax({
      type: 'POST',
      url: config.route,
      data: form.serialize(),
      success: function (response) {
        let jsonData = JSON.parse(response);
        if (jsonData.length > 0) {
          $.each(jsonData, function (index, val) {
            // console.log(val['district.name']);
            let row = '<tr>';
            // عرض الأعمدة الديناميكية
            $.each(config.columns, function (i, col) {
              // console.log(val[col]);
              row += `<td>${getValueByPath(val, col) ?? ''}</td>`;
            });
            // عرض الأكشنات
            if (config.actions) {
              row += '<td>';
              if (config.actions.show) {
                row += `<a class="btn btn-sm btn-success" href="${config.actions.show}/${val.id}">Show</a> `;
              }
              if (config.actions.edit) {
                row += `<a class="btn btn-sm btn-info" href="${config.actions.edit}/${val.id}/edit">Edit</a> `;
              }
              if (config.actions.delete) {
                row += `<form method="POST" action="${config.actions.delete}/${val.id}" style="display:inline;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>`;
              }
              if (config.actions.custom) {
                row += config.actions.custom(val);
              }
              row += '</td>';
            }
            row += '</tr>';
            results.append(row);
          });
        } else {
          results.append(noResultsHtml);
        }
        countBox.html(jsonData.length + " results found");
        pagination.hide();
        cardTitle.html("Search Results");
      },
      error: function () {
        results.append(noResultsHtml);
        countBox.html("0 results found");
        pagination.hide();
        cardTitle.html("Search Results");
      }
    });
  });

  // زر البحث
  $(config.searchBtnId).click(function (e) {
    e.preventDefault();
    form.submit();
  });

  // إظهار زر الإلغاء عند الكتابة
  input.keyup(function () {
    if ($(this).val() != '') {
      clearBtn.show();
    } else {
      clearBtn.hide();
      results.html('');
      table.show();
      pagination.show();
      cardTitle.html(config.defaultTitle || "All Records");
      countBox.html("");
    }
  });

  // زر الإلغاء
  clearBtn.click(function (e) {
    e.preventDefault();
    clearBtn.hide();
    table.show();
    results.html('');
    input.val('');
    pagination.show();
    cardTitle.html(config.defaultTitle || "All Records");
    countBox.html("");
  });
}

