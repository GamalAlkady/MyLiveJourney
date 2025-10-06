<script>
    function getValueByPath(obj, path) {
        return path.split('.').reduce((o, key) => (o ? o[key] : ''), obj);
    }

    function initAjaxSearch(config) {
        let form = $(config.formId??'#search_form');
        let input = $(config.inputId??'#search');
        let clearBtn = $(config.clearBtnId??'#clear_search');
        let searchBtn = $(config.searchBtnId??'#search_trigger');

        let table = config.tableId ? $(`${config.tableId} tbody:eq(0)`):$('table tbody:first');
        let results = $(config.resultsId??'table tbody:eq(1)');

        let pagination = $(config.paginationId??'#pagination');
        let cardTitle = $(config.cardTitleId??'.card-title');
        let countBox = $(config.countId??'#data_count');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let noResultsHtml = '<tr><td colspan="' + config.columns.length + '">No Results Found</td></tr>';

        form.submit(function(e) {
            e.preventDefault();
            results.html('');
            table.hide();
            clearBtn.show();

            $.ajax({
                type: 'POST',
                url: config.route,
                data: form.serialize(),
                success: function(response) {
                    let jsonData = JSON.parse(response);
                    if (jsonData.length > 0) {
                        $.each(jsonData, function(index, row) {
                            // console.log(val['district.name']);
                            let rowHtml = '<tr>';
                            // عرض الأعمدة الديناميكية
                            config.columns.forEach(col => {
                                if (col.render) {
                                    rowHtml += `<td>${col.render(row[col.name],row)}</td>`;
                                } else {
                                    rowHtml +=
                                        `<td>${getValueByPath(row, col.name) ?? ''}</td>`;
                                }
                            });
                            // عرض الأكشنات
                            if (config.actions) {
                                rowHtml += '<td class="d-flex">';
                                if (config.actions.show) {
                                    rowHtml +=
                                        `<a class="btn btn-sm btn-success flex-fill me-1" href="${config.actions.show}/${row.id}" data-toggle="tooltip" title="{{ trans('tooltips.show') }}">{!! trans('buttons.show') !!}</a> `;
                                }
                                if (config.actions.edit) {
                                    rowHtml +=
                                        `<a class="btn btn-sm btn-info flex-fill me-1" href="${config.actions.edit}/${row.id}/edit" data-toggle="tooltip" title="{{ trans('tooltips.edit') }}">{!! trans('buttons.edit') !!}</a> `;
                                }
                                if (config.actions.delete) {
                                    rowHtml += `<form method="POST" action="${config.actions.delete}/${row.id}" class="d-inline-block flex-fill me-1" >
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="{{ __('modals.ConfirmDeleteTitle', ['name' => __('titles.place')]) }}" data-message="{!! trans('modals.ConfirmDeleteMessage', ['name' => '`+row.name+`']) !!}">
                                                {!! trans('buttons.delete') !!}</button>
                                            </form>`;
                                }
                                if (config.actions.custom) {
                                    rowHtml += config.actions.custom(val);
                                }
                                rowHtml += '</td>';
                            }
                            rowHtml += '</tr>';
                            results.append(rowHtml);
                        });
                    } else {
                        results.append(noResultsHtml);
                    }
                    countBox.html(jsonData.length + " results found");
                    pagination.hide();
                    cardTitle.html("<i class='fa fa-search'></i> Search Results (" + jsonData.length + ")");
                },
                error: function() {
                    results.append(noResultsHtml);
                    countBox.html("0 results found");
                    pagination.hide();
                    cardTitle.html("Search Results");
                }
            });
        });

        // زر البحث
        searchBtn.click(function(e) {
            e.preventDefault();
            form.submit();
        });

        // إظهار زر الإلغاء عند الكتابة
        input.keyup(function() {
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
        clearBtn.click(function(e) {
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
</script>
