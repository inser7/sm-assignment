$(function()  {


    $('#getByYear').on('click', function() {
        $('#tableByYear').show();
        $('#tableByMonth').hide();
        var columns = [
            {
                field: 'week',
                title: 'Week'
            },
            {
                field: 'totalPosts',
                title: 'Total Posts'
            }
        ];

        $.getJSON("year.php", function(json){
            console.log(json.data);
            $('#tableByYear').bootstrapTable({
                columns: columns,
                data: json.data
            })
            $('#tableByMonth').bootstrapTable('load', json.data);

        });
        setTimeout(function() {
            $("#tableByYear").bootstrapTable("hideLoading");
        }, 1000);
    });

    $('#getByMonth').on('click', function() {
        $('#tableByYear').hide();
        $('#tableByMonth').show();
        var columns = [
            {
                field: 'Average_character_length',
                title: 'Average character length'
            },
            {
                field: 'Average_number_of_posts_per_user',
                title: 'Average number of posts per user'
            },
            {
                field: 'Longest_post_by_character_length',
                title: 'Longest post by character length'
            }
        ];

        var selectedMonth = $('#monthSelect').children("option:selected").val();

        $.getJSON("monthly.php?month="+selectedMonth, function(json){
            console.log(json.data);
            $('#tableByMonth').bootstrapTable({
                columns: columns,
                data: [json.data]
            })
            $('#tableByMonth').bootstrapTable('load', [json.data]);

        });
        setTimeout(function() {
            $("#tableByMonth").bootstrapTable("hideLoading");
        }, 1000);
    });
});
