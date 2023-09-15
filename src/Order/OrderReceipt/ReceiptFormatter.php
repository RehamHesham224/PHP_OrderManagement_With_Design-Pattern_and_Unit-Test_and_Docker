<?php

namespace Src\Order\OrderReceipt;

use Src\Order\Order;

interface ReceiptFormatter
{
    public function format(Order $order): string;


}