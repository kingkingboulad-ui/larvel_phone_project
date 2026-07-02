<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    // ما يُخزن في الداتابيز للأدمن
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->user->name ?? 'Guest',
            'total_price' => $this->order->total_price,
            'message' => "قام العميل بموقعك بإنشاء طلب جديد رقم #{$this->order->id}",
        ];
    }

    // ما يُبث حياً فوراً إلى لوحة التحكم
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'customer_name' => $this->order->user->name ?? 'Guest',
            'total_price' => $this->order->total_price,
            'message' => "🔥 طلب جديد! العميل " . ($this->order->user->name ?? 'Guest') . " اشترى بقيمة {$this->order->total_price}",
        ]);
    }
}
