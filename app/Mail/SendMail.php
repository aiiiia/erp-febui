<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ManagementEmail;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $type = $this->data['type'];
        if (is_array($this->data['emails'])) {
            $email = implode(',', $this->data['emails']);
        } else {
            $email = $this->data['emails'];
        }

        // * Insert ke tabel management email untuk list data transaksi email.
        $checkEmail = ManagementEmail::where([
                                                ['type', '=', $type],
                                                ['email', '=', $email],
                                                ['payload', '=', json_encode($this->data)]
                                            ])
                                            ->first();

        if (!$checkEmail) {
            $checkEmail = ManagementEmail::create([
                'type' => $type,
                'email' => $email,
                'payload' => json_encode($this->data)
            ]);
        }

        if ($type == 'first_register') {
            return $this->subject('Credential Access ERP LM FEB UI')
                // ->cc(["sena@kabayan.id"])
                ->markdown('email.first-register', [
                    //'prefix'            => $this->data['prefix'],
                    'nama'              => $this->data['nama'],
                    'username'          => $this->data['username'],
                    'password'          => $this->data['password'],
                    'url'               => $this->data['url']
                ]);
        } else if ($type == 'reset-password') {
            return $this->subject('RESET PASSWORD')
                ->markdown('email.reset-password', [
                    'url' => $this->data['url']
                ]);
        }
    }
}
