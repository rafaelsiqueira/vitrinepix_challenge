<ol class="breadcrumb">
    <li><a href="/game">Home</a></li>
    <li class="active">Game Play</li>
</ol>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Game Play</h3>
        </div>
        <div class="panel-body">
            <div id="attack-tip"></div>

            <?php if($total_players < 2): ?>

                <div class="alert alert-danger" role="alert">
                    Insufficient players. <a href="/admin">Go to the admin</a>
                </div>

            <?php else: ?>
                <button id="attack-step-start" type="button" class="col-lg-12 btn btn-danger">Start!</button>
                <div id="attack-container">

                    <div id="results-container" style="display: none;">
                        <table id="results-table" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Attacker</th>
                                <th>Defender</th>
                                <th>Attack Points</th>
                                <th>Defense Points</th>
                                <th>Damage</th>
                                <th>Health (defender)</th>
                            </tr>
                            </thead>
                        </table>
                        <button id="new-game" type="button" class="col-lg-12 btn btn-primary">New Game!</button>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>