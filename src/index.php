<style>
<?php include "index.css"; ?>
</style>

<?php
echo '<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>';

echo '<body><main class="container">';

generateHead();
echo '<h1 class="t" id="title">Stock Browser</h1>';
generateButtons();
echo '</body></main>';

function generateHead(){?>
        <div class="box h"  id="icons">
            <div>
                <i id="Credit" class="fas fa-chart-bar"></i>
            </div>
            <div>
                <i id="Credit" class="fa fa-bars"></i>
            </div>
        </div>
<?php
}

function generateButtons(){?>
    <div class="box a">
        <form action="about.php" method="get">
            <button class="buttonIcons" type="submit" value="about"><i class="far fa-question-circle"></i></i>About</button>
        </form>
    </div>
    <div class="box b">
        <form action="list.php" method="get">
            <button class="buttonIcons" type="submit" value="list"><i class="fas fa-building"></i>Companies</button>
        </form>
    </div>
    <div class="box c">
        <form action="login.php" method="get">
            <button class="buttonIcons" type="submit" value="list"><i class="fas fa-sign-in-alt"></i></i>Login</button>
        </form>
    </div>
    <div class="box d">
        <form action="coming-soon.php" method="get">
            <button class="buttonIcons" type="submit" value="list"><i class="fas fa-user-plus"></i></i></i>Sign Up</button>
        </form>
    </div>

<?php
}

?>