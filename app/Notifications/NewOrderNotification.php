<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nuevo pedido recibido')
            ->greeting('¡Hola administrador!')
            ->line('Se ha realizado un nuevo pedido en la tienda.')
            ->line('ID del pedido: ' . $this->order->id)
            ->line('Total: ' . number_format($this->order->total_price, 2, ',', '.') . '€')
            ->action('Ver pedido', url('/admin/orders/' . $this->order->id)) 
            ->line('Gracias por usar nuestra tienda.');
    }
}
