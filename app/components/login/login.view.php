<form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Login de usuario</h1>
    <label for="usuario"
           class="sr-only">Usuario</label>
    <input type="text"
           ng-model="usr.usuario"
           id="usuario"
           class="form-control"
           placeholder=Usuario" required autofocus>

    <label for="password"
           class="sr-only">Contraseña</label>
    <input type="password"
           ng-model="usr.pass"
           id="password"
           class="form-control"
           placeholder="Contraseña"
           required>

    <button class="btn btn-lg btn-primary btn-block"
            type="button"
            data-ng-click="loginUsuario()">Ingresar</button>
</form>
