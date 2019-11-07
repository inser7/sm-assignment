<?php
require __DIR__ . '/vendor/autoload.php';

use SuperMetrics\SuperMetrics;
use SuperMetrics\Helpers\HelperPosts;

$monthNames = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
];

$metrics = new SuperMetrics();
$month = $metrics->getPosts()->getMonth();
$availableMonth = HelperPosts::groupBy($month,'month');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Supermetrics Code Assignment</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>


<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3">Supermetrics Code Assignment</h1>
            <p>by Sergey Koltsov</p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->


        <div class="row">
            <div class="col">

                <form class="form-inline">
                    <label class="sr-only" for="monthSelect">Select month</label>
                    <select class="form-control mb-2 mr-sm-2"  id="monthSelect">
                        <?php
                        for($i=0; $i<count($monthNames); $i++){
                            if(array_key_exists($i, $availableMonth)){
                                echo "<option value=".$i.">".$monthNames[$i]."</option>";
                            }
                        }
                        ?>
                    </select>

                    <button type="button" class="btn btn-warning mb-2 mr-sm-2" id="getByMonth">Get by month</button>
                    <button type="button" class="btn btn-primary mb-2 mr-sm-2" id="getByYear">Get by year</button>

                </form>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="result">
                    <table class="table" id="tableByYear" style="display: none;">
                    </table>
                    <table class="table" id="tableByMonth" style="display: none;">
                    </table>
                </div>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

</main>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="static/js/script.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
</body>
</html>
