<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Chapter1_1
 *
 * Class RegisteredListener
 * @package App\Listeners
 */
class RegisteredListener
{
    private $mailer;
    private $user;

    /**
     * RegisteredListener constructor.
     * @param Mailer $mailer
     * @param User $user
     */
    public function __construct(Mailer $mailer, User $user)
    {
        $this->mailer = $mailer;
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $this->user->findOrFail($event->user->getAuthIdentifier());
        $this->mailer->raw('登録完了しました', function ($message) use ($user) {
            $message->subject('会員登録メール')->to($user->email);
        });
    }
}
