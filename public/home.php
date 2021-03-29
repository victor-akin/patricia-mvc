<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/css/uikit.min.css" />

    <title>Home</title>
</head>
<body>
    
    <?php include 'navbar.php'; ?>

    <?php include 'notifications.php'; ?>
    
    <div class="uk-container uk-container-small">
        <h3 class="uk-heading-small">Home</h3>

        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Nulla ad, nisi quia voluptatem quos hic at veniam saepe repellat! 
            Dolorem minus natus explicabo cumque, et doloremque laboriosam consectetur maxime autem.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Nulla ad, nisi quia voluptatem quos hic at veniam saepe repellat! 
            Dolorem minus natus explicabo cumque, et doloremque laboriosam consectetur maxime autem.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Nulla ad, nisi quia voluptatem quos hic at veniam saepe repellat! 
            Dolorem minus natus explicabo cumque, et doloremque laboriosam consectetur maxime autem.
        </p>
    </div>
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.18/dist/js/uikit-icons.min.js"></script>
    <script>
        const notifications = document.querySelectorAll('.notification-btn')
        notifications.forEach(el => el.click())
    </script>
</body>
</html>