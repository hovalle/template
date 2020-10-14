<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Blog controller</h1>
            
            <ul class="list-group">
                <li class="list-group-item"
                    ng-repeat="(idxcP, cP) in datosHttp track by $index">{{ cP.title }}</li>
            </ul>
            
        </div>
    </div>
</div>
