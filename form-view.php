<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>
<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>

    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" value="<?php echo $email ;?>" id="email" name="email" class="form-control"/>
                <span class="error"><?php echo $emailErr?></span>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" value="<?php echo $street;?>" name="street" id="street" class="form-control">
                    <span class="error"><?php echo $streetErr?></span>
                    <!--added required-->
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" value="<?php echo $streetnumber;?>" id="streetnumber" name="streetnumber" class="form-control">
                    <span class="error"><?php echo $streetnumberErr?></span>
                    <!--made input type number instead of text, added required-->
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" value="<?php echo $city;?>" id="city" name="city" class="form-control">
                    <span class="error"><?php echo $cityErr?></span>
                    <!--added required-->
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" value="<?php echo $zipcode;?>" id="zipcode" name="zipcode" class="form-control">
                    <span class="error"><?php echo $zipcodeErr?></span>
                    <!--made input type number instead of text, added required-->
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>

            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" />
            Express delivery (+ 5 EUR)

        </label>
            
        <button type="submit" class="btn btn-primary">Order!</button>

        <h5><?php echo $orderSent?></h5>
        <h5>Delivery time: <?php echo $delyTime ?></h5>

    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
