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
            <span id="attack-tip">Waiting for the initiative step</span>
            <div id="attack-container" style="background: red">
                <button style="display: none" id="attack-step-start" type="button" class="col-lg-12 btn btn-danger">Attack</button>
            </div>
        </div>
    </div>
</div>