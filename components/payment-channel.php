<?php
$paymentChannels = [
    'Mastercard',
    'Paystack',
    'Flutterwave',
    'Bank Transfer',
];
?>

<div class="container my-5">
    <!-- <h2 class="text-left mb-4 text-primary">Payment Channels</h2> -->
    <div class="d-flex flex-wrap justify-content-center">
        <?php
        $logos = [
            'Mastercard' => 'images/mastercard.png',
            'Paystack' => 'images/paystack.png',
            'Flutterwave' => 'images/flutter.png',
            'Bank Transfer' => 'images/transfer.png',
        ];
        foreach ($logos as $channel => $logo): ?>
            <div class="p-3 ">
                <img src="<?php echo $logo; ?>" class="img-fluid" alt="<?php echo $channel; ?>" style="max-height: 40px; width: auto;">
            </div>
        <?php endforeach; ?>
    </div>
</div>
