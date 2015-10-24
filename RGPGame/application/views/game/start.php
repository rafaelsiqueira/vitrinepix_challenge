<ol class="breadcrumb">
    <li><a href="/game">Home</a></li>
    <li class="active">Game Play</li>
</ol>

<div class="col-lg-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Players</h3>
        </div>
        <div class="panel-body">
            <ul class="list-group" id="players-list">
                <li class="list-group-item" style="text-align: center">Click below to list players</li>
            </ul>
            <div class="col-lg-12">
                <button id="initiative-step-start" type="button" class="col-lg-12 btn btn-primary">Initiative</button>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Game Play</h3>
        </div>
        <div class="panel-body">
            <div id="attack-tip">
                Waiting for the initiative step
            </div>
            <div id="attack-container">
                <button style="display: none" id="attack-step-start" type="button" class="col-lg-12 btn btn-danger">Attack</button>

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
        </div>
    </div>
</div>