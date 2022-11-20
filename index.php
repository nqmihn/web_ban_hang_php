<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        #container{
            width: 100%;
            height: 700px;
            background: blueviolet;
        }
        #top{
            width: 100%;
            height: 20%;
            background: aqua;
        }
        #mid{
            width: 100%;
            height: 70%;
            background: pink;
        }
        #bottom{
            width: 100%;
            height: 10%;
            background: yellow;
        }

    </style>
</head>
<body>
    <div id="container">
        <?php include 'header.php'; ?>
        <?php include 'content.php'; ?>
        <?php include 'footer.php'; ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.btn-add-to-cart').click(function () { 
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "add_to_cart.php",
                    data: {id},
                    success: function () {
                        alert("Thêm thành công")
                    }
                });
                
            });
        });
    </script>
</body>
</html>