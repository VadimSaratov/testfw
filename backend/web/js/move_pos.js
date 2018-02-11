
$(document).ready(function(){
    $("#up,#down").click(function(){
        data = {};
        var row = $(this).parents("tr:first");
        var rowID = row.attr('data-id');
        var rowPos = parseInt(row.attr('data-pos'));
        if ($(this).is("#up")) {
            var rowPrev = row.prev();
            if (rowPrev.length !== 0){
                --rowPos;
                var prevID = parseInt(rowPrev.attr('data-id'));
                var prevPos = parseInt(rowPrev.attr('data-pos')) + 1;
                data[rowID] = rowPos;
                data[prevID] = prevPos;
                $.ajax({
                   url: '/admin/banner/position/',
                    type: 'POST',
                    data: data,
                    success: function (res) {
                       console.log(res);
                       if (res !== false){
                           rowPrev.find('.pos').html(prevPos);
                           rowPrev.attr('data-pos', prevPos);
                           row.find('.pos').html(rowPos);
                           row.attr('data-pos', rowPos);
                           row.insertBefore(rowPrev).hide().show('blind');
                       }else {
                           alert('Не удалось изменить позицию');
                       }

                    }
                });

            }
        } else {
            var rowNext = row.next();
            if (rowNext.length !== 0){
                ++rowPos;
                var nextID = rowNext.attr('data-id');
                var nextPos = parseInt(rowNext.attr('data-pos')) - 1;
                data[rowID] = rowPos;
                data[nextID] = nextPos;
                $.ajax({
                    url: '/admin/banner/position/',
                    type: 'POST',
                    data: data,
                    success: function (res) {
                        if (res !== false){
                            rowNext.find('.pos').html(nextPos);
                            rowNext.attr('data-pos', nextPos);
                            row.find('.pos').html(rowPos);
                            row.attr('data-pos', rowPos);
                            row.insertAfter(rowNext).hide().show('blind');
                        }else {
                            alert('Не удалось изменить позицию');
                        }

                    }
                });

            }
        }
    });
});