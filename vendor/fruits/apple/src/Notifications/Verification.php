<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2018/11/8
 * Time: 17:59
 */
namespace Fruits\Apple\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;


class Verification extends Notification implements  ShouldQueue
{
    use Queueable;

    protected $content;
    protected $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $content = '')
    {

        $this->name = config('app.name');
        $this->content = $content;
        $this->onQueue('verification');

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['fruitsms'];
    }


    public function toAppleSms($notifiable)
    {

        return "【{$this->name}】{$this->content}";
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

}