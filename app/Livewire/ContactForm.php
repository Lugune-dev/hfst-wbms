<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $subject = '';
    public $body = '';
    public $successMessage = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:3',
        'body' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'body' => $this->body,
        ]);

        $this->reset(['name', 'email', 'subject', 'body']);
        $this->successMessage = 'Thank you! Your message has been sent successfully.';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
