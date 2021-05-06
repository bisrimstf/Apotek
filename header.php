<nav>
        <a href="index.php" class="btn btn-primary">Home</a>
        <?php if (!isset($_SESSION['login'])) : ?>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-primary">Register</a>
        <?php else : ?>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        <?php endif; ?>
</nav>