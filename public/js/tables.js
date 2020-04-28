/**
 * Created by IDIMMA on 11/4/2017.
 */
$(document).ready(function () {
    var url = location.href.split(/=/);
    if (url[1] == 'scores') {
        $.ajax({
            type: 'GET',
            url: './server/tables.php?s=' + url[1],
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                var thHTML = '<tr><td><strong>SN</strong></td>' +
                    '<td><strong>School Name</strong></td>' +
                    '<td><strong>Scores</strong></td>' +
                    '<td><strong>Stage</strong></td>' +
                    '<td><strong>Check</strong></td></tr>';
                var trHTML = "";
                var sn = 0;
                for (var i = 0; i < response.length; i++) {
                    sn = sn + 1;
                    var tables = response[i];
                    trHTML += '<tr><td>' +
                        sn
                        + '</td><td>' +
                        tables['school_name']
                        + '</td><td>' +
                        tables.scores +
                        '</td><td>' +
                        tables.passed +
                        '<td><a  name="view" href="./tables.php?school=' + sn + ' " value="view' + i + '">Check</a></td></tr>';

                }

                $('#title').html('<h1 class="text-center">Final Scores</h1>');
                $('#table_head').append(thHTML);
                $('#tables_row').append(trHTML);

            }
            ,
            error: function () {

            }


        });
    }
    else {
        $.ajax({
            type: 'GET',
            url: './server/details.php?s=' + url[1],
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                var thHTML = '<tr><td><strong>SN</strong></td>' +
                    '<td><strong>Question</strong></td>' +
                    '<td><strong>Answer</strong></td>' +
                    '<td><strong>Option</strong></td>' +
                    '<td><strong>Picked</strong></td></tr>';
                var trHTML = "";
                var sn = 0;
                for (var i = 0; i < response.length; i++) {
                    sn = sn + 1;
                    var tables = response[i];
                    var opt = tables.pick.split(/,/);
                    if (tables.option == opt[i]) {
                        color = "#23b010"
                    } else {
                        color = "#EA0000"
                    }

                    trHTML += '<tr><td>' +
                        sn
                        + '</td><td>' +
                        tables['question']
                        + '</td><td>' +
                        tables.answer +
                        '</td><td>' +
                        tables.option +
                        '</td><td bgcolor="' + color + '">' +
                        opt[i] +
                        '<td></tr>';

                }

                $('#title').html("<h1>" + tables["school_name"] + ' Score Details</h1>');
                $('#table_head').append(thHTML);
                $('#tables_row').append(trHTML);

            }
            ,
            error: function () {

            }


        });
    }


});