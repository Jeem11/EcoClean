<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Style_Subscription.css" type="text/css"/>
    <title>Employee Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form id="subscription_page" method="post">
        <div class="container">
            <h1>Pay Subscription</h1>
            <p>Choose and pay your subscription for your laundry shop to reach more customers with easy online booking and secure payment processing</p>
            <div class="plans">
                <div class="plan basic">
                    <h2>Basic</h2>
                    <div class="price">PHP 700</div>
                    <div class="billing">Monthly Subscription Term</div>
                    <button class="subscribe-button" name="basic" id="basic_sub">Subscribe</button>
                    <ul class="features">
                        <li>Upload up to 10 pictures</li>
                        <li>Laundry shop listing visible on the website for one month</li>
                        <li>Accommodate up to 50 customers</li>
                    </ul>
                </div>

                <div class="plan standard">
                    <h2>Standard</h2>
                    <div class="price">PHP 1,500</div>
                    <div class="billing">Quarterly Subscription Term</div>
                    <button class="subscribe-button" name="standard" id="standard_sub">Subscribe</button>
                    <ul class="features">
                        <li>Upload up to 20 pictures</li>
                        <li>Laundry shop listing visible on the website for three months</li>
                        <li>Accommodate up to 100 customers</li>
                    </ul>
                </div>

                <div class="plan premium">
                    <h2>Premium</h2>
                    <div class="price">PHP 2,500</div>
                    <div class="billing">Bi-Annual Subscription Term</div>
                    <button class="subscribe-button" name="premium" id="premium_sub">Subscribe</button>
                    <ul class="features">
                        <li>Upload up to 30 pictures for promotional purposes</li>
                        <li>Laundry shop listing visible on the website for six months</li>
                        <li>Accommodate up to 200 customers</li>
                    </ul>
                </div>

                <div class="plan vip">
                    <h2>VIP</h2>
                    <div class="price">PHP 4,000</div>
                    <div class="billing">Annual Subscription Term</div>
                    <button class="subscribe-button" name="vip" id="vip_sub">Subscribe</button>
                    <ul class="features">
                        <li>Upload unlimited pictures</li>
                        <li>Laundry shop listing visible on the website for one year</li>
                        <li>Accommodate unlimited customers</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
