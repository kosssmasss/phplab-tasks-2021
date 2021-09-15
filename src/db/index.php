<?php
/**
 * Connect to DB
 */
require_once './pdo_ini.php';
/**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */
//$uniqueFirstLetters = ['A', 'B', 'C'];
$sth = $pdo->query('SELECT distinct LEFT(name, 1) FROM hometask.airports order by 1; ');
$uniqueFirstLetters = $sth->fetchAll(PDO::FETCH_COLUMN);
// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 *
 * For filtering by first_letter use LIKE 'A%' in WHERE statement
 * For filtering by state you will need to JOIN states table and check if states.name = A
 * where A - requested filter value
 */

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 *
 * For sorting use ORDER BY A
 * where A - requested filter value
 */

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 *
 * For pagination use LIMIT
 * To get the number of all airports matched by filter use COUNT(*) in the SELECT statement with all filters applied
 */

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */
//$airports = [];

$query = 'select a.name, a.code, c.name as city, s.name as state, a.address, a.timezone from airports a join cities c on a.city_id = c.id join states s on a.state_id = s.id  ';
if ($_GET['filter_by_first_letter']){
    $letter = $_GET['filter_by_first_letter'];
    $query .= 'where a.name like "'.$letter.'%" ';
    $countQuery = 'select count(*) from airports where name like "'.$letter.'%";';
}
else {
    $countQuery = 'select count(*) from airports;';
}

$sthc = $pdo->query($countQuery);
$total = $sthc->fetch(PDO::FETCH_COLUMN);

if ($_GET['sort']){
    $name = $_GET['sort'];
    $query .= ' order by '.$name;
}

$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
if ($_GET['letter'] != $_GET['filter_by_first_letter']){
    $page = 1;
    $_GET['letter'] = $_GET['filter_by_first_letter'];
}

//Store letter for the next changes
if (empty($_GET['letter'])){
    $_GET['letter'] = $_GET['filter_by_first_letter'];
}

$limit = 20; 
$totalPages = ceil( $total/ $limit );
$page = max($page, 1); 
$page = min($page, $totalPages); 
$offset = ($page - 1) * $limit;
$query .= ' LIMIT '.$offset.',20 ';
$query .= ';';
$sth = $pdo->prepare($query);
$sth->execute();
$airports = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach ($uniqueFirstLetters as $letter): ?>
            <a href="<?=  '?'.http_build_query( array_merge( $_GET, array( 'filter_by_first_letter' => $letter ) ) ) ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="/" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="<?=  '?'.http_build_query( array_merge( $_GET, array( 'sort' => 'name' ) ) ) ?>">Name</a></th>
            <th scope="col"><a href="<?=  '?'.http_build_query( array_merge( $_GET, array( 'sort' => 'code' ) ) ) ?>">Code</a></th>
            <th scope="col"><a href="<?=  '?'.http_build_query( array_merge( $_GET, array( 'sort' => 'state' ) ) ) ?>">State</a></th>
            <th scope="col"><a href="<?=  '?'.http_build_query( array_merge( $_GET, array( 'sort' => 'city' ) ) ) ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?> 
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="#"><?= $airport['state'] ?></a></td>
            <td><?= $airport['city'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="<?=  '?'.http_build_query( array_merge( $_GET, array( 'page' => $i ) ) ) ?>"><?= $i ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

</main>
</html>
