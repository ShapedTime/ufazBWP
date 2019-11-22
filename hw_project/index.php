<?
    session_start();
    if(isset($_SESSION['id'])){
        // TODO: redirect
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/568129426a.js" crossorigin="anonymous"></script>
    <script src="./ajax.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Baskervville&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Budget Table</title>
</head>
<body>
    <div class="content">
        <header>
            <nav>
                <i class="fas fa-money-check fa-3x"></i>
                <div class="float-right">
                    <a class="nav-link">About</a>
                    <a class="nav-link">Pricing</a>
                    <a class="nav-link">Contact</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalSignIn">Sign In</button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form>
                                    <div class="modal-header">
                                            <h5 class="modal-title">Sign In</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                                <div class="form-group">
                                                    <label for="emailSignIn">Email address</label>
                                                    <input type="email" class="form-control" id="emailSignIn" aria-describedby="emailHelp" placeholder="Enter email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passwordSignIn">Password</label>
                                                    <input type="password" class="form-control" id="passwordSignIn" placeholder="Password">
                                                </div>
                                                <small id="signin-msg" class="form-text text-muted text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" >Sign In</button>
                                        <button type="button" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        $('#modalSignIn').on('show.bs.modal', event => {
                            var button = $(event.relatedTarget);
                            var modal = $(this);
                            // Use above variables to manipulate the DOM
                            
                        });
                    </script>
                </div>
            </nav>
        </header>
        <section>
            See your balance with us<br>
            &emsp;<i class="fa fa-chevron-right fa-xs" aria-hidden="true"></i>Check where you spend your money the most<br>
            &emsp;<i class="fa fa-chevron-right fa-xs" aria-hidden="true"></i>Do not waste your money<br>
            &emsp;<i class="fa fa-chevron-right fa-xs" aria-hidden="true"></i>Avoid being broke at the end of month<br>
        </section>
        <section>
            <i>
                Thomas Bale - <b>“I loved this app from the moment I met it”</b><br>
                Christofer John - <b>“This stuff is bomb!”</b><br><br>
            </i>
        </section>
        <footer class="fixed-bottom">
            <div class="align-middle">All rights reserved by ShapedHorizon©</div>
        </footer>
    </div>
</body>
</html>