
        <h2>CONNEXION</h2>
        <form  method="POST" action="./submit-login.php">
            <div>
                <label for="inputPseudo">Pseudo</label>
                <input type="text" id="inputPseudo" name="pseudo" placeholder="Pseudo" required>
            </div>
            <div>
                <label for="inputPassword">Mot de passe</label>
                <input type="password" id="inputPassword" name="password"  placeholder="Mot de passe" required>
            </div>
            <button type="submit">Valider</button>
        </form>
        <a href="./recovery-password.php">
            <p>Mot de passe oublié ?</p>
        </a>
        <a href="./signin.php">
            <p>Pas de compte ? Incrivez vous !</p>
        </a>
