<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
    <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
        
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li class="uk-active"><a href="/">Home</a></li>
            </ul>
        </div>
                
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <?php if(isset($_SESSION['logged_in'])){ ?>
                    <li class="uk-active"><a href="/dashboard" uk-toggle>Dashboard</a></li>
                    <li class="uk-active"><a href="/dashboard/logout" uk-toggle>Logout</a></li>
                <?php } else { ?>
                    <li class="uk-active"><a href="#modal-login" uk-toggle>Login</a></li>
                    <li class="uk-active"><a href="#modal-signup" uk-toggle>Signup</a></li>
                <?php } ?>
            </ul>     
        </div>
            
    </nav>
</div>

<div id="modal-login" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <form method="POST" action="/dashboard/login">
            <div class="uk-margin">
                <input class="uk-input" type="email" placeholder="email" name="email">
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="password" placeholder="password" name="password">
            </div>
            <div class="uk-margin">
               <button class="uk-button uk-button-primary uk-button-small">Login</button>
            </div>
        </form>        

    </div>
</div>

<div id="modal-signup" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <form method="POST" action="/dashboard/register">
            <div class="uk-margin">
                <input class="uk-input" type="text" placeholder="fullname" name="fullname">
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="email" placeholder="email" name="email">
            </div>
            <div class="uk-margin">
                <input class="uk-input" type="password" placeholder="password" name="password" minlength="6">
            </div>
            <div class="uk-margin">
               <button class="uk-button uk-button-primary uk-button-small">Signup</button>
            </div>
        </form> 

    </div>
</div>